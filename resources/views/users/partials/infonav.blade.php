<ul class="nav nav-tabs" role="tablist" style="width:800px;">
  
  <li class="{!! Route::currentRouteName() == 'user.threads' ? 'active' : '' !!}">
    <a href="{!! route('user.threads', $user->id) !!}" >الاسئلة</a>
  </li>
  <li class="{!! Route::currentRouteName() == 'user.replies' ? 'active' : '' !!}">
  	<a href="{!! route('user.replies', $user->id) !!}" >الاجابات</a>
  </li>
  <li class="{!! Route::currentRouteName() == 'user.favorites' ? 'active' : '' !!}">
  	<a href="{!! route('user.favorites', $user->id) !!}" >المفضلة</a>
  </li>
   <li class="{!! Route::currentRouteName() == 'user.subscribed' ? 'active' : '' !!}">
  	<a href="{!! route('user.subscribed', $user->id) !!}" >متبع</a>
  </li>
  
   <li class="{!! Route::currentRouteName() == 'user.subscribers' ? 'active' : '' !!}">
  	<a href="{!! route('user.subscribers', $user->id) !!}" >المتابعين</a>
	
	<li class="{!! Route::currentRouteName() == 'user.visits' ? 'active' : '' !!}">
  	<a href="{!! route('user.visits', $user->id) !!}" >الزيارات</a>
  </li>
  
  @if($user->username == Auth::user()->username)
  <li class="{!! Route::currentRouteName() == 'user.blocked' ? 'active' : '' !!}">
  	<a href="{!! route('user.blocked', $user->id) !!}" >المحظورين</a>
  </li>
  
   <li class="{!! Route::currentRouteName() == 'user.nodes' ? 'active' : '' !!}">
  	<a href="{!! route('user.nodes', $user->id) !!}" >تصنيفات</a>
  </li>
  
  
  @endif
  
  <li class="{!! Route::currentRouteName() == 'user.home' ? 'active' : '' !!}">
  	<a href="{!! $user->url !!}" >عامة</a>
  </li>
  
</ul>
