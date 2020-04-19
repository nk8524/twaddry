<nav class="position-fixed mt-md-4">
  <ul class="nav flex-md-column align-items-center justify-content-center">
    <?php // ログインセッションを確認する ?>
    <?php if( !empty($_SESSION['login']) ): ?>
      <?php // ログイン済み ?>
      <li class="fab nav-item btn-circle d-flex justify-content-center align-items-center position-relative box-shadow mx-3 mx-md-0">
        <a class="lh-0 stretched-link" href="<?php echo $dir ?>/my_page.php">
          <i class="material-icons nav-icon">person</i>
        </a>
      </li>
      <li class="fab nav-item btn-circle d-flex justify-content-center align-items-center position-relative box-shadow my-md-4 mx-3 mx-md-0">
        <a href="" class="lh-0 stretched-link" data-toggle="modal" data-target="#modal-new-post">
          <i class="material-icons nav-icon">create</i>
        </a>
      </li>
      <li class="fab nav-item btn-circle d-flex justify-content-center align-items-center position-relative box-shadow mx-3 mx-md-0">
        <a class="lh-0 stretched-link" href="<?php echo $dir ?>/logout.php">
          <i class="material-icons nav-icon">exit_to_app</i>
        </a>
      </li>
    <?php else: ?>
      <?php // ゲスト画面 ?>
      <li class="fab nav-item btn-circle d-flex justify-content-center align-items-center position-relative box-shadow mx-3 mx-md-0">
        <a class="lh-0 stretched-link" href="" data-toggle="modal" data-target="#modal-login">
          <i class="material-icons nav-icon">vpn_key</i>
        </a>
      </li>
      <li class="fab nav-item btn-circle d-flex justify-content-center align-items-center position-relative box-shadow mt-md-4 mx-3 mx-md-0">
        <a class="lh-0 stretched-link" href="" data-toggle="modal" data-target="#modal-resister">
          <i class="material-icons nav-icon">person_add</i>
        </a>
      </li>
    <?php endif; ?>
  </ul>
</nav>