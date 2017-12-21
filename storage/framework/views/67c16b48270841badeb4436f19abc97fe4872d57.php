<div class="row max-width">
    <div class="col-xs-12">
        <ul class="breadcrumb">
            <li>
                <a href="<?php echo e(route('home')); ?>"><?php echo e(trans('hifone.home')); ?></a>
            </li>
            <?php foreach($breadcrumbs as $index => $breadcrumb): ?>
            <li>
               <?php if($index == count($breadcrumbs) -1 ): ?>
                <strong><?php echo e($breadcrumb['name']); ?></strong>
                <?php else: ?>
                <a href="<?php echo e($breadcrumb['url']); ?>">
                    <span><?php echo e($breadcrumb['name']); ?></span>
                </a>
                <?php endif; ?>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>