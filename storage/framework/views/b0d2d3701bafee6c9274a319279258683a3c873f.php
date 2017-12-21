<div class="meta inline-block" >

  <a href="../node/<?php echo e($thread->node_id); ?>" class="remove-padding-left">
    <?php echo e($thread->node->name); ?>

  </a>
  
  
  <?php if($thread->anonymous == 0): ?>
	  
  
  
  <?php if($current_user==true): ?>
	  
  •
  <a href="<?php echo e(route('user.home', $thread->user->username)); ?>">
    <?php if($thread->user->nickname): ?>
      <?php echo e($thread->user->nickname); ?>

    <?php else: ?>
      <?php echo e($thread->user->username); ?>

    <?php endif; ?>
  </a>
  
  <?php else: ?>
	
 •
  <a href="<?php echo e(route('user.home', $thread->user->username)); ?>">
    <?php if($thread->user->nickname): ?>
      <?php echo e($thread->user->nickname); ?>

    <?php else: ?>
      <?php echo e($thread->user->username); ?>

    <?php endif; ?>
  </a>
  
  <?php endif; ?>
  
  
  
  
  
  
  
  
  <?php else: ?>
	  
  
   •
  <a href="">
   مجهول
  </a>
  
  
	  <?php endif; ?>

  <?php if($thread->user->hasBadge): ?>
    <span class="label label-warning" style="position: relative;"><?php echo e($thread->user->badgeName); ?></span>
  <?php endif; ?>
  •
  <?php echo e(trans('hifone.at')); ?> <abbr title="<?php echo e($thread->created_at); ?>" class="timeago"><?php echo e($thread->created_at); ?></abbr>
  •

  <?php if(count($thread->lastReplyUser)): ?>
    <?php echo e(trans('hifone.threads.last_reply_by')); ?>

      <a href="<?php echo e(route('user.home', [$thread->lastReplyUser->username])); ?>">
        <?php if($thread->lastReplyUser->nickname): ?>
          <?php echo e($thread->lastReplyUser->nickname); ?>

        <?php else: ?>
          <?php echo e($thread->lastReplyUser->username); ?>

        <?php endif; ?>
      </a>
     <?php echo e(trans('hifone.at')); ?> <abbr title="<?php echo e($thread->updated_at); ?>" class="timeago"><?php echo e($thread->updated_at); ?></abbr>
    •
  <?php endif; ?>

  <?php echo e($thread->view_count); ?> <?php echo e(trans('hifone.view_count')); ?>

</div>
<div class="clearfix"></div>
