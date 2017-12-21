<?php $__env->startSection('title'); ?>
<?php if(Request::is('/')): ?>

<?php else: ?>
<?php echo e(trans('hifone.threads.list')); ?>

 - @parent
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="col-md-9 threads-index main-col">
    <div class="panel panel-default">

        <div class="panel-heading">
        <div class="pull-left hidden-sm hidden-xs">
          <?php if(Request::is('/')): ?>
            <i class="fa fa-list"></i> الاستقبال
          
          <?php elseif(isset($tag)): ?>
          <div class="node-info">
          <?php echo e(trans('hifone.tags.name')); ?>: <strong><?php echo e($tag->name); ?></strong>
          <span class="total">, <?php echo e(trans('hifone.threads.thread_count', ['threads' => $tag->threads->count() ])); ?></span>
          </div>
          <?php else: ?>
          <i class="fa fa-comments-o"></i> <?php echo e(trans('hifone.threads.threads')); ?>

          <?php endif; ?>
          </div>
          <?php if(!isset($tag)): ?>
            <?php echo $__env->make('threads.partials.filter', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
          <?php endif; ?>
          <div class="clearfix"></div>
        </div>

        <?php if( ! $threads == null): ?>

            <div class="panel-body remove-padding-horizontal">
                <?php echo $__env->make('threads.partials.threads', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>

            <div class="panel-footer text-right remove-padding-horizontal pager-footer">
                <!-- Pager -->
               
            </div>

        <?php else: ?>
            <div class="panel-body">
                <div class="empty-block">ما من اسئلة</div>
            </div>
        <?php endif; ?>

	
    </div>
<br>
	<div class="panel panel-default">

        <div class="panel-heading">
        <div class="pull-left hidden-sm hidden-xs">
         
            <i class="fa fa-list"></i> ربما تود الإجابه عن
          
         
          </div>
         
          <div class="clearfix"></div>
        </div>

        <?php if(  count($random_q) != 0 ): ?>

            <div class="panel-body remove-padding-horizontal">
                <?php echo $__env->make('threads.partials.random', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>

            

        <?php else: ?>
            <div class="panel-body">
                <div class="empty-block">مامن اسئلة</div>
            </div>
        <?php endif; ?>

		
	
    </div>

	<br>
	<div class="panel panel-default">

        <div class="panel-heading">
        <div class="pull-left hidden-sm hidden-xs">
         
            <i class="fa fa-list"></i> اسئلة الذين انابعهم
          
         
          </div>
         
          <div class="clearfix"></div>
        </div>

        <?php if(  count($subthreads) != 0 ): ?>

            <div class="panel-body remove-padding-horizontal">
                <?php echo $__env->make('threads.partials.subthreads', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>

            

        <?php else: ?>
            <div class="panel-body">
                <div class="empty-block">مامن اسئلة</div>
            </div>
        <?php endif; ?>

		
	
    </div>

	
	
    <!-- Nodes List -->
   

</div>
 
<?php echo $__env->make('partials.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>