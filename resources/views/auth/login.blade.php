@extends('layouts.default')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-5 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">الدخول</div>
				<div class="panel-body">
					@if($connect_data)
					<div class="alert alert-info">
						{{ trans('hifone.login.oauth.login.note', ['provider' => $connect_data['provider_name'], 'name' => $connect_data['nickname']]) }}
					</div>
					@endif
					<form role="form" method="POST" action="/auth/login">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						@if(Session::has('error'))
            				<p class="alert alert-danger">{{ Session::get('error') }}</p>
            			@endif
						<div class="form-group">
							<input type="login" class="form-control" name="login" value="{{ Input::old('login') }}" placeholder="اسم المستعمل">
						</div>

						<div class="form-group">
							<input type="password" class="form-control" name="password" placeholder="كلمة المرور">
						</div>
						@if(!$captcha_login_disabled)
							@include('partials.captcha')
						@endif
						<!--<div class="form-group checkbox">
							<label for="remember_me">
								<input type="checkbox" name="remember">
							</label>
						</div>-->
						<div class="form-group">
							<input type="submit" name="commit" value="{{ trans('forms.login') }}" class="btn btn-primary btn-lg btn-block">
						</div>
						
						
						
						<a href="{{route('facebook.login')}}" class="btn btn-primary"><i class="fa fa-facebook" aria-hidden="true"></i></a>
						<a href="{{route('twitter.login')}}" class="btn btn-primary twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>
						
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
						@foreach($providers as $provider)
						<a href="/auth/{{ $provider->slug }}" class="btn btn-default btn-lg btn-block"><i class="{{ $provider->icon ? $provider->icon : 'fa fa-user' }}"></i> {{ $provider->name }}</a>
						@endforeach
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
@endsection
