<?php $__env->startSection('title'); ?>
<?php echo trans('hifone.credits.mine'); ?> @parent
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="panel panel-default">

    <div class="panel-heading">
      <?php echo e(trans('hifone.credits.mine')); ?>

    </div>
    <div class="panel-body">
      <div class="media">
      <div class="media-heading">
        <?php echo e(trans('hifone.credits.balance_current')); ?>

       <span class="coin_list" data-toggle="tooltip", data-placement="bottom" title="<?php echo e($current_user->score); ?>">
        <?php echo $current_user->coins; ?>

        </span>
        </div>
      </div>
      <table class="table table-bordered table-striped">
        <tbody>
          <tr>
            <th>#</th>
            <th><?php echo e(trans('hifone.credits.time')); ?></th>
            <th><?php echo e(trans('hifone.credits.type')); ?></th>
            <th><?php echo e(trans('hifone.credits.reward')); ?></th>
            <th><?php echo e(trans('hifone.credits.balance')); ?></th>
          </tr>
          <?php foreach($credits as $index => $credit): ?>
          <tr>
            <td><?php echo e($credit->id); ?></td>
            <td class="timeago"><?php echo e($credit->created_at); ?></td>
             <td><?php echo e($credit->rule->name); ?></td>
            <td><?php echo $credit->reward_formatted; ?></td>
            <td><?php echo e($credit->balance); ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>