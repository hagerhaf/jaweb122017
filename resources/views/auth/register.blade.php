@extends('layouts.default')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-default">
				<div class="panel-heading">التسجيل</div>
				<div class="panel-body">
					@if($connect_data)
					<div class="alert alert-info">
						{{  $connect_data['nickname'] }}  <a href="/auth/login" class="btn btn-success"> دخول</a>
					</div>
					@endif
					<form role="form" method="POST" action="/auth/register">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="form-group">
							<input type="text" class="form-control" name="username" value="{{ Input::old('username') }}" placeholder="{{ trans('hifone.users.username') }}">
						</div>
						<div class="form-group">
							<input type="text" class="form-control" name="email" value="{{ Input::old('email') }}" placeholder="{{ trans('hifone.users.email') }}">
						</div>
						<div class="form-group">
							<input type="password" class="form-control" name="password" placeholder="{{ trans('hifone.users.password') }}">
						</div>
						<div class="form-group">
							<input type="password" class="form-control" name="password_confirmation" placeholder="{{ trans('hifone.users.password_confirmation') }}">
						</div>
						@if(!$captcha_register_disabled)
							@include('partials.captcha')
						@endif
						<div class="form-group">
							<button type="submit" class="btn btn-primary">
								تسجيل
							</button>
							<a href="/" class="btn btn-default">الغاء</a>
							
							
						<a href="{{route('facebook.login')}}" class="btn btn-primary"><i class="fa fa-facebook" aria-hidden="true"></i></a>
						<a href="{{route('twitter.login')}}" class="btn btn-primary"><i class="fa fa-twitter" aria-hidden="true"></i></a>
						</div>
					</form>
				</div>
				<div class="panel-footer">
					{!! trans('hifone.login.account_available') !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
