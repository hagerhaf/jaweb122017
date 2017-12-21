<?php $__env->startSection('title'); ?>
    <?php echo e(trans('hifone.pms.list')); ?>

    - @parent
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="col-md-9 threads-index main-col">
        <div class="panel panel-default">

            <div class="panel-heading">
                <div class="pull-left hidden-sm hidden-xs">
                    <i class="fa fa-list"></i> <?php echo e(trans('hifone.pms.home')); ?>

                </div>
                <div class="clearfix"></div>
            </div>

            <?php if($threads->count() > 0): ?>

                <div class="panel-body remove-padding-horizontal">
                    <?php echo $__env->make('pms.partials.messages', ['column' => false], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </div>

                <div class="panel-footer text-right remove-padding-horizontal pager-footer">
                    <!-- Pager -->
                    <?php /* }}<?php echo $threads->appends(Request::except('page', '_pjax'))->render(); ?> */ ?>
                </div>

            <?php else: ?>
                <div class="panel-body">
                    <div class="empty-block"><?php echo e(trans('hifone.noitem')); ?></div>
                </div>
            <?php endif; ?>

        </div>

    </div>

    <?php echo $__env->make('partials.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>