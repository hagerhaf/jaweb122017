
<?php if(count($threads)): ?>

	<ul class="list-group row thread-list">
	    <?php 
		   
		   $auth=null;
  
 ?>
    <?php foreach($threads as  $thread): ?>
	
	 <?php foreach($authors as $author): ?>
		   
		   
		   
		   <?php if($thread->user_id == $author->id): ?>
			 
		 <?php 
		   
		   $auth=$author;
  
 ?> 
		   
		   <?php endif; ?>
		   <?php endforeach; ?>
	<li class="list-group-item media " style="margin-top: 0px;">
	<a class="pull-right" href="<?php echo e(route('thread.show', [$thread->id])); ?>" >
            <span class="badge badge-reply-count"> <?php echo e($thread->reply_count); ?> </span>
        </a>

        <div class="avatar pull-left">
            <a href="">
                <img class="media-object img-thumbnail avatar-48" alt="" src="<?php echo e($author->avatar_url); ?>"/>
            </a>
        </div>
	
	  <div class="infos">
	
	
	
	
	
	 <div class="media-heading">
	 
	 
	 <?php if($thread->is_excellent !=0 && !Input::get('filter') && Route::currentRouteName() != 'excellent' ): ?>
                <i class="<?php echo e($thread->icon); ?>"></i>
           
            <?php endif; ?>
	 
	
	 <a href="<?php echo e(route('thread.show', [$thread->id])); ?>" title="<?php echo e($thread->title); ?>">
                <?php echo e($thread->title); ?>

				 <?php if($thread->best_answer != 0): ?>
                    
		   
				<i class="fa fa-check" aria-hidden="true"></i>
				
				
               
				
                
				
				
            <?php endif; ?>
            </a>
			
			</div>
			
			
	<div class="media-body meta">
            <?php if($thread->like_count > 0): ?>
                <a href="<?php echo e(route('thread.show', [$thread->id])); ?>" class="remove-padding-left" id="pin-<?php echo e($thread->id); ?>">
                    <span class="fa fa-thumbs-o-up"> <?php echo e($thread->like_count); ?> </span>
                </a>
                <span> • </span>
            <?php endif; ?>

            <?php if(!isset($node)): ?>
            <a href="" title="" <?php echo e($thread->like_count == 0 || 'class="remove-padding-left"'); ?>>
                <!-- Add NODE NAME-->
            </a>
            <span> • </span>
                <!-- <span> • </span> -->
            <?php endif; ?>
             <!-- Add TAG LIST-->
            <?php if($thread->reply_count == 0): ?>
                    
		   
				
				
				
               
				
                
				
				
            <?php endif; ?>
			
			
			
			
			<!-- Add USERNAMES-->
			
          
		   
		   <?php 
		   
		   $auth=null;
  
 ?>
		   
		   <?php foreach($authors as $author): ?>
		   
		   
		   
		   <?php if($thread->user_id == $author->id): ?>
			   
		   <?php 
   $auth=$author->username;
   $authid=$author->id;
 ?>

<?php endif; ?>
		   <?php endforeach; ?>
		   
		    <span> • </span>
			<?php if($thread->anonymous == 0): ?>
		  <a href=" user/<?php echo e($authid); ?>"> <?php echo e($auth); ?> </a>
	  <?php else: ?>
	   <a href=""> مجهول </a>
	  <?php endif; ?>
			<span class="timeago <?php echo e($thread->created_at); ?>" data-toggle="tooltip" data-placement="top" title="<?php echo e($thread->created_at); ?>"><?php echo e($thread->created_at); ?></span>
			<span class=" <?php echo e($thread->points); ?>" data-toggle="tooltip" data-placement="top" title="<?php echo e($thread->points); ?>"><?php echo e($thread->points); ?> points</span>
			
            <?php if($thread->reply_count > 0 && count($thread->last_reply_user_id)): ?>
               
                <span> • </span>
                <span class="timeago <?php echo e($thread->created_at); ?>" data-toggle="tooltip" data-placement="top" title="<?php echo e($thread->updated_at); ?>"><?php echo e($thread->updated_at); ?></span>
            <?php endif; ?>
          </div>

			
			
			
			</li>
	
	
	
	<?php endforeach; ?>
	</ul>
	
	<?php endif; ?>
