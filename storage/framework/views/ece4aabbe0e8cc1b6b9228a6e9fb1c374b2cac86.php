<div style="text-align: center;">
    <img src="<?php echo e($user->avatar); ?>" class="img-thumbnail users-show-avatar upload-btn" style="width: 206px;margin: 4px 4px 15px;min-height:190px;cursor: pointer;">
</div>

<dl class="dl-horizontal">

 

  <dt><strong><?php echo $user->username; ?></strong></dt><dd><label>:الاسم المستعار</label></dd>

  <?php if($user->hasBadge): ?>
    <dt><span class="label label-warning"><?php echo $user->badgeName; ?></span></dt><dd><label>الدور</label></dd>
  <?php endif; ?>

 
 
   
  <dt><strong><?php echo $user->score; ?></strong></dt><dd><label>:النقاط  </label></dd>
  <dt><strong><?php echo $user->somaa; ?></strong></dt><dd><label>:السمعة</label></dd>
   
  <?php if($user->score <= 32): ?>
  <dt><strong>جديد</strong></dt><dd><label>:المستوى </label></dd>
  <?php elseif(($user->score >= 33)&&($user->score <= 64)): ?>
   <dt><strong>مبتدئ</strong></dt><dd><label>:المستوى </label></dd>
  
	 <?php elseif(($user->score >= 65)&&($user->score <= 128)): ?>
	    <dt><strong>نشط</strong></dt><dd><label>:المستوى </label></dd>
  
 <?php elseif(($user->score >= 129)&&($user->score <= 256)): ?>
    <dt><strong>هاوٍ</strong></dt><dd><label>:المستوى </label></dd>
  
 <?php elseif(($user->score >= 257)&&($user->score <= 512)): ?>
    <dt><strong>متمكن</strong></dt><dd><label>:المستوى </label></dd>
  
 <?php elseif(($user->score >= 513)&&($user->score <= 1024)): ?>
  <dt><label>:المستوى </label></dt><dd><strong>محترف</strong></dd>
	 
 <?php elseif(($user->score >= 1025)&&($user->score <= 2048)): ?>
  <dt><label>:المستوى </label></dt><dd><strong>خبير</strong></dd>
	 
 <?php elseif(($user->score >= 2049)&&($user->score <= 4096)): ?>
  <dt><label>:المستوى </label></dt><dd><strong>مستشار</strong></dd>
	 
 <?php elseif(($user->score >= 4097)&&($user->score <= 8192)): ?>
  <dt><label>:المستوى </label></dt><dd><strong>عالم</strong></dd>
	 
 <?php elseif($user->score > 8192): ?>
  <dt><label>:المستوى </label></dt><dd><strong> مخضرم </strong></dd>
 <?php endif; ?>
 
  
  
  
  
  
  
  <?php if($user->nickname): ?>
    <dt><label>Nickname:</label></dt><dd><span><?php echo $user->nickname; ?></span></dd>
  <?php endif; ?>

  <?php if($user->realname): ?>
    <dt class="adr"><label> <?php echo trans('hifone.users.realname'); ?>:</label></dt><dd><span class="org"><?php echo $user->realname; ?></span></dd>
  <?php endif; ?>

  <?php if($user->company): ?>
    <dt class="adr"><label> <?php echo trans('hifone.users.company'); ?>:</label></dt><dd><span class="org"><?php echo $user->company; ?></span></dd>
  <?php endif; ?>

  <?php if($user->city): ?>
    <dt class="adr"><label> <?php echo trans('hifone.users.city'); ?>:</label></dt><dd><span class="org"><i class="fa fa-map-marker"></i> <?php echo $user->city; ?></span></dd>
  <?php endif; ?>

  <?php if($user->personal_website): ?>
  <dt><label><?php echo trans('hifone.users.blog'); ?>:</label></dt>
  <dd>
    <a href="http://<?php echo $user->personal_website; ?>" rel="nofollow" target="_blank" class="url">
      <i class="fa fa-globe"></i> <?php echo str_limit($user->personal_website, 22); ?>

    </a>
  </dd>
  <?php endif; ?>
  
  <?php if($user->signature): ?>
    <dt><label><?php echo e(trans('hifone.users.signature')); ?>:</label></dt><dd><span><?php echo $user->signature; ?></span></dd>
  <?php endif; ?>
</dl>
<div class="clearfix"></div>
<?php if(Auth::check()): ?>
  <?php if(Auth::user() && (Auth::user()->id == $user->id || Entrust::can('manage_users'))): ?>
    <a class="btn btn-primary btn-block" href="<?php echo route('user.edit', $user->id); ?>" id="user-edit-button">
      <i class="fa fa-edit"></i> التعديل
    </a>
    <?php if(isset($providers)): ?>
    <?php foreach($providers as $provider): ?>
      <?php if(in_array($provider->id, $bind_oauth_ids)): ?>
       <a class="btn btn-default btn-block" data-method='post' data-url="/users/<?php echo e($user->id); ?>/unbind?provider_id=<?php echo e($provider->id); ?>" id="user-edit-button">
      <i class="fa fa-minus"></i> <?php echo e(trans('hifone.login.oauth.unbound', ['provider' => $provider->name])); ?>

    </a>
      <?php else: ?>
     <a class="btn btn-success btn-block" href="/auth/<?php echo e($provider->slug); ?>" id="user-edit-button">
      <i class="<?php echo e($provider->icon ? $provider->icon : 'fa fa-plus'); ?>"></i> <?php echo e(trans('hifone.login.oauth.bound', ['provider' => $provider->name])); ?>

    </a>
      <?php endif; ?>
    <?php endforeach; ?>
    <?php endif; ?>
  <?php endif; ?>
<?php endif; ?>

<?php if(Auth::check()): ?>
  <?php if(Auth::user() && Entrust::can('manage_users') && (Auth::user()->id != $user->id)): ?>
    <a data-method="post" class="btn btn-<?php echo $user->is_banned ? 'warning' : 'danger'; ?> btn-block" href="javascript:void(0);" data-url="<?php echo route('user.blocking', $user->id); ?>" id="user-edit-button" onclick=" return confirm('Are you sure?')">
      <i class="fa fa-times"></i> <?php echo $user->is_banned ? trans('hifone.users.unblock') : trans('hifone.users.block'); ?>

    </a>
  <?php endif; ?>
<?php endif; ?>
