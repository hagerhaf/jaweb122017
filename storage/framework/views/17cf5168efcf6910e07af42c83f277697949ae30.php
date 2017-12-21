<?php $__env->startSection('title'); ?>
    <?php echo e(trans('hifone.threads.add')); ?>_@parent
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="thread_create">

        <div class="col-md-9 main-col">
            <div class="panel panel-default corner-radius">
                <div class="panel-heading"><?php echo e(trans('hifone.threads.add')); ?></div>
                <div class="panel-body">
                    <div class="reply-box form box-block">
                        <?php echo Form::open(['route' => 'messages.store']); ?>


                        <div class="form-group">
                            <?php echo Form::label('subject', 'Subject', ['class' => 'control-label']); ?>

                            <?php echo Form::text('subject', null, ['class' => 'form-control', 'placeholder' => trans('hifone.threads.title')]); ?>

                        </div>

                        <div class="form-group">
                            <select class="form-control selectpicker" name="thread[node_id]">
                                <option value=""><?php echo e(trans('hifone.pms.pick_user')); ?></option>
                                <?php foreach($users as $user): ?>
                                    <option value="<?php echo e($user->id); ?>"> - <?php echo e($user->username); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <!-- editor start -->
                        <?php echo $__env->make('pms.partials.editor_toolbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <!-- end -->
                        <div class="form-group">
                            <?php echo Form::textarea('message', null, [
                            'class' => 'post-editor form-control',
                            'rows' => 15,
                            'style' => 'body_field',
                            'placeholder' => trans('hifone.markdown_support')
                            ]); ?>

                        </div>

                        <div class="form-group status-post-submit">
                            <?php echo Form::submit(trans('hifone.pms.send'), ['class' => 'btn btn-primary form-control']); ?>

                        </div>

                        <div class="box preview markdown-body" id="preview-box" style="display:none;"></div>

                        <?php echo Form::close(); ?>

                    </div>
                </div>
            </div>

        </div>

        <div class="col-md-3 side-bar">
            <div class="panel panel-default corner-radius help-box">
                <div class="panel-heading text-center">
                    <h3 class="panel-title"><?php echo e(trans('hifone.threads.posting_tips.title')); ?></h3>
                </div>
                <div class="panel-body">
                    <ul class="list">
                        <li><?php echo e(trans('hifone.threads.posting_tips.pt1_title')); ?>

                            <p><?php echo e(trans('hifone.threads.posting_tips.pt1_desc')); ?></p>
                        </li>
                        <li><?php echo e(trans('hifone.threads.posting_tips.pt2_title')); ?>

                            <p><?php echo e(trans('hifone.threads.posting_tips.pt2_desc')); ?></p>
                        </li>
                        <li><?php echo e(trans('hifone.threads.posting_tips.pt3_title')); ?>

                            <p><?php echo trans('hifone.threads.posting_tips.pt3_desc'); ?></p>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="panel panel-default corner-radius help-box">
                <div class="panel-heading text-center">
                    <h3 class="panel-title"><?php echo e(trans('hifone.threads.community_guidelines.title')); ?></h3>
                </div>
                <div class="panel-body">
                    <ul class="list">
                        <li><?php echo e(trans('hifone.threads.community_guidelines.cg1_title')); ?>

                            <p><?php echo e(trans('hifone.threads.community_guidelines.cg1_desc')); ?></p>
                        </li>
                        <li><?php echo e(trans('hifone.threads.community_guidelines.cg2_title')); ?>

                            <p><?php echo e(trans('hifone.threads.community_guidelines.cg2_desc')); ?></p>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>