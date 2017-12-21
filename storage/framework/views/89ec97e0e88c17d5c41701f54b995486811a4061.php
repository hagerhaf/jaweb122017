<?php $__env->startSection('content'); ?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-5 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">الدخول</div>
				<div class="panel-body">
					<?php if($connect_data): ?>
					<div class="alert alert-info">
						<?php echo e(trans('hifone.login.oauth.login.note', ['provider' => $connect_data['provider_name'], 'name' => $connect_data['nickname']])); ?>

					</div>
					<?php endif; ?>
					<form role="form" method="POST" action="/auth/login">
						<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
						<?php if(Session::has('error')): ?>
            				<p class="alert alert-danger"><?php echo e(Session::get('error')); ?></p>
            			<?php endif; ?>
						<div class="form-group">
							<input type="login" class="form-control" name="login" value="<?php echo e(Input::old('login')); ?>" placeholder="اسم المستعمل">
						</div>

						<div class="form-group">
							<input type="password" class="form-control" name="password" placeholder="كلمة المرور">
						</div>
						<?php if(!$captcha_login_disabled): ?>
							<?php echo $__env->make('partials.captcha', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
						<?php endif; ?>
						<!--<div class="form-group checkbox">
							<label for="remember_me">
								<input type="checkbox" name="remember">
							</label>
						</div>-->
						<div class="form-group">
							<input type="submit" name="commit" value="<?php echo e(trans('forms.login')); ?>" class="btn btn-primary btn-lg btn-block">
						</div>
						
						
						
						<a href="<?php echo e(route('facebook.login')); ?>" class="btn btn-primary"><i class="fa fa-facebook" aria-hidden="true"></i></a>
						<a href="<?php echo e(route('twitter.login')); ?>" class="btn btn-primary twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>
						
						<style>
						.twitter{
							background-color:#67dff3;
							border-color:#67dff3;
							
						}
						</style>
						
					</form>
				</div>
				<div class="panel-footer">
					<a href="/auth/register">تسجيل</a>
					<!--<a href="/password/email">忘记密码?</a>-->
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="panel panel-default">
				
				<ul class="list-group">
					<li class="list-group-item">
						<?php foreach($providers as $provider): ?>
						<a href="/auth/<?php echo e($provider->slug); ?>" class="btn btn-default btn-lg btn-block"><i class="<?php echo e($provider->icon ? $provider->icon : 'fa fa-user'); ?>"></i> <?php echo e($provider->name); ?></a>
						<?php endforeach; ?>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>