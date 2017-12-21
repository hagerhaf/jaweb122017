
<ul class="list-group">
  <?php foreach($replies as $index => $reply): ?>
   <li class="list-group-item">

    <?php if(count($reply->thread)): ?>
      <a href="<?php echo route('thread.show', [$reply->thread_id]); ?>" title="<?php echo $reply->thread->title; ?>" class="remove-padding-left">
          <?php echo $reply->thread->title; ?>

      </a>
      <span class="meta">
         at <span class="timeago" title="<?php echo $reply->created_at; ?>"><?php echo $reply->created_at; ?></span>
      </span>
      <div class="reply-body markdown-reply content-body">
<?php echo $reply->body; ?>

      </div>
    <?php else: ?>
      <div class="deleted text-center"><?php echo trans('hifone.deleted'); ?></div>
    <?php endif; ?>

  </li>
  <?php endforeach; ?>
</ul>
