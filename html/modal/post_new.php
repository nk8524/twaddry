<!-- モーダルウィンドウ -->
<!-- 新規投稿-->
<div class="modal fade modal-post" id="modal-new-post">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0">
      <form method="post" id="post-form" class="media p-4 bg-white rounded text-muted box-shadow">
        <div class="media-body mb-0">
          <div class="pb-2 border-bottom">
            <div>
              <strong class="text-muted"><?php echo $account_data['user_name']; ?></strong>
            </div>
            <div class="d-flex justify-content-between lh-1">
              <div>
                <span class="small align-text-bottom">@<?php echo $account_data['user_id']; ?></span>
              </div>
              <div>
                <button name="new_post" class="btn-post text-muted align-text-bottom" data-id="ajax">
                  <i class="material-icons">send</i>
                </button>
              </div>
            </div>
          </div>
          <div class="py-2 my-2">
            <div class="form-group">
              <textarea name="content" class="small mb-0 form-control" autofocus><?php if( !empty($new_post_data['content']) ){ echo $new_post_data['content']; } ?></textarea>
            </div>
          </div>
          <div class="word_counter d-flex align-items-end flex-column">
              <span><span class="now">0</span>/<span class="max">200</span>文字</span>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>