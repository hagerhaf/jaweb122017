<?php $__env->startSection('title'); ?>
تنبيهاتي @parent
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="notifications panel">

    <div class="panel-heading clearfix">
      التنبيهات
      <span class="pull-right">
          <a class="btn btn-sm btn-danger" rel="nofollow" data-method="post" data-url="/notification/clean">محو</a>
      </span>
    </div>

    <?php if(count($notifications)): ?>
	<div class="panel-body remove-padding-horizontal notification-index content-body">

		<ul class="list-group row">
			<?php foreach($notifications as $notif ): ?>
				<div class="notification-group">
				<div class="group-title"><i class="fa fa-clock-o"></i> <?php echo e($notif->created_at); ?></div>
			<div class="pull-right">	<?php echo e($notif->body); ?></div>
				</div>
			<?php endforeach; ?>
		</ul>
	</div>
	<div class="panel-footer text-right remove-padding-horizontal pager-footer">
		<!-- Pager -->
	</div>
    <?php else: ?>
	<div class="panel-body">
		<div class="empty-block">ما من تنبيهات</div>
	</div>
    <?php endif; ?>

</div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>