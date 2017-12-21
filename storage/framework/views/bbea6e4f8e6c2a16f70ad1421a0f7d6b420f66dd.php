<?php if(Auth::user() !=null): ?>


<?php $__env->startSection('title'); ?>
<?php echo e($thread->title); ?> - @parent
<?php $__env->stopSection(); ?>

<?php $__env->startSection('description'); ?>
<?php echo e($thread->excerpt); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="<?php echo e(elixir('dist/js/all.js')); ?>"></script>
		 

        <script type="text/javascript">
            Hifone.Config = {
                'locale' : '<?php echo e(isset($user_locale) ? $user_locale : $site_locale); ?>',
                'current_user_id' : <?php echo e(Auth::user() ? Auth::user()->id : 'null'); ?>,
                'token' : '<?php echo e(csrf_token()); ?>',
                'emoj_cdn' : 'https://dn-phphub.qbox.me',
                'uploader_url' : '<?php echo e(route('upload_image')); ?>',
                'notification_url' : '<?php echo e(route('notification.count')); ?>'
            };
        </script>
        <script type="text/javascript">
            Hifone.jsLang = {
                'delete_form_title' : '<?php echo e(trans('hifone.action_title')); ?>',
                'delete_form_text' : '<?php echo e(trans('hifone.action_text')); ?>',
                'uploading_file' : '<?php echo e(trans('hifone.uploading_file')); ?>',
                'loading' : '<?php echo e(trans('hifone.loading')); ?>',
                'content_is_empty' : '<?php echo e(trans('hifone.content_empty')); ?>',
                'operation_success' : '<?php echo e(trans('hifone.success')); ?>',
                'error_occurred' : '<?php echo e(trans('hifone.error_occurred')); ?>',
                'button_yes' : '<?php echo e(trans('hifone.yes')); ?>',
                'like' : '<?php echo e(trans('hifone.like')); ?>',
                'dislike' : '<?php echo e(trans('hifone.unlike')); ?>'
            };
        </script>
<div class="col-md-9 threads-show main-col">

  <!-- Thread Detial -->
  <div class="thread panel panel-default">
    <div class="infos panel-heading">

      <div class="pull-right avatar">
	  <?php if($thread->anonymous == 0): ?>
		  
	  
	   <?php if($current_user): ?>
        <a href="<?php echo e(route('user.home', $thread->user->username)); ?>">
	 <img src="<?php echo e($thread->user->avatar); ?>" class="media-object img-thumbnail avatar-64" />
        </a>
		<?php else: ?>
			<a href="<?php echo e(route('auth.login')); ?>">
		 <img src="<?php echo e($thread->user->avatar); ?>" class="media-object img-thumbnail avatar-64" />
        </a>
		<?php endif; ?>
		
		
		
         
		
	  <?php endif; ?>
      </div>

      <h1 class="panel-title thread-title" id="title"><?php echo e($thread->title); ?></h1>
    
	 
      <div class="likes">
            
            
			<form method="post" action="<?php echo e($thread->id); ?>/like" >
		
								<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                            <input type="hidden" name="_method" value="POST"  />
		<button type="submit" id="completed-task" class="fabutton" >
		  <i class="fa fa-chevron-up likeable like" aria-hidden="true" ></i></button>
		</form>
			
		
			&nbsp <?php echo e($thread->like_count); ?>

			<form method="post" action="<?php echo e($thread->id); ?>/unlike" >
		
								<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                            <input type="hidden" name="_method" value="POST" />
		<button type="submit" id="completed-task" class="fabutton"   title="<?php echo e(trans('hifone.unlike')); ?>">
		  <i class="fa fa-chevron-down likeable like" aria-hidden="true"  title="<?php echo e(trans('hifone.unlike')); ?>" ></i></button>
		</form>	
			
			
      </div>
	  
	  
	  
	 

      <?php echo $__env->make('threads.partials.meta', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>

    <div class="panel-body content-body">

      <?php echo $__env->make('threads.partials.body', array('body' => $thread->body), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

      <?php echo $__env->make('threads.partials.ribbon', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
 
    <?php foreach($thread->appends as $index => $append): ?>

        <div class="appends">
            <span class="meta"><?php echo e(trans('hifone.appends.appends')); ?> <?php echo e($index + 1); ?> &nbsp;k·&nbsp; <abbr title="<?php echo $append->created_at; ?>" class="timeago"><?php echo e($append->created_at); ?></abbr></span>
            <div class="sep5"></div>
            <div class="markdown-reply append-content">
                <?php echo $append->content; ?>

            </div>
        </div>

    <?php endforeach; ?>

    <?php echo $__env->make('threads.partials.thread_operate', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  </div>

  <!-- Reply List -->
  <div class="replies panel panel-default list-panel replies-index">
    <div class="panel-heading">
      <div class="total"><?php echo e(trans('hifone.replies.total')); ?>: <b><?php echo e($replies->total()); ?></b> </div>	 <div class="pull-right"> <a href="recent_rep"><i class="fa fa-thumbs-o-up">الاحدث </i></a> &nbsp; &nbsp; &nbsp; <a href="liked_rep">الاكثر اعجابا<i class="fa fa-history"></i></a></div>
<br>
    </div>

    <div class="panel-body">

      <?php if(count($replies)): ?>
		
	  
        <?php echo $__env->make('threads.partials.replies', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      <?php else: ?>
         <div class="empty-block"><?php echo e(trans('hifone.replies.noitem')); ?></div>
      <?php endif; ?>

      <!-- Pager -->
      <div class="pull-right" style="padding-right:20px">
        <?php echo $replies->appends(Request::except('page'))->render();; ?>

      </div>
    </div>
  </div>

  <!-- Reply Box -->
<div class="panel panel-default">
  <div class="panel-heading">
  <?php echo e(trans('hifone.replies.add')); ?>

  </div>
  <div class="panel-body">
    <div class="reply-box form">
    <?php if($current_user): ?>
    <?php echo Form::open(['route' => 'reply.store', 'id' => 'reply_create_form', 'class' => 'create_form', 'method' => 'post']); ?>

      <input type="hidden" name="reply[thread_id]" value="<?php echo e($thread->id); ?>" />
        <!-- editor start -->
        <?php echo $__env->make('threads.partials.editor_toolbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <!-- end -->
        <div class="form-group">
              <?php echo Form::textarea('reply[body]', null, ['class' => 'post-editor form-control',
                                                'rows' => 5,
                                                'placeholder' => trans('hifone.markdown_support'),
                                                'style' => "overflow:hidden",
                                                'id' => 'body_field']); ?>

        </div>
		<br>
		<div class="form-group">
              <?php echo Form::textarea('reply[credentials]', null, ['class' => 'post-editor form-control',
                                                'rows' => 1,
                                                'placeholder' => 'Credentials',
                                                'style' => "overflow:hidden",
                                                'id' => 'credentials']); ?>

        </div>

        <div class="form-group status-post-submit">
              <?php echo Form::submit(trans('forms.publish'), ['class' => 'btn btn-primary', 'id' => 'reply-create-submit']); ?>

           
            <span class="pull-right">
              <small><?php echo trans('hifone.photos.drag_drop'); ?></small>
            </span>
        </div>
    <?php echo Form::close(); ?>

    <?php else: ?>
    <div style="padding:20px;">
    <?php echo trans('hifone.threads.login_needed'); ?>

  </div>
    <?php endif; ?>
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