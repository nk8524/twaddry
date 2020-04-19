<?php
  require_once(__DIR__.'/server/db.php');
  session_start();

  // ログイン状態ならデータベースからアカウント情報を取得
  if( empty($_SESSION['login']) ) {
    // ログインしていなければトップへリダイレクト
    header('Location: '.__DIR__.'/index.php');
    exit;
  } else {
    $user_id = htmlspecialchars($_SESSION['login'], ENT_QUOTES);
    $condition = "WHERE user_id = '".$user_id."'";
    $account_data = $tb_account->select($condition);
  }

  // データベースから自分のみの投稿データを取得
  $condition = "WHERE user_id = '".$account_data['user_id']."'";
  $my_post_data = $tb_posts->selectAll($condition);

  $post_data = $my_post_data;

?>
<!DOCTYPE html>
<html lang="ja">
  <?php include(__DIR__.'/html/head.php'); ?>
  <body>
    <?php include(__DIR__.'/html/header.php'); ?>
    <main>
      <div class="container-fluid p-3 p-md-5">
        <div class="row justify-content-end">
          <section class="col-12 col-md-8 col-lg-6" data-id="articles">
            <?php if( !empty($post_data) ): ?>
              <?php foreach($post_data as $key => $value): ?>
                <?php include(__DIR__.'/html/article.php'); ?>
              <?php  endforeach; ?>
            <?php endif; ?>
          </section>
          <section class="col-12 col-md-2 col-lg-3 position-relative d-flex justify-content-center" data-id="nav">
            <?php include(__DIR__.'/html/nav.php'); ?>
          </section>
        </div>
      </div>
    </main>
  </body>
</html>