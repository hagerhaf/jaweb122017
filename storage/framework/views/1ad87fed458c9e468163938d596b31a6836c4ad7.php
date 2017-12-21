<ul class="list-group row">

			
  <?php foreach($replies as $index => $reply): ?>
  <?php if($thread->best_answer  == $reply->id): ?>  
		<!--BEST ANSWER-->
	
	<li class="list-group-item media <?php echo e($reply->highlight); ?>" id="reply<?php echo e($reply->id); ?>" style="background-color:#a9dac1;">
    <div class="avatar pull-left">
      <a href="<?php echo route('user.show', [$reply->user_id]); ?>">
        <img class="media-object img-thumbnail avatar" alt="<?php echo $reply->user->username; ?>" src="<?php echo $reply->user->avatar_small; ?>"  style="width:48px;height:48px;"/>
      </a>
    </div>
    <div class="infos">

      <div class="media-heading meta">

        <a href="<?php echo route('user.show', [$reply->user_id]); ?>" title="<?php echo $reply->user->username; ?>" class="remove-padding-left author">
           <b> <?php echo $reply->user->username; ?> </b> Best Answerer
        </a>
        <abbr class="timeago" title="<?php echo $reply->created_at; ?>"><?php echo $reply->created_at; ?></abbr>
        <a name="reply<?php echo $thread->replyFloorFromIndex($index); ?>" class="anchor" href="#reply<?php echo $thread->replyFloorFromIndex($index); ?>" aria-hidden="true">#<?php echo $thread->replyFloorFromIndex($index); ?></a>

        <span class="opts pull-right">
          <span >
            <?php if(Auth::user() && (Auth::user()->can("manage_threads") || Auth::user()->id == $reply->user_id) ): ?>
            <a class="fa fa-trash-o" id="reply-delete-<?php echo $reply->id; ?>" data-method="delete"  href="javascript:void(0);" data-url="<?php echo route('reply.destroy', [$reply->id]); ?>" title="<?php echo trans('forms.delete'); ?>"></a>
          <?php endif; ?>
		  
		  
		  
		  <?php if( Auth::user() && (Auth::user()->can("manage_replies") || Auth::user()->id == $reply->user_id) ): ?>
      <a id="reply-append-button" href="javascript:void(0);" title="<?php echo e(trans('hifone.appends.appends')); ?>" class="admin" data-toggle="modali" data-target="#exampleModal21">
        <i class="fa fa-plus"></i>
      </a>
	  <br>

	  
	  <div class="modal fade" id="exampleModal2" tabindex="-1" role="" aria-labelledby="exampleModalLabel2" >
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel2"><?php echo e(trans('hifone.appends.content')); ?></h4>
      </div>

     <?php echo Form::open(['route' => ['reply.edit', $reply->id],'method' => 'post']); ?>


        <div class="modal-body">

          <div class="alert alert-warning">
              <?php echo e(trans('hifone.appends.notice')); ?> 
          </div>

          <div class="form-group">
            <?php echo Form::textarea('content', null, ['class' => 'form-control',
                                                'style' => 'min-height:20px',
                                          'placeholder' => trans('hifone.markdown_support')	]); ?>


          </div>

          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo e(trans('forms.close')); ?></button>
            <button type="submit" class="btn btn-primary"><?php echo e(trans('forms.submit')); ?></button>
          </div>

      <?php echo Form::close(); ?>


    </div>
  </div>
</div>
	  
    <?php endif; ?>
		  
		  
		 
            <a class="fa fa-reply btn-reply2reply" data-floor=<?php echo e($index + 1); ?> data-username="<?php echo e($reply->user->username); ?>" href="#" title="<?php echo $reply->user->username; ?> اجابة "></a>
          </span>
		  
		   <?php if(Auth::user()->id != $reply->user_id): ?>
			   
        
		  <form method="post" action="<?php echo e($reply->id); ?>/like" >
		
								<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                            <input type="hidden" name="_method" value="POST" />
		<button type="submit" id="completed-task" class="fabutton"   title="اعجبني">
		  <i class="likeable fa fa-thumbs-o-up" aria-hidden="true"  title="اعجبني" >اعجبني</i></button>
		</form>	
					  
		
		  
		  
        </span>
		<?php endif; ?>

      </div>

      <div class="media-body markdown-reply content-body">
    <b>  <?php echo $reply->body; ?> </b>
      </div>
    </div>
	</li>
	
	
	
	<!--BEST ANSWER-->	
		<?php endif; ?>

<?php endforeach; ?>
		
		
		
		
  <?php foreach($replies as $index => $reply): ?>
  
  
		
  
  
   <li class="list-group-item media <?php echo e($reply->highlight); ?>" id="reply<?php echo e($reply->id); ?>">
    <div class="avatar pull-left">
      <a href="<?php echo route('user.show', [$reply->user_id]); ?>">
        <img class="media-object img-thumbnail avatar" alt="<?php echo $reply->user->username; ?>" src="<?php echo $reply->user->avatar_small; ?>"  style="width:48px;height:48px;"/>
      </a>
    </div>
    <div class="infos">

      <div class="media-heading meta">

        <a href="<?php echo route('user.show', [$reply->user_id]); ?>" title="<?php echo $reply->user->username; ?>" class="remove-padding-left author">
            <?php echo $reply->user->username; ?>

        </a><span><?php echo $reply->credentials; ?></span>
        <abbr class="timeago" title="<?php echo $reply->created_at; ?>"><?php echo $reply->created_at; ?></abbr>
        <a name="reply<?php echo $thread->replyFloorFromIndex($index); ?>" class="anchor" href="#reply<?php echo $thread->replyFloorFromIndex($index); ?>" aria-hidden="true">#<?php echo $thread->replyFloorFromIndex($index); ?></a>

        <span class="opts pull-right">
          <span >
		  
		  
            <?php if(Auth::user() && (Auth::user()->can("manage_threads") || Auth::user()->id == $reply->user_id) ): ?>
				
			<form method="POST" action="/reply/<?php echo e($reply->id); ?>/delete">
                            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                            <input type="hidden" name="_method" value="DELETE" />
                            <button type="submit" class="fabutton">
                              <i class="fa fa-trash-o"></i>
                            </button>
							
							<style>
		.fabutton {
  background: none;
  padding: 0px;
  border: none;
  font-size:15px;
}
		</style>
                        </form>
		  <?php endif; ?>
		  
		  <?php if(  $thread->user_id == Auth::user()->id ): ?>
			  <form method="post" action="/reply/<?php echo e($reply->id); ?>/best">
		
								<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                            <input type="hidden" name="_method" value="POST" />
		<button type="submit" id="completed-task" class="fabutton">
		  <i class="fa fa-check" aria-hidden="true" title="افضل اجابة" ></i></button>
		</form>
	       <?php endif; ?>
		   
		   <?php if(  $reply->user_id != Auth::user()->id ): ?>
		<form method="post" action="/reply/<?php echo e($reply->id); ?>/report">
		
								<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                            <input type="hidden" name="_method" value="POST" />
		<button type="submit" id="completed-task" class="fabutton">
<i class="fa fa-flag"   aria-hidden="true" title="الابلاغ "></i></button>
		<style>
		.fabutton {
  background: none;
  padding: 0px;
  border: none;
}
		</style>
	       
	</form>
		 
		  
		  <?php endif; ?>
		  
		   <?php if(Auth::user()->id != $reply->user_id): ?>
			   
        
		 <form method="post" action="/reply/<?php echo e($reply->id); ?>/like" >
		<?php echo e($reply->like_count); ?> 
								<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                            <input type="hidden" name="_method" value="POST" />
		<button type="submit" id="completed-task" class="fabutton"   title="اعجبني">
		  <i class="likeable fa fa-thumbs-o-up" aria-hidden="true"  title="اعجبني" ></i></button>
		</form>	
					  
		
		  
		  
       
		<?php endif; ?>
		  
		  
		  <?php if( Auth::user() && (Auth::user()->can("manage_replies") || Auth::user()->id == $reply->user_id) ): ?>
      <a id="reply-append-button" href="javascript:void(0);" title="<?php echo e(trans('hifone.appends.appends')); ?>" class="admin" data-toggle="modal" data-target="#exampleModal">
        <i class="fa fa-plus"></i>
      </a>
<br>
    <?php endif; ?>
		  
            <a class="fa fa-reply btn-reply2reply" data-floor=<?php echo e($index + 1); ?> data-username="<?php echo e($reply->user->username); ?>" href="#" title="<?php echo $reply->user->username; ?> اجابة "></a>
          </span>
		  <?php if(Auth::user()->id != $reply->user_id): ?>
         <!--  <a class="likeable fa fa-thumbs-o-up" data-action="like" data-url="" data-type="Reply" data-id="<?php echo e($reply->id); ?>" data-count="<?php echo $reply->like_count ?: 0; ?>" href="javascript:void(0);" title="<?php echo trans('hifone.like'); ?>"> <?php echo $reply->like_count ?: ''; ?>

          </a> -->
		  <?php endif; ?>
        </span>

      </div>

      <div class="media-body markdown-reply content-body">
      <?php echo $reply->body; ?>

      </div>
    </div>
  </li>
  <?php endforeach; ?>
</ul>