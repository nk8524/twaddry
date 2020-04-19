<!-- モーダルウィンドウ -->
<!-- サインアップ -->
<div class="modal fade" id="modal-resister">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0">
      <div class="modal-body p-5 text-center">
        <form method="post" id="account-form">
          <div class="form-group">
            <input id="user_id" type="user_id" name="user_id" placeholder="ユーザーID" class="form-control" required>
          </div>
          <div class="form-group">
            <input id="user_name" type="user_name" name="user_name" placeholder="ニックネーム" class="form-control" required>
          </div>
          <div class="form-group">
            <input id="password" type="password" name="password" placeholder="パスワード" class="form-control" required>
          </div>
          <div class="form-group mb-4">
            <input id="password" type="password" name="password_confirm" placeholder="パスワード(確認用)" class="form-control" required>
          </div>
          <div class="py-3">
            <button name="resister" class="btn btn-primary" data-id="ajax">Sign Up</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>