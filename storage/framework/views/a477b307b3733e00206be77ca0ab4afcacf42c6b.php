<!DOCTYPE html>
<html lang="<?php echo e(isset($user_locale) ? $user_locale : $site_locale); ?>">
	<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title><?php echo $__env->yieldContent('title'); ?> <?php echo e($site_name); ?><?php if($site_about): ?> - <?php echo e($site_about); ?><?php endif; ?></title>
        <meta name="keywords" content="<?php if(Config::get('setting.meta_keywords')): ?><?php echo e(Config::get('setting.meta_keywords')); ?><?php else: ?><?php echo e('Hifone,BBS,Forum,PHP,Laravel'); ?><?php endif; ?>" />
        <meta name="author" content="<?php if(Config::get('setting.meta_author')): ?><?php echo e(Config::get('setting.meta_author')); ?><?php else: ?><?php echo e('The Hifone Team'); ?><?php endif; ?>" />
        <meta name="description" content="<?php $__env->startSection('description'); ?>" />
        <meta name="generator" content="Hifone">
        <meta name="env" content="<?php echo e(app('env')); ?>">
        <meta name="token" content="<?php echo e(csrf_token()); ?>">
        <link rel="stylesheet" href="<?php echo e(elixir('dist/css/all.css')); ?>">
        <link rel="shortcut icon" href="/images/favicon.png">
        <link rel="alternate" type="application/atom+xml" href="/feed" />
		
        <script src="<?php echo e(elixir('dist/js/all.js')); ?>"></script>
		 

        <script type="text/javascript">
            Hifone.Config = {
                'locale' : '<?php echo e(isset($user_locale) ? $user_locale : $site_locale); ?>',
                'current_user_id' : <?php echo e(Auth::user() ? Auth::user()->id : 'null'); ?>,
                'token' : '<?php echo e(csrf_token()); ?>',
                'emoj_cdn' : 'https://dn-phphub.qbox.me',
                'uploader_url' : '<?php echo e(route('upload_image')); ?>',
                'notification_url' : '<?php echo e(route('notification.count')); ?>'
            };
        </script>
        <script type="text/javascript">
            Hifone.jsLang = {
                'delete_form_title' : '<?php echo e(trans('hifone.action_title')); ?>',
                'delete_form_text' : '<?php echo e(trans('hifone.action_text')); ?>',
                'uploading_file' : '<?php echo e(trans('hifone.uploading_file')); ?>',
                'loading' : '<?php echo e(trans('hifone.loading')); ?>',
                'content_is_empty' : '<?php echo e(trans('hifone.content_empty')); ?>',
                'operation_success' : '<?php echo e(trans('hifone.success')); ?>',
                'error_occurred' : '<?php echo e(trans('hifone.error_occurred')); ?>',
                'button_yes' : '<?php echo e(trans('hifone.yes')); ?>',
                'like' : '<?php echo e(trans('hifone.like')); ?>',
                'dislike' : '<?php echo e(trans('hifone.unlike')); ?>'
            };
        </script>
        <?php if($stylesheet): ?>
		<style type="text/css">
		<?php echo $stylesheet; ?>

		</style>
		<?php endif; ?>
    </head>
    <body class="forum" data-page="forum">
       <?php echo $__env->make('partials.nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<div id="main" class="main-container container">
				<?php echo $__env->make('partials.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php echo isset($breadcrumb) ? $breadcrumb : ''; ?>

                <?php echo $__env->make('partials.top', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

				<?php echo $__env->yieldContent('content'); ?>

                <?php echo $__env->make('partials.bottom', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		</div>

        <?php echo $__env->make('partials.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	</body>
</html>
