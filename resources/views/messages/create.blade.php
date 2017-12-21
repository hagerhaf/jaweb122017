@extends('layouts.default')


@section('content')
    <div class="thread_create">

        <div class="col-md-9 main-col">
            <div class="panel panel-default corner-radius">
                
                <div class="panel-body">
                    <div class="reply-box form box-block">
                        
                          
                       

                       
                       <div class="editor-toolbar">
  <div class="opts pull-right">
    <span class="dropdown dropdown-small" id="editor-toolbar-insert-code">
      <a href="#editor-toolbar-insert-code" data-toggle="dropdown" title="{{ trans('hifone.threads.insert_code') }}"><i class="fa fa-code"></i></a>
      
    </span>
    <a class="btn-upload" href="javascript:void(0);" data-toggle="tooltip" data-placement="bottom" title="{{ trans('hifone.threads.upload_image') }}"><i class="fa fa-image"></i> </a>
    <input type="file" name="file" class="input-file" style="display: none;" />
  </div>
  <ul class="nav nav-pills" style="clear:none;">
    <li class="edit active"><a href="#">{{ trans('forms.edit') }}</a></li>
    <li class="preview"><a href="#">{{ trans('forms.preview') }}</a></li>
  </ul>
</div>
                    <!-- end -->
                        <div class="form-group">
						{!! Form::open(array('action' => 'PrivateMsgController@store', 'method' => 'POST', 'id' => 'lookup', 'class' => 'msg_form')) !!}
                           {!! Form::textarea('thread[body]', isset($thread) ? $thread->body_original : null, ['class' => 'post-editor form-control',
                                                              'rows' => 15,
                                                              'style' => "overflow:hidden",
                                                              'id' => 'body_field',
															  'name'=>'message',
                                                              'placeholder' => trans('hifone.markdown_support')]) !!}
                        </div>

						<input hidden value='{{ $id }}' name='msg_to' />
					
                        <div class="form-group status-post-submit">
                            {!! Form::submit(trans('forms.publish'), ['class' => 'btn btn-primary col-xs-2', 'id' => 'thread-create-submit']) !!}
                            <div class="pull-right">
                                <small>{!! trans('hifone.photos.drag_drop') !!}</small>
                                <a href="/markdown" target="_blank"><i
                                            class="fa fa-lightbulb-o"></i> {{ trans('hifone.photos.markdown_desc') }}
                                </a>
                                </small>
                            </div>
                        </div>

                        <div class="box preview markdown-body" id="preview-box" style="display:none;"></div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

        </div>

        <div class="col-md-3 side-bar">

           

            

        </div>
    </div>

@stop
