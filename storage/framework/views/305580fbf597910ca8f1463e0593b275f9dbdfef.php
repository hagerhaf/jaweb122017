<?php if(Auth::user() !=null): ?>


<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
<script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
	

<?php $__env->startSection('title'); ?>
<?php echo e($user->username); ?> <?php echo e(trans('hifone.users.info')); ?>_@parent
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>



<div class="users-show">

  <div class="col-md-3 box">
    <?php echo $__env->make('users.partials.basicinfo', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  </div>

  <div class="col-md-9 left-col">

    <?php if($user->is_banned): ?>
      <div class="text-center alert alert-info"><b><?php echo e(trans('hifone.users.is_banned')); ?></b></div>
    <?php endif; ?>

    <div class="panel panel-default">
        <div class="panel-body">
          <?php echo $__env->make('users.partials.infonav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        
            <div class="user-card">
                <div class="header pull-right">
                  <a class="avatar" href="<?php echo e($user->url); ?>" target="_blank"><img  src="<?php echo e($user->avatar); ?>"><strong><span><?php echo e('@'.$user->username); ?></span></strong><br><br></a>
<br>   <br><br>              
				 <?php if($current_user && $current_user->id != $user->id && $current_user->is_banned == 0): ?>
					   
				  <?php if($is_blocked != null): ?> 
					   <b style="color:red;">لا يمكنك التواصل مع هذا المستعمل </b>
				   <?php else: ?>
					     <a class=" msg" href="../messages/<?php echo e($user->id); ?>" data-type="User" data-id="<?php echo e($user->id); ?>" data-url="">
                         <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored pull-right"> <i class="fa fa-minus"></i> ارسل رسالة</button>
						 
                      </a>
				   
				  <?php endif; ?>
					<br><br><br>
				 <?php if( $subto ==1): ?>
                     
					  
					  <form method="post" action="../user/<?php echo e($user->id); ?>/unfollow" class="pull-right" >
		
								<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                            <input type="hidden" name="_method" value="DELETE" />
		<button type="submit" id="completed-task" class="fabutton mdl-button mdl-js-button mdl-button--raised mdl-button--colored pull-right"   title="عدم الاتباع">
		  <i class="fa fa-check" aria-hidden="true"  title="عدم الاتباع" >عدم الاتباع</i></button>
		</form>	
					  
                    <?php else: ?>
                      <form method="post" action="../user/<?php echo e($user->id); ?>/follow" class="pull-right" >
		
								<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                            <input type="hidden" name="_method" value="POST" />
		<button type="submit" id="completed-task" class="fabutton mdl-button mdl-js-button mdl-button--raised mdl-button--colored pull-right"   title="اتباع">
		  <i class="fa fa-plus" aria-hidden="true"  title="اتباع" >اتباع</i></button>
		</form>	
                    <?php endif; ?>
&#9; &#9;<br><br>
<br>				<?php if($has_blocked == null ): ?>
	   <form method="post" action="<?php echo e($user->id); ?>/blok" >
		
								<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                            <input type="hidden" name="_method" value="POST" />
		<button type="submit" id="completed-task" class="fabutton mdl-button mdl-js-button mdl-button--raised mdl-button--colored pull-right"   title="حظر">
		  <i class="fa fa-ban" aria-hidden="true"  title="حظر" >حظر</i></button>
		</form>	
		
		
		<?php else: ?>
		
		<form method="post" action="<?php echo e($user->id); ?>/unblok" >
		
								<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                            <input type="hidden" name="_method" value="DELETE" />
		<button type="submit" id="completed-task" class="fabutton mdl-button mdl-js-button mdl-button--raised mdl-button--colored pull-right"   title="رفع الحظر">
		  <i class="fa fa-ban" aria-hidden="true"  title="رفع الحظر" >رفع الحظر</i></button>
		</form>	
					  
					  <?php endif; ?>
					  
					  
					  
					  
					  
					<br>  
					  
					  
                  
					
					
					
					
                  <?php endif; ?>
				  
				 
				  
                </div>
				<br><br>
                <ul class="status">
                  <li><a href="<?php echo route('user.threads', $user->id); ?>"><strong><?php echo e($user->thread_count); ?></strong>الاسئلة</a></li>
                  <li><a href="<?php echo route('user.replies', $user->id); ?>"><strong><?php echo e($user->reply_count); ?></strong>الاجوبة</a></li>
				  <li><a href=""><strong><?php echo e($followed->count()); ?></strong>يتبع</a></li>
                  <li><a href="#"><strong><?php echo e($followers->count()); ?></strong>المتابعين</a></li>
				 
                </ul>
                <div class="footer">
                <?php echo e($user->bio); ?>

                </div>
        </div>
    </div>
  </div>
</div>
</div>



<?php $__env->stopSection(); ?>


<?php else: ?>
	
 <div class="warning"><br><h1 class="error">عذرا عليك الولوج حتى تستطيع التصفح</h1></div>
 <style>
 .warning{
	 
	 background-color:white;
	 margin-left: auto;
	 margin-right: auto;
 }
 .error{
	 text-align: center; 

 }
 .fa-frown-o{
	 font-size:7em;
	 text-align: center; 
	 
 }
 </style>

<?php endif; ?>
<?php echo $__env->make('layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>