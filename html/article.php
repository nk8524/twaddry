<article class="media my-4 p-4 bg-white rounded text-muted box-shadow">
  <div class="media-body mb-0">
    <div class="pb-2 border-bottom">
      <div>
        <a href="user_page.php?user_id=<?php echo $value['user_id']; ?>"><strong class="text-muted"><?php echo $value['user_name']; ?></strong></a>
      </div>
      <div class="d-flex justify-content-between lh-1">
        <div>
          <span class="small align-text-bottom">@<?php echo $value['user_id']; ?></span>
        </div>
        <!-- マイページには編集ボタン表示 -->
        <?php if (preg_match('/my_page/',$_SERVER['REQUEST_URI'])) :?>
          <div>
            <a href="" class="text-muted align-text-bottom" data-toggle="modal" data-target="#modal-update-post-<?php echo $key + '1' ?>">
              <i class="material-icons">launch</i>
            </a>
            <?php include(__DIR__.'/modal/post_edit.php'); ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
    <div class="py-2 my-2">
      <p class="small mb-0"><?php echo nl2br($value['content']); ?></p>
    </div>
    <div class="d-flex align-items-end flex-column">
      <time class="text-secondary small lh-1" >
        <?php echo date('Y年m月d日 H:i', strtotime($value['updated_at'])); ?>
      </time>
    </div>
  </div>
</article>