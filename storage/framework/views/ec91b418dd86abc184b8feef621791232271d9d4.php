<div id="notification-<?php echo e($notification->id); ?>" data-id="<?php echo e($notification->id); ?>" class="media notification notification-topic_reply">
  <div class="media-left">
    <a title="<?php echo e($notification->author->username); ?>" class="user-avatar" href="<?php echo e(route('user.home', [$notification->author->username])); ?>"><img src="<?php echo e($notification->author->avatar_small); ?>" alt="<?php echo e($notification->author->id); ?>"></a>
  </div>
  <div class="media-body">
    
  <div class="media-heading">
    unknown
  </div>
    <div class="media-content summary markdown-reply">
      <span class="deleted text-center"><?php echo e(trans('hifone.notifications.deleted')); ?></span>
    </div>

  </div>
  <div class="media-right">
    <span class="timeago"><?php echo e($notification->created_at); ?></span>
  </div>
</div>