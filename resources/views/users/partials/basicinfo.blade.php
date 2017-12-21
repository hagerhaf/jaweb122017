<div style="text-align: center;">
    <img src="{{$user->avatar}}" class="img-thumbnail users-show-avatar upload-btn" style="width: 206px;margin: 4px 4px 15px;min-height:190px;cursor: pointer;">
</div>

<dl class="dl-horizontal">

 

  <dt><strong>{!! $user->username !!}</strong></dt><dd><label>:الاسم المستعار</label></dd>

  @if ($user->hasBadge)
    <dt><span class="label label-warning">{!! $user->badgeName !!}</span></dt><dd><label>الدور</label></dd>
  @endif

 
 
   
  <dt><strong>{!! $user->score !!}</strong></dt><dd><label>:النقاط  </label></dd>
  <dt><strong>{!! $user->somaa !!}</strong></dt><dd><label>:السمعة</label></dd>
   
  @if($user->score <= 32)
  <dt><strong>جديد</strong></dt><dd><label>:المستوى </label></dd>
  @elseif(($user->score >= 33)&&($user->score <= 64))
   <dt><strong>مبتدئ</strong></dt><dd><label>:المستوى </label></dd>
  
	 @elseif(($user->score >= 65)&&($user->score <= 128))
	    <dt><strong>نشط</strong></dt><dd><label>:المستوى </label></dd>
  
 @elseif(($user->score >= 129)&&($user->score <= 256))
    <dt><strong>هاوٍ</strong></dt><dd><label>:المستوى </label></dd>
  
 @elseif(($user->score >= 257)&&($user->score <= 512))
    <dt><strong>متمكن</strong></dt><dd><label>:المستوى </label></dd>
  
 @elseif(($user->score >= 513)&&($user->score <= 1024))
  <dt><label>:المستوى </label></dt><dd><strong>محترف</strong></dd>
	 
 @elseif(($user->score >= 1025)&&($user->score <= 2048))
  <dt><label>:المستوى </label></dt><dd><strong>خبير</strong></dd>
	 
 @elseif(($user->score >= 2049)&&($user->score <= 4096))
  <dt><label>:المستوى </label></dt><dd><strong>مستشار</strong></dd>
	 
 @elseif(($user->score >= 4097)&&($user->score <= 8192))
  <dt><label>:المستوى </label></dt><dd><strong>عالم</strong></dd>
	 
 @elseif($user->score > 8192)
  <dt><label>:المستوى </label></dt><dd><strong> مخضرم </strong></dd>
 @endif
 
  
  
  
  
  
  
  @if ($user->nickname)
    <dt><label>Nickname:</label></dt><dd><span>{!! $user->nickname !!}</span></dd>
  @endif

  @if ($user->realname)
    <dt class="adr"><label> {!! trans('hifone.users.realname') !!}:</label></dt><dd><span class="org">{!! $user->realname !!}</span></dd>
  @endif

  @if ($user->company)
    <dt class="adr"><label> {!! trans('hifone.users.company') !!}:</label></dt><dd><span class="org">{!! $user->company !!}</span></dd>
  @endif

  @if ($user->city)
    <dt class="adr"><label> {!! trans('hifone.users.city') !!}:</label></dt><dd><span class="org"><i class="fa fa-map-marker"></i> {!! $user->city !!}</span></dd>
  @endif

  @if ($user->personal_website)
  <dt><label>{!! trans('hifone.users.blog') !!}:</label></dt>
  <dd>
    <a href="http://{!! $user->personal_website !!}" rel="nofollow" target="_blank" class="url">
      <i class="fa fa-globe"></i> {!! str_limit($user->personal_website, 22) !!}
    </a>
  </dd>
  @endif
  
  @if ($user->signature)
    <dt><label>{{ trans('hifone.users.signature') }}:</label></dt><dd><span>{!! $user->signature !!}</span></dd>
  @endif
</dl>
<div class="clearfix"></div>
@if (Auth::check())
  @if (Auth::user() && (Auth::user()->id == $user->id || Entrust::can('manage_users')))
    <a class="btn btn-primary btn-block" href="{!! route('user.edit', $user->id) !!}" id="user-edit-button">
      <i class="fa fa-edit"></i> التعديل
    </a>
    @if(isset($providers))
    @foreach($providers as $provider)
      @if(in_array($provider->id, $bind_oauth_ids))
       <a class="btn btn-default btn-block" data-method='post' data-url="/users/{{$user->id}}/unbind?provider_id={{ $provider->id }}" id="user-edit-button">
      <i class="fa fa-minus"></i> {{ trans('hifone.login.oauth.unbound', ['provider' => $provider->name]) }}
    </a>
      @else
     <a class="btn btn-success btn-block" href="/auth/{{ $provider->slug }}" id="user-edit-button">
      <i class="{{ $provider->icon ? $provider->icon : 'fa fa-plus' }}"></i> {{ trans('hifone.login.oauth.bound', ['provider' => $provider->name]) }}
    </a>
      @endif
    @endforeach
    @endif
  @endif
@endif

@if (Auth::check())
  @if (Auth::user() && Entrust::can('manage_users') && (Auth::user()->id != $user->id))
    <a data-method="post" class="btn btn-{!! $user->is_banned ? 'warning' : 'danger' !!} btn-block" href="javascript:void(0);" data-url="{!! route('user.blocking', $user->id) !!}" id="user-edit-button" onclick=" return confirm('Are you sure?')">
      <i class="fa fa-times"></i> {!! $user->is_banned ? trans('hifone.users.unblock') : trans('hifone.users.block') !!}
    </a>
  @endif
@endif
