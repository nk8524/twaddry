<?php
  require_once( __DIR__.'/db.php' );
  session_start();

  // 新規登録
  if(isset($_POST["resister"])) {
    $input = array();
    $return = array();
    $error_message = "";
    $account_data = array();
    $input['user_id'] = htmlspecialchars($_POST['user_id'], ENT_QUOTES);
    $input['user_name'] = htmlspecialchars($_POST['user_name'], ENT_QUOTES);
    $input['password']= htmlspecialchars($_POST['password'], ENT_QUOTES);
    // ユーザーIDが登録済みでないか確認
    $condition = "WHERE user_id = '".$input['user_id']."'";
    if( !empty($tb_account->select($condition)) ) {
      $error_message = 'すでに使用されているユーザーIDです。';
    } else {
      // パスワードが一致するか確認
      if ($_POST['password'] === $_POST['password_confirm']) {
        $input['password']= htmlspecialchars($_POST['password'], ENT_QUOTES);
      } else {
        $error_message = 'パスワードが一致しません。';
      }
    }

    if(empty($error_message)) {
      $account_data['created_at'] = date("Y-m-d H:i:s");
      $account_data['updated_at'] = $account_data['created_at'];
      $account_data['user_id'] = $input['user_id'];
      $account_data['user_name'] = $input['user_name'];
      $account_data['password'] = $input['password'];
      $result = $tb_account->insert($input_account_data);
      if( $result ) {
        $_SESSION['login'] = $account_data['user_id'];
      }
    }

    $return['error_message'] = $error_message;
    $return['account_data'] = $account_data;
    echo json_encode($return);
  }

  // ログイン
  if(isset($_POST["login"])) {
    $input = array();
    $return = array();
    $error_message = "";
    $account_data = array();
    $input['user_id'] = htmlspecialchars($_POST['user_id'], ENT_QUOTES);
    $input['password'] = htmlspecialchars($_POST['password'], ENT_QUOTES);

    $condition = "WHERE user_id = '".$input['user_id']."'";
    $account_data = $tb_account->select($condition);

    if( !empty($account_data) ) {
      //　パスワードが一致するか確認
      if($input['password'] === $account_data['password']) {
        $_SESSION['login'] = $account_data['user_id'];
      } else {
        $error_message = 'パスワードが間違っています。';
      }
    } else {
      $error_message = '存在しないユーザーIDです。';
    }

    $return['error_message'] = $error_message;
    $return['account_data'] = $account_data;
    echo json_encode($return);
  }

  // ----------------------------------------------

  // ログイン状態ならデータベースからアカウント情報を取得
  if( isset($_SESSION['login']) ) {
    $user_id = htmlspecialchars($_SESSION['login'], ENT_QUOTES);
    $condition = "WHERE user_id = '".$user_id."'";
    $account_data = $tb_account->select($condition);
  }

  // 投稿データをデータベースに登録
  if( isset($_POST['new_post']) ) {
    $return = array();
    $error_message = "";
    $post_data = array();
    $post_data['user_id'] = $account_data['user_id'];
    $post_data['user_name'] = $account_data['user_name'];
    $post_data['created_at'] = date("Y-m-d H:i:s");
    $post_data['updated_at'] = $post_data['created_at'];
    $post_data['content'] = htmlspecialchars( $_POST['content'], ENT_QUOTES);
    $result = $tb_posts->insert($post_data);
    if (!$result) {
      $error_message = "投稿に失敗しました。（データベースエラー）";
    }

    $return['error_message'] = $error_message;

    echo json_encode($return);
  }

  // 投稿データを更新
  if( isset($_POST['post_update']) ) {
    $return = array();
    $error_message = "";
    $post_data = array();
    $post_id = $_POST['post_id'];
    $post_data['updated_at'] = date("Y-m-d H:i:s");
    $post_data['content'] = htmlspecialchars( $_POST['content'], ENT_QUOTES);
    $result = $tb_posts->update($post_data,$post_id);
    if (!$result) {
      $error_message = "更新に失敗しました。（データベースエラー）";
    }

    $return['error_message'] = $error_message;

    echo json_encode($return);
  }

  // 投稿データを削除
  if( isset($_POST['post_delete']) ) {
    $return = array();
    $error_message = "";
    $post_id = $_POST['post_id'];
    $result = $tb_posts->delete($post_id);
    if (!$result) {
      $error_message = "削除に失敗しました。（データベースエラー）";
    }

    $return['error_message'] = $error_message;
    echo json_encode($return);
  }

?>