<!-- モーダルウィンドウ -->
<div class="modal fade modal-post" id="modal-update-post-<?php echo $key + '1' ?>">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0">
      <form method="post" class="media p-4 bg-white rounded text-muted box-shadow">
        <div class="media-body mb-0">
          <div class="pb-2 border-bottom">
            <div>
              <strong class="text-muted"><?php echo $value['user_name']; ?></strong>
            </div>
            <div class="d-flex justify-content-between lh-1">
              <div>
                <span class="small align-text-bottom">@<?php echo $value['user_id']; ?></span>
              </div>
              <div>
                <input type="hidden" name="post_id" value="<?php echo $value['id']; ?>"/>
                <button name="post_delete" class="text-muted align-text-bottom mr-2" data-id="ajax">
                  <i class="material-icons">delete</i>
                </button>
                <button name="post_update" class="text-muted align-text-bottom" data-id="ajax">
                  <i class="material-icons">send</i>
                </button>
              </div>
            </div>
          </div>
          <div class="py-2 my-2">
            <div class="form-group">
              <textarea name="content" class="small mb-0 form-control" autofocus><?php if( !empty($value['content']) ){ echo $value['content']; } ?></textarea>
            </div>
          </div>
          <div class="word_counter d-flex align-items-end flex-column">
              <span><span class="now">0</span>/200文字</span>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>