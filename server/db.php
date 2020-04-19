<?php
  // タイムゾーン設定
  date_default_timezone_set('Asia/Tokyo');

  class Database {
    private $host;
    private $user;
    private $pass;
    private $name;
    private $filename= __DIR__."/db_info.config";
    private $mysqli;

    function __construct() {
      // データベース設定情報取得
      if(!file_exists($this->filename)){
        die($this->filename."が存在しません。");
      }else{
        $fp=fopen($this->filename,"r");
        $this->host=substr(str_replace(array(" ", "　"), "", trim(fgets($fp))),5);
        $this->user=substr(str_replace(array(" ", "　"), "", trim(fgets($fp))),5);
        $this->pass=substr(str_replace(array(" ", "　"), "", trim(fgets($fp))),5);
        $this->name=substr(str_replace(array(" ", "　"), "", trim(fgets($fp))),5);
        fclose($fp);
      }

      // データベース接続チェック
      $this->mysqli = new mysqli($this->host, $this->user, $this->pass, $this->name);
      if ($this->mysqli->connect_error) {
        die("データベース接続に失敗しました ".$this->mysqli->connect_errno." : ".$this->mysqli->connect_error);
      }
      $this->mysqli->close();
    }

    public function __call($func_name, $args){
      $this->mysqli = new mysqli($this->host, $this->user, $this->pass, $this->name);
      $this->mysqli->set_charset('utf8');
      if(method_exists($this, $func_name)) {
        $sql = $args[0];
        $result = $this->query($sql);
        if($func_name != 'query') {
          $result = $this->{$func_name}($result);
        }
      } else {
        die("{$func_name}は存在しないメソッドです。");
      }
      $this->mysqli->close();
      return $result;
    }

    private function query($sql) {
      $result = $this->mysqli->query($sql);
      if( $result ) {
          return $result;
      } else {
        die("無効なSQLです。");
      }
    }

    private function fetch($result) {
      return $result->fetch_assoc();
    }

    private function fetchAll($result) {
      return $result->fetch_all(MYSQLI_ASSOC);
    }

  }

  class Table {
    private $name;
    private $db; // class Database
    private $col_name;

    function __construct($table_name, $db) {
      // テーブル'$table_name'が存在するかチェック
      $sql = "SHOW TABLES";
      $tables = $db->fetchAll($sql);
      foreach($tables as $values) {
        foreach($values as $value) {
          $all_table_name[] = $value;
        }
      }
      if(in_array($table_name, $all_table_name, true)) {
        $this->name = $table_name;
        $this->db = $db;
      } else {
        die("{$table_name}は存在しないテーブルです。");
      }

      // カラム名取得
      $sql = "SHOW COLUMNS FROM {$this->name}";
      $columns = $this->db->fetchAll($sql);
      foreach($columns as $value) {
        $this->col_name[] = $value['Field'];
      }
    }

    // 条件に当てはまるデータ1件取得
    public function select($condition = '') {
      $sql = "SELECT * FROM {$this->name} {$condition} ORDER BY updated_at DESC";
      $result = $this->db->fetch($sql);
      return $result;
    }

    // 条件に当てはまるデータ全件取得
    public function selectAll($condition = '') {
      $sql = "SELECT * FROM {$this->name} {$condition} ORDER BY updated_at DESC";
      $result = $this->db->fetchAll($sql);
      return $result;
    }

    // データ追加
    public function insert($values) {
      $keys = array_keys($values);
      $str_keys = implode(",", $keys);
      $str_values = "'".implode("','", $values)."'";
      $sql = "INSERT INTO {$this->name} ({$str_keys}) VALUES ({$str_values})";
      $result = $this->db->query($sql);
      return $result;
    }

    // データ更新
    public function update($values,$id) {
      foreach($values as $key => $value) {
        $strs[] = $key." = '".$value."'";
      }
      $str = implode(", ", $strs);
      $sql = "UPDATE {$this->name} SET {$str} WHERE id = '".$id."'";
      $result = $this->db->query($sql);
      return $result;
    }

    // データ削除
    public function delete($id) {
      $sql = "DELETE FROM {$this->name} WHERE id = '".$id."'";
      $result = $this->db->query($sql);
      return $result;
    }

  }

  $db = new Database();
  $tb_posts = new Table('posts', $db);
  $tb_account = new Table('account', $db);

?>