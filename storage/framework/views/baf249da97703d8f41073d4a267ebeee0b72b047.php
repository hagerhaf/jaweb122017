<?php $__env->startSection('title'); ?>
    <?php echo e(trans('hifone.threads.add')); ?>_@parent
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="<?php echo e(elixir('dist/js/all.js')); ?>"></script>
	  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" /><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.css"><link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.6.0/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" /><link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.6.0/css/froala_style.min.css" rel="stylesheet" type="text/css" />	 

        <script type="text/javascript">
          /*   Hifone.Config = {
                'locale' : '<?php echo e(isset($user_locale) ? $user_locale : $site_locale); ?>',
                'current_user_id' : <?php echo e(Auth::user() ? Auth::user()->id : 'null'); ?>,
                'token' : '<?php echo e(csrf_token()); ?>',
                'emoj_cdn' : 'https://dn-phphub.qbox.me',
                'uploader_url' : '<?php echo e(route('upload_image')); ?>',
                'notification_url' : '<?php echo e(route('notification.count')); ?>'
            }; */
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
		
		
		
		
    <div class="thread_create">

        <div class="col-md-9 main-col">
            <div class="panel panel-default corner-radius">
                <div class="panel-heading"><?php echo e(trans('hifone.threads.add')); ?></div>
                <div class="panel-body">
                    <div class="reply-box form box-block">
                        <?php if(isset($thread)): ?>
                            <?php echo Form::model($thread, ['route' => ['thread.update', $thread->id], 'id' => 'thread_edit_form', 'class' => 'create_form', 'method' => 'patch']); ?>

                        <?php else: ?>
                            <?php echo Form::open(['route' => 'thread.store','id' => 'thread_create_form', 'class' => 'create_form', 'method' => 'post']); ?>

                        <?php endif; ?>
						
						
						
						
                        <div class="form-group">
                            <?php echo Form::text('thread[title]', isset($thread) ? $thread->title : null, ['class' => 'form-control', 'id' => 'thread_title', 'placeholder' => trans('hifone.threads.title')]); ?>

                        </div>

                        <div class="form-group">
                            <select class="form-control selectpicker" name="thread[node_id]">
                                <option value=""
                                        disabled <?php echo $node ? null : 'selected';; ?>>اختر قسم</option>
                                <?php foreach($sections as $section): ?>
                                    <optgroup label="<?php echo e($section->name); ?>">
                                        <?php if(isset($section->nodes)): ?>
                                            <?php foreach($section->nodes as $item): ?>
                                                <option value="<?php echo e($item->id); ?>" <?php echo (Input::old('node_id') == $item->id || (isset($node) && $node->id==$item->id)) ? 'selected' : '';; ?> >
                                                    - <?php echo e($item->name); ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </optgroup>
                                <?php endforeach; ?>
                            </select>
							
							<select class="form-control selectpicker" name="thread[node2_id]">
                                <option value=""
                                        disabled <?php echo $node ? null : 'selected';; ?>>اختر قسم</option>
                                <?php foreach($sections as $section): ?>
                                    <optgroup label="<?php echo e($section->name); ?>">
                                        <?php if(isset($section->nodes)): ?>
                                            <?php foreach($section->nodes as $item): ?>
                                                <option value="<?php echo e($item->id); ?>" <?php echo (Input::old('node_id') == $item->id || (isset($node) && $node->id==$item->id)) ? 'selected' : '';; ?> >
                                                    - <?php echo e($item->name); ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </optgroup>
                                <?php endforeach; ?>
                            </select>
							
							
							<select class="form-control selectpicker" name="thread[node3_id]">
                                <option value=""
                                        disabled <?php echo $node ? null : 'selected';; ?>>اختر قسم</option>
                                <?php foreach($sections as $section): ?>
                                    <optgroup label="<?php echo e($section->name); ?>">
                                        <?php if(isset($section->nodes)): ?>
                                            <?php foreach($section->nodes as $item): ?>
                                                <option value="<?php echo e($item->id); ?>" <?php echo (Input::old('node_id') == $item->id || (isset($node) && $node->id==$item->id)) ? 'selected' : '';; ?> >
                                                    - <?php echo e($item->name); ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </optgroup>
                                <?php endforeach; ?>
                            </select>
							
							
							<br>
							<select name="thread[points]" class="form-control selectpicker">
	<option disabled selected="selected">عدد النقاط التي سيحصل عليها صاحب أفضل إجابه  </option>
  <option value="5" >5</option>
  <option value="10">10</option>
  <option value="50">50</option>
   <option value="99">99</option>
 
</select>
							
						
						<br>
<input type="checkbox" name="thread[anonymous]" value="1"> طرح سؤال من مجهول<br>						
                        </div>
                        <!-- editor start -->
                        <?php echo $__env->make('threads.partials.editor_toolbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <!-- end -->
                        <div class="form-group" hidden>
                            <?php echo Form::textarea('', isset($thread) ? $thread->body_original : null, ['class' => 'post-editor form-control',
                                                              'rows' => 15,
                                                              'style' => "overflow:hidden",
                                                              'id' => 'body_field',
                                                              'placeholder' => trans('hifone.markdown_support')]); ?>

															  
															  
                        </div>

						
						<textarea name="thread[body]" id="froala-editor">ادخل المزيد من المعلومات</textarea>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script><script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.js"></script><script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/mode/xml/xml.min.js"></script><script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.6.0//js/froala_editor.pkgd.min.js"></script>
	  <script type="text/javascript">
		$(function() {
  $('textarea#froala-editor').froalaEditor()
});
		</script>				
                        

                        <div class="form-group status-post-submit">
                            <?php echo Form::submit(trans('forms.publish'), ['class' => 'btn btn-primary col-xs-2', 'id' => 'thread-create-submit']); ?>

                            <div class="pull-right">
                                <small><?php echo trans('hifone.photos.drag_drop'); ?></small>
                                <a href="/markdown" target="_blank"><i
                                            class="fa fa-lightbulb-o"></i> <?php echo e(trans('hifone.photos.markdown_desc')); ?>

                                </a>
                                </small>
                            </div>
                        </div>

                        <div class="box preview markdown-body" id="preview-box" style="display:none;"></div>

                        <?php echo Form::close(); ?>

                    </div>
                </div>
            </div>

        </div>

        <div class="col-md-3 side-bar">

            <?php if( $node ): ?>
                <div class="panel panel-default corner-radius help-box">
                    <div class="panel-heading text-center">
                        <h3 class="panel-title"><?php echo e(trans('hifone.nodes.current')); ?> : <?php echo e($node->name); ?></h3>
                    </div>
                    <div class="panel-body">
                        <?php echo e($node->description); ?>

                    </div>
                </div>
            <?php endif; ?>

            
            

        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>