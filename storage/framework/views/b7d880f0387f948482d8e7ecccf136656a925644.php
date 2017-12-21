<?php $__env->startSection('content'); ?>

<div class="col-md-9 main-col">
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo e($node->name); ?></h3>
        </div>
        <div class="panel-body">
		<style>
		.fabutton {
  background: none;
  padding: 0px;
  border: none;
}
		</style>
		
		<?php if($is_sub != 1): ?>
		<form method="post" action="<?php echo e($node->id); ?>" >
		
								<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                            <input type="hidden" name="_method" value="POST" />
		<button type="submit" id="completed-task" class="fabutton"   title="متابعة">
		  <i class="fa fa-eye" aria-hidden="true"  title="متابعة" >متابعة</i></button>
		</form>	
		<?php else: ?>
		 <form method="post" action="<?php echo e($node->id); ?>" >
		
								<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                            <input type="hidden" name="_method" value="DELETE" />
		<button type="submit" id="completed-task" class="fabutton"   title="الغاء">
		  <i class="fa fa-eye" aria-hidden="true"  title="الغاء" >  الغاء المتابعة</i></button>
		</form>	
		<?php endif; ?>
		  <span class="pull-right text-right">
          <?php echo e($node->created_at); ?> <br>
         <?php echo e($node->thread_count); ?>	عدد الاسئلة <br>	  
         <?php echo e($node->reply_count); ?>		عدد الاجوبة  <br>	
         <?php echo e($subs); ?>   عدد المشاركين <br>	
		 <?php echo e($node->visits); ?>  عدد الزيارات<br>
		   </span class="pull-right text-right">
		 
        </div>
    </div>
   
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title"><span class="pull-right text-right">الاسئلة </span></h3>
        </div>
        <div class="panel-body">
           
            <ul class="media-list">
               <?php foreach($threads as $thread): ?>
                <li class="media section">
                    
                    <span class="pull-right text-right"><h4><a href="../thread/<?php echo e($thread->id); ?>"><?php echo e($thread->title); ?></a></h4></span>
                    <div class="media-body">
                        <h4 class="media-heading"><a href=""></a></h4>
                        <p class="text-muted">
                           
                        </p>
                    </div>
                </li>
               <?php endforeach; ?>
            </ul>
           
        </div>
    </div>
	
	
	
	<div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title"><span class="pull-right text-right">المشاركون </span></h3>
        </div>
        <div class="panel-body">
           
            <ul class="media-list">
               <?php foreach($users as $user): ?>
                <li class="media section">
                    <div class="avatar pull-right">
                            <a href="../user/<?php echo e($user->id); ?>">
                                <img class="media-object img-thumbnail avatar" alt="" src="<?php echo e($user->avatar_url); ?>"  style="width:48px;height:48px;"/> </a>
								<span class="pull-right text-right"><h4><a href="../user/<?php echo e($user->id); ?>"><?php echo e($user->username); ?></a></h4></span>
                           
                        </div>
                    
                    <div class="media-body">
                        <h4 class="media-heading"><a href=""></a></h4>
                        <p class="text-muted">
                           
                        </p>
                    </div>
                </li>
               <?php endforeach; ?>
            </ul>
           
        </div>
    </div>
	
	
	
	
</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>