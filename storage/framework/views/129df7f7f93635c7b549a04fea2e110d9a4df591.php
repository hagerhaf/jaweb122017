<?php $__env->startSection('content'); ?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-default">
				<div class="panel-heading">التسجيل</div>
				<div class="panel-body">
					<?php if($connect_data): ?>
					<div class="alert alert-info">
						<?php echo e($connect_data['nickname']); ?>  <a href="/auth/login" class="btn btn-success"> دخول</a>
					</div>
					<?php endif; ?>
					<form role="form" method="POST" action="/auth/register">
						<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
						<div class="form-group">
							<input type="text" class="form-control" name="username" value="<?php echo e(Input::old('username')); ?>" placeholder="<?php echo e(trans('hifone.users.username')); ?>">
						</div>
						<div class="form-group">
							<input type="text" class="form-control" name="email" value="<?php echo e(Input::old('email')); ?>" placeholder="<?php echo e(trans('hifone.users.email')); ?>">
						</div>
						<div class="form-group">
							<input type="password" class="form-control" name="password" placeholder="<?php echo e(trans('hifone.users.password')); ?>">
						</div>
						<div class="form-group">
							<input type="password" class="form-control" name="password_confirmation" placeholder="<?php echo e(trans('hifone.users.password_confirmation')); ?>">
						</div>
						<?php if(!$captcha_register_disabled): ?>
							<?php echo $__env->make('partials.captcha', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
						<?php endif; ?>
						<div class="form-group">
							<button type="submit" class="btn btn-primary">
								تسجيل
							</button>
							<a href="/" class="btn btn-default">الغاء</a>
							
							
						<a href="<?php echo e(route('facebook.login')); ?>" class="btn btn-primary"><i class="fa fa-facebook" aria-hidden="true"></i></a>
						<a href="<?php echo e(route('twitter.login')); ?>" class="btn btn-primary"><i class="fa fa-twitter" aria-hidden="true"></i></a>
						</div>
					</form>
				</div>
				<div class="panel-footer">
					<?php echo trans('hifone.login.account_available'); ?>

				</div>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>