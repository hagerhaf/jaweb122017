<?php $__env->startSection('content'); ?>

<div class="col-md-9 main-col">
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo e($site_name); ?></h3>
        </div>
        <div class="panel-body">
            <?php echo $site_about; ?>

        </div>
    </div>
    <?php foreach($nodes['top'] as $index => $top_node): ?>
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo e($top_node->name); ?></h3>
        </div>
        <div class="panel-body">
            <?php if(isset($nodes['second'][$top_node->id])): ?>
            <ul class="media-list">
                <?php foreach($nodes['second'][$top_node->id] as $snode): ?>
                <li class="media section">
                    <?php if($snode->icon): ?>
                    <?php echo $snode->icon; ?>

                    <?php endif; ?>
                    <span class="pull-right text-right"><p><?php echo e($snode->thread_count); ?>/主题</p><p><?php echo e(isset($snode->reply_count) ? $snode->reply_count : '0'); ?>/回帖</p></span>
                    <div class="media-body">
                        <h4 class="media-heading"><a href="<?php echo e($snode->url); ?>"><?php echo e($snode->name); ?></a></h4>
                        <p class="text-muted">
                            <?php echo e($snode->description); ?>

                        </p>
                    </div>
                </li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<?php echo $__env->make('partials.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>