<!-- モーダルウィンドウ -->
<!-- ログイン -->
<div class="modal fade" id="modal-login">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0">
      <div class="modal-body p-5 text-center">
        <form method="post" id="account-form">
          <div class="form-group">
            <input id="user_id" type="user_id" name="user_id" placeholder="ユーザーID" class="form-control" required>
          </div>
          <div class="form-group mb-4">
            <input id="password" type="password" name="password" placeholder="パスワード" class="form-control" required>
          </div>
          <button name="login" value="login" class="btn btn-primary" data-id="ajax">Login</button>
        </form>
      </div>
    </div>
  </div>
</div>