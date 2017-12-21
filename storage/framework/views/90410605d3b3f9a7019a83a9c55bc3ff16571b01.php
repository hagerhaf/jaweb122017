 
<?php $__env->startSection('title'); ?>
<?php echo $user->username; ?> 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


<div class="users-show">

  <div class="col-md-3 box">
    <?php echo $__env->make('users.partials.basicinfo', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  </div>

  <div class="col-md-9 left-col">


  <div class="panel panel-default">

    <div class="panel-body">
      <?php echo $__env->make('users.partials.infonav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      <?php if(count($blocked)): ?>
	      <?php echo $__env->make('users.partials.blocks', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	      <div class="pull-right add-padding-vertically">
	       Blocked 
	      </div>
      <?php else: ?>
	       <div class="empty-block">You have not blocked people yet</div>
      <?php endif; ?>

    </div>

  </div>
</div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>