<div class="panel-footer operate">

  <div class="pull-left" style="font-size:15px;">
    <a class="" href="http://service.weibo.com/share/share.php?url=<?php echo urlencode(Request::url()); ?>&type=3&pic=&title=<?php echo e($thread->title); ?>" target="_blank" title="<?php echo e(trans('hifone.threads.share2weibo')); ?>">
      <i class="fa fa-weibo"></i>
    </a>
    <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(Request::url()); ?>&text=<?php echo e($thread->title); ?>&via=hifone.com" class=""  target="_blank" title="<?php echo e(trans('hifone.threads.share2twitter')); ?>">
      <i class="fa fa-twitter"></i>
    </a>
    <a href="http://www.facebook.com/sharer.php?u=<?php echo urlencode(Request::url()); ?>" class=""  target="_blank" title="<?php echo e(trans('hifone.threads.share2facebook')); ?>">
      <i class="fa fa-facebook"></i>
    </a>
    <a href="https://plus.google.com/share?url=<?php echo urlencode(Request::url()); ?>" class=""  target="_blank" title="<?php echo e(trans('hifone.threads.share2google')); ?>">
      <i class="fa fa-google-plus"></i>
    </a>
  </div>

  <div class="pull-right">
    <?php if($thread->tagsList): ?>
      <span class="tag-list hidden-xs">
      Tags: 
      <?php foreach($thread->tags as $tag): ?>
      <a href="/tag/<?php echo e(urlencode($tag->name)); ?>"><span class="tag"><?php echo e($tag->name); ?></span></a>
      <?php endforeach; ?>
      </span>
    <?php endif; ?>
	
	
	
	
	
	<?php if($thread->user_id != Auth::user()->id): ?>
    <?php if(($follows != null)): ?>
     <form method="post" action="<?php echo e($thread->id); ?>" >
		
								<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                            <input type="hidden" name="_method" value="DELETE" />
		<button type="submit" id="completed-task" class="fabutton"   title="الغاء">
		  <i class="fa fa-eye" aria-hidden="true"  title="الغاء" >الغاء</i></button>
		</form>	
	  
	 
	  
    <?php else: ?>
      
	  
	  
	   <form method="post" action="<?php echo e($thread->id); ?>" >
		
								<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                            <input type="hidden" name="_method" value="POST" />
		<button type="submit" id="completed-task" class="fabutton"   title="متابعة"">
		  <i class="fa fa-eye" aria-hidden="true"  title="متابعة" >متابعة</i></button>
		</form>	
	  
    <?php endif; ?>

	<?php endif; ?>
	
	<!-- DELETE OR REPORT -->
	
	 <?php if( Auth::user()->username != $thread->user->username): ?>
		
	<form method="post" action="/thread/<?php echo e($thread->id); ?>/report">
		
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
	
	<?php if($later == null): ?>
	<form method="post" action="/thread/<?php echo e($thread->id); ?>/later">
		
								<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                            <input type="hidden" name="_method" value="POST" />
		<button type="submit" id="completed-task" class="fabutton">
<i class="fa fa-clock-o"   aria-hidden="true" title="لاحقا "></i></button>
		
	       
	</form>
	<?php endif; ?>
	
	<?php else: ?>
		
	<form action="<?php echo e($thread->id); ?>/delete" method="POST">
                                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                            <input type="hidden" name="_method" value="DELETE" />
                                <button type="submit" class="btn waves-effect red"><i class="fa fa-trash-o"></i></button> 
                              </form>
							  
							  
							  
							  
		<?php endif; ?>
	
	
	<!-- DELETE OR REPORT -->
	
	<?php if($thread->user_id != Auth::user()->id): ?>
    <?php if(($favorites != null)): ?>
	  
	  <form method="post" action="<?php echo e($thread->id); ?>" >
		
								<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                            <input type="hidden" name="_method" value="DELETE" />
		<button type="submit" id="completed-task" class="fabutton"   >
		  <i id="faved" class="fa fa-bookmark" aria-hidden="true"   ></i><span id="faved">مفضلة</span></button>
		  <style>
		  #faved{
			  color:green;
			  
		  }
		  </style>
		</form>	
	  
    <?php else: ?>
       <form method="post" action="<?php echo e($thread->id); ?>" >
		
								<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                            <input type="hidden" name="_method" value="POST" />
		<button type="submit" id="completed-task" class="fabutton"   >
		  <i class="fa fa-bookmark" aria-hidden="true"   ></i>تثبيت</button>
		</form>	
    <?php endif; ?>
	<?php endif; ?>

    <?php if(Auth::user() && Auth::user()->can("manage_threads") ): ?>
        <a data-method="post" id="thread-recommend-button" href="javascript:void(0);" data-url="<?php echo e(route('thread.recommend', [$thread->id])); ?>" class="admin <?php echo $thread->is_excellent ? 'active' :'';; ?>" title="<?php echo e(trans('hifone.threads.mark_excellent')); ?>">
        <i class="fa fa-trophy"></i>
        </a>

        <?php if($thread->order >= 0): ?>
          <a data-method="post" id="thread-pin-button" href="javascript:void(0);" data-url="<?php echo e(route('thread.pin', [$thread->id])); ?>" class="admin <?php echo $thread->order > 0 ? 'active' : ''; ?>" title="<?php echo e(trans('hifone.threads.mark_stick')); ?>">
            <i class="fa fa-thumb-tack"></i>
          </a>
        <?php endif; ?>

        <?php if($thread->order <= 0): ?>
            <a data-method="post" id="thread-sink-button" href="javascript:void(0);" data-url="<?php echo e(route('thread.sink', [$thread->id])); ?>" class="admin <?php echo $thread->order < 0 ? 'active' : ''; ?>" title="<?php echo e(trans('hifone.threads.mark_sink')); ?>">
                <i class="fa fa-anchor"></i>
            </a>
        <?php endif; ?>

        <a data-method="delete" id="thread-delete-button" href="javascript:void(0);" data-url="<?php echo e(route('thread.destroy', [$thread->id])); ?>"  class="admin <?php echo $thread->order < 0 ? 'active' : ''; ?>">
            <i class="fa fa-trash-o"></i>
        </a>
    <?php endif; ?>

    <?php if( Auth::user() && (Auth::user()->can("manage_threads") || Auth::user()->id == $thread->user_id) ): ?>
      <a id="thread-append-button" href="javascript:void(0);" title="<?php echo e(trans('hifone.appends.appends')); ?>" class="admin" data-toggle="modal" data-target="#exampleModal">
        <i class="fa fa-plus"></i>
      </a>

      <a id="thread-edit-button" href="<?php echo e(route('thread.edit', [$thread->id])); ?>" title="<?php echo e(trans('forms.edit')); ?>" class="admin">
        <i class="fa fa-pencil-square-o"></i>
      </a>
    <?php endif; ?>

  </div>
  <div class="clearfix"></div>
</div>


<div class="modal fade" id="exampleModal" tabindex="-1" role="" aria-labelledby="exampleModalLabel" >
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel"><?php echo e(trans('hifone.appends.content')); ?></h4>
      </div>

     <?php echo Form::open(['route' => ['thread.append', $thread->id],'method' => 'post']); ?>


        <div class="modal-body">

          <div class="alert alert-warning">
              <?php echo e(trans('hifone.appends.notice')); ?>

          </div>

          <div class="form-group">
            <?php echo Form::textarea('content', null, ['class' => 'form-control',
                                                'style' => 'min-height:20px',
                                          'placeholder' => trans('hifone.markdown_support')]); ?>


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
