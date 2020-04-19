<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <!-- CSS -->
  <link href="https://twaddry.herokuapp.com/<?php echo $dir ?>/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="https://twaddry.herokuapp.com/<?php echo $dir ?>/css/style.css" rel="stylesheet">
  <!-- JS -->
  <script src="https://twaddry.herokuapp.com/<?php echo $dir ?>/js/jquery-3.5.0.min.js"></script>
  <script src="https://twaddry.herokuapp.com/<?php echo $dir ?>/js/bootstrap.bundle.min.js"></script>
  <script src="https://twaddry.herokuapp.com/<?php echo $dir ?>/js/autosize.min.js"></script>
  <script src="https://twaddry.herokuapp.com/<?php echo $dir ?>/js/textarea.js"></script>
  <script src="https://twaddry.herokuapp.com/<?php echo $dir ?>/js/modal-form-ajax.js"></script>
  <title>
  <?php if (preg_match('/index/',$_SERVER['REQUEST_URI'])) :?>
    twaddry
  <?php elseif (preg_match('/user_page/',$_SERVER['REQUEST_URI'])) :?>
    <?php if( !empty($user_account_data) ): ?>
      <?php echo htmlspecialchars($user_account_data['user_name'], ENT_QUOTES);?> (@<?php echo htmlspecialchars($user_account_data['user_id'], ENT_QUOTES);?>)のページ
    <?php else: ?>
      存在しないユーザーのページ
    <?php endif; ?>
  <?php elseif (preg_match('/my_page/',$_SERVER['REQUEST_URI'])) :?>
    マイページ
  <?php endif; ?>
  </title>
</head>