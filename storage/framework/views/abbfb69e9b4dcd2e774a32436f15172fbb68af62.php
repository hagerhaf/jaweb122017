<div class="col-md-3 side-bar">
  <?php if(Auth::check()): ?>
  <div class="panel panel-default corner-radius">
      
    <div class="panel-body text-center">
	
      <div class="btn-group">
	  <?php if(Auth::user()->is_banned == 0): ?>
        <a href="<?php echo isset($node) ? URL::route('thread.create') : URL::route('thread.create') ;; ?>" class="btn btn-primary">
          <i class="fa fa-pencil"> </i> اطرح سوالا
        </a>
		<?php else: ?>
			لقد تم سجنك
		<?php endif; ?>
        <?php if($new_thread_dropdowns): ?>
        <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
          <?php echo $new_thread_dropdowns; ?>

        </ul>
        <?php endif; ?>
      </div>
    </div>
  </div>
  
   
	
	<div class="panel panel-default corner-radius">
    <div class="panel-heading">
      <h3 class="panel-title">افضل مستعمل</h3>
    </div>
<div class="panel-body">
      <table class="table table-striped">
      <tbody>
     
        <tr>
        <td style="text-align: center;"><div class="avatar">
               
              
        </div></td>
        <td style="vertical-align: middle; font-size: 80%;">
            
        <i class="fa fa-star"></i>        <a href="<?php echo e(route('user.home',$best_user->username)); ?>"><?php echo e($best_user->username); ?></a>
           
        <td>
        <td style="vertical-align: middle;"><small data-toggle="tooltip" data-placement="top" title="<?php echo e($best_user->score); ?>"><?php echo $best_user->score; ?></small></td>
        </tr>
     
      </tbody>
      </table>
    </div>
</div>

	
	
  
  
  
    <?php if(Config::get('setting.module_active_pms')): ?>
    <div class="panel panel-default corner-radius">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo e(trans('hifone.pms.pms')); ?></h3>
        </div>
        <div class="panel-body text-center">
            <div class="btn-group">
                <a href="<?php echo URL::route('messages.create'); ?>" class="btn btn-primary">
                    <i class="fa fa-pencil"> </i> <?php echo trans('hifone.pms.create'); ?>

                </a>
            </div>
            <br><br>
            <div class="btn-group">
                <a href="<?php echo URL::route('messages.index'); ?>" class="btn btn-primary">
                    <i> </i> <?php echo trans('hifone.pms.nav_inbox'); ?>

                </a>
            </div>
        </div>
    </div>
    <?php endif; ?>
  <?php else: ?>
  <div class="panel panel-default corner-radius">
    <div class="panel-heading">
      <h3 class="panel-title"> </h3>
    </div>
    <div class="panel-body text-center">
        <a href="/auth/register" class="btn btn-primary">
          <i class="fa fa-user"> </i> التسجيل
        </a>
    </div>
    <div class="panel-footer text-center">
      للمستعملين القدماء <a href="/auth/login">الولوج</a>
    </div>
  </div>
  <?php endif; ?>

<?php echo e(Widget::Adblock(['slug' => 'sidebar_top', 'template'=>'sidebar'])); ?>


<?php if(Request::is('/')): ?>
<div class="panel panel-default corner-radius">
    <div class="panel-heading">
      <h3 class="panel-title">الترتيب</h3>
    </div>
    <div class="panel-body">
      <table class="table table-striped">
      <tbody>
      <?php foreach($top_users as $index => $user): ?>
        <tr>
        <td style="text-align: center;"><div class="avatar">
                <?php if($user->nickname): ?>
                    <a href="<?php echo e(route('user.home',$user->username)); ?>"><img class="media-object img-thumbnail avatar-32" alt="<?php echo e($user->nickname); ?>" src="<?php echo e($user->avatar); ?>"></a>
                <?php else: ?>
                    <a href="<?php echo e(route('user.home',$user->username)); ?>"><img class="media-object img-thumbnail avatar-32" alt="<?php echo e($user->username); ?>" src="<?php echo e($user->avatar); ?>"></a>
                <?php endif; ?>
        </div></td>
        <td style="vertical-align: middle; font-size: 80%;">
            <?php if($user->nickname): ?>
                <a href="<?php echo e(route('user.home',$user->username)); ?>"><?php echo e($user->nickname); ?></a>
            <?php else: ?>
                <a href="<?php echo e(route('user.home',$user->username)); ?>"><?php echo e($user->username); ?></a>
            <?php endif; ?>
        <td>
        <td style="vertical-align: middle;"><small data-toggle="tooltip" data-placement="top" title="<?php echo e($user->somaa); ?>"><?php echo $user->somaa; ?></small></td>
        </tr>
      <?php endforeach; ?>
      </tbody>
      </table>
    </div>	
</div>

<div class="panel panel-default corner-radius">
    <div class="panel-heading">
      <h3 class="panel-title">اصحاب افضل الاجوبة</h3>
    </div>
    <div class="panel-body">
      <table class="table table-striped">
      <tbody>
	  <?php if($bestanswerers != null): ?>
      <?php foreach($bestanswerers as $index => $user): ?>
        <tr>
        <td style="text-align: center;"><div class="avatar">
                <?php if($user->nickname): ?>
                    <a href="<?php echo e(route('user.home',$user->username)); ?>"><img class="media-object img-thumbnail avatar-32" alt="<?php echo e($user->nickname); ?>" src="<?php echo e($user->avatar_url); ?>"></a>
                <?php else: ?>
                    <a href="<?php echo e(route('user.home',$user->username)); ?>"><img class="media-object img-thumbnail avatar-32" alt="<?php echo e($user->username); ?>" src="<?php echo e($user->avatar_url); ?>"></a>
                <?php endif; ?>
        </div></td>
        <td style="vertical-align: middle; font-size: 80%;">
            <?php if($user->nickname): ?>
                <a href="<?php echo e(route('user.home',$user->username)); ?>"><?php echo e($user->nickname); ?></a>
            <?php else: ?>
                <a href="<?php echo e(route('user.home',$user->username)); ?>"><?php echo e($user->username); ?></a>
            <?php endif; ?>
        <td>
        <td style="vertical-align: middle;"><small data-toggle="tooltip" data-placement="top" title="عدد افضل الاجابات"><?php echo $user->ba; ?></small></td>
        </tr>
      <?php endforeach; ?>
	  <?php else: ?> 
		  
	  <?php endif; ?>
      </tbody>
      </table>
    </div>	
</div>





<div class="panel panel-default corner-radius">
    <div class="panel-heading">
      <h3 class="panel-title">ترتيب حسب السمعة</h3>
    </div>
<div class="panel-body">
      <table class="table table-striped">
      <tbody>
      <?php foreach($top_users as $index => $user): ?>
        <tr>
        <td style="text-align: center;"><div class="avatar">
                <?php if($user->nickname): ?>
                    <a href="<?php echo e(route('user.home',$user->username)); ?>"><img class="media-object img-thumbnail avatar-32" alt="<?php echo e($user->nickname); ?>" src="<?php echo e($user->avatar); ?>"></a>
                <?php else: ?>
                    <a href="<?php echo e(route('user.home',$user->username)); ?>"><img class="media-object img-thumbnail avatar-32" alt="<?php echo e($user->username); ?>" src="<?php echo e($user->avatar); ?>"></a>
                <?php endif; ?>
        </div></td>
        <td style="vertical-align: middle; font-size: 80%;">
            <?php if($user->nickname): ?>
                <a href="<?php echo e(route('user.home',$user->username)); ?>"><?php echo e($user->nickname); ?></a>
            <?php else: ?>
                <a href="<?php echo e(route('user.home',$user->username)); ?>"><?php echo e($user->username); ?></a>
            <?php endif; ?>
        <td>
        <td style="vertical-align: middle;"><small data-toggle="tooltip" data-placement="top" title="<?php echo e($user->score); ?>"><?php echo $user->score; ?></small></td>
        </tr>
      <?php endforeach; ?>
      </tbody>
      </table>
    </div>
</div>




<?php endif; ?>

<?php echo e(Widget::Adblock(['slug' => 'sidebar_middle', 'template'=>'sidebar'])); ?>


<?php if(isset($nodeThreads) && count($nodeThreads)): ?>
  <div class="panel panel-default corner-radius">
    <div class="panel-heading">
      <h3 class="panel-title"><?php echo trans('hifone.nodes.same_node_threads'); ?></h3>
    </div>
    <div class="panel-body">
      <ul class="list">

        <?php foreach($nodeThreads as $nodeThread): ?>
          <li>
          <a href="<?php echo route('thread.show', $nodeThread->id); ?>">
            <?php echo $nodeThread->title; ?>

          </a>
          </li>
        <?php endforeach; ?>

      </ul>
    </div>
  </div>
<?php endif; ?>



<div class="panel panel-default corner-radius">
  <div class="panel-heading">
    <h3 class="panel-title"><?php echo e(trans('hifone.stats.title')); ?></h3>
  </div>
    <ul class="list-group">
      <li class="list-group-item"><?php echo e(trans('hifone.stats.users')); ?>: <?php echo e($stats['user_count']); ?> </li>
      <li class="list-group-item"><?php echo e(trans('hifone.stats.threads')); ?>: <?php echo e($stats['thread_count']); ?></li>
      <li class="list-group-item"><?php echo e(trans('hifone.stats.replies')); ?>: <?php echo e($stats['reply_count']); ?></li>
    </ul>
</div>

<?php echo e(Widget::Adblock(['slug' => 'sidebar_bottom', 'template'=>'sidebar'])); ?>


</div>
<div class="clearfix"></div>
