<ul class="nav nav-tabs" role="tablist" style="width:800px;">
  
  <li class="<?php echo Route::currentRouteName() == 'user.threads' ? 'active' : ''; ?>">
    <a href="<?php echo route('user.threads', $user->id); ?>" >الاسئلة</a>
  </li>
  <li class="<?php echo Route::currentRouteName() == 'user.replies' ? 'active' : ''; ?>">
  	<a href="<?php echo route('user.replies', $user->id); ?>" >الاجابات</a>
  </li>
  <li class="<?php echo Route::currentRouteName() == 'user.favorites' ? 'active' : ''; ?>">
  	<a href="<?php echo route('user.favorites', $user->id); ?>" >المفضلة</a>
  </li>
   <li class="<?php echo Route::currentRouteName() == 'user.subscribed' ? 'active' : ''; ?>">
  	<a href="<?php echo route('user.subscribed', $user->id); ?>" >متبع</a>
  </li>
  
   <li class="<?php echo Route::currentRouteName() == 'user.subscribers' ? 'active' : ''; ?>">
  	<a href="<?php echo route('user.subscribers', $user->id); ?>" >المتابعين</a>
	
	<li class="<?php echo Route::currentRouteName() == 'user.visits' ? 'active' : ''; ?>">
  	<a href="<?php echo route('user.visits', $user->id); ?>" >الزيارات</a>
  </li>
  
  <?php if($user->username == Auth::user()->username): ?>
  <li class="<?php echo Route::currentRouteName() == 'user.blocked' ? 'active' : ''; ?>">
  	<a href="<?php echo route('user.blocked', $user->id); ?>" >المحظورين</a>
  </li>
  
   <li class="<?php echo Route::currentRouteName() == 'user.nodes' ? 'active' : ''; ?>">
  	<a href="<?php echo route('user.nodes', $user->id); ?>" >تصنيفات</a>
  </li>
  
  
  <?php endif; ?>
  
  <li class="<?php echo Route::currentRouteName() == 'user.home' ? 'active' : ''; ?>">
  	<a href="<?php echo $user->url; ?>" >عامة</a>
  </li>
  
</ul>
