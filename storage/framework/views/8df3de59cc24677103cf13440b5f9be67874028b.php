
 <?php if(count($subthreads) >0): ?>

	<ul class="list-group row thread-list">
	
    <?php foreach($subthreads as  $randq): ?>
	
	<li class="list-group-item media " style="margin-top: 0px;">
	<a class="pull-right" href="<?php echo e(route('thread.show', [$randq->id])); ?>" >
            <span class="badge badge-reply-count"> <?php echo e($randq->reply_count); ?> </span>
        </a>

        <div class="avatar pull-left">
           
        </div>
	
	  <div class="infos">
	
	
	
	
	
	 <div class="media-heading">
	 
	 
	
	
	 <a href="<?php echo e(route('thread.show', [$randq->id])); ?>" title="<?php echo e($randq->title); ?>">
                <?php echo e($randq->title); ?>

				
				 <?php if($randq->best_answer != 0): ?>
                    
		   
				<i class="fa fa-check" aria-hidden="true"></i>
				
				
               
				
                
				
				
            <?php endif; ?>
            </a>
			
			</div>
			
			
	<div class="media-body meta">
            <?php if($randq->like_count > 0): ?>
                <a href="<?php echo e(route('thread.show', [$randq->id])); ?>" class="remove-padding-left" id="pin-<?php echo e($randq->id); ?>">
                    <span class="fa fa-thumbs-o-up"> <?php echo e($randq->like_count); ?> </span>
                </a>
                <span> • </span>
            <?php endif; ?>

            
			
			
			
			
			<!-- Add USERNAMES-->
			
          
		   
		   <?php 
		   
		   $auth=null;
  
 ?>
		   
		   <?php foreach($authors as $author): ?>
		   
		   
		   
		   <?php if($randq->user_id == $author->id): ?>
			   
		   <?php 
   $auth=$author->username;
   $authid=$author->id;
 ?>

<?php endif; ?>
		   <?php endforeach; ?>
		   
		    <span> • </span>
		  <a href=" user/<?php echo e($authid); ?>"> <?php echo e($auth); ?> </a>
			<span class="timeago <?php echo e($randq->created_at); ?>" data-toggle="tooltip" data-placement="top" title="<?php echo e($randq->created_at); ?>"><?php echo e($randq->created_at); ?></span>
			<span class=" <?php echo e($randq->points); ?>" data-toggle="tooltip" data-placement="top" title="<?php echo e($randq->points); ?>"><?php echo e($randq->points); ?> points</span>
			
         
          </div>

			
			
			
			</li>
	
	
	
	<?php endforeach; ?>
	</ul>
	
<?php endif; ?>
