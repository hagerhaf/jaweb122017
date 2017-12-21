@extends('layouts.default')

@section('title')
    {{ trans('hifone.threads.add') }}_@parent
@stop

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="{{ elixir('dist/js/all.js') }}"></script>
	  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" /><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.css"><link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.6.0/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" /><link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.6.0/css/froala_style.min.css" rel="stylesheet" type="text/css" />	 

        <script type="text/javascript">
          /*   Hifone.Config = {
                'locale' : '{{ $user_locale or $site_locale }}',
                'current_user_id' : {{ Auth::user() ? Auth::user()->id : 'null' }},
                'token' : '{{ csrf_token() }}',
                'emoj_cdn' : 'https://dn-phphub.qbox.me',
                'uploader_url' : '{{ route('upload_image') }}',
                'notification_url' : '{{ route('notification.count') }}'
            }; */
        </script>
        <script type="text/javascript">
            Hifone.jsLang = {
                'delete_form_title' : '{{ trans('hifone.action_title') }}',
                'delete_form_text' : '{{ trans('hifone.action_text') }}',
                'uploading_file' : '{{ trans('hifone.uploading_file') }}',
                'loading' : '{{ trans('hifone.loading') }}',
                'content_is_empty' : '{{ trans('hifone.content_empty') }}',
                'operation_success' : '{{ trans('hifone.success') }}',
                'error_occurred' : '{{ trans('hifone.error_occurred') }}',
                'button_yes' : '{{ trans('hifone.yes') }}',
                'like' : '{{ trans('hifone.like') }}',
                'dislike' : '{{ trans('hifone.unlike') }}'
            };
        </script>
		
		
		
		
    <div class="thread_create">

        <div class="col-md-9 main-col">
            <div class="panel panel-default corner-radius">
                <div class="panel-heading">{{ trans('hifone.threads.add') }}</div>
                <div class="panel-body">
                    <div class="reply-box form box-block">
                        @if (isset($thread))
                            {!! Form::model($thread, ['route' => ['thread.update', $thread->id], 'id' => 'thread_edit_form', 'class' => 'create_form', 'method' => 'patch']) !!}
                        @else
                            {!! Form::open(['route' => 'thread.store','id' => 'thread_create_form', 'class' => 'create_form', 'method' => 'post']) !!}
                        @endif
						
						
						
						
                        <div class="form-group">
                            {!! Form::text('thread[title]', isset($thread) ? $thread->title : null, ['class' => 'form-control', 'id' => 'thread_title', 'placeholder' => trans('hifone.threads.title')]) !!}
                        </div>

                        <div class="form-group">
                            <select class="form-control selectpicker" name="thread[node_id]">
                                <option value=""
                                        disabled {!! $node ? null : 'selected'; !!}>اختر قسم</option>
                                @foreach ($sections as $section)
                                    <optgroup label="{{ $section->name }}">
                                        @if(isset($section->nodes))
                                            @foreach ($section->nodes as $item)
                                                <option value="{{ $item->id }}" {!! (Input::old('node_id') == $item->id || (isset($node) && $node->id==$item->id)) ? 'selected' : ''; !!} >
                                                    - {{ $item->name }}</option>
                                            @endforeach
                                        @endif
                                    </optgroup>
                                @endforeach
                            </select>
							
							<select class="form-control selectpicker" name="thread[node2_id]">
                                <option value=""
                                        disabled {!! $node ? null : 'selected'; !!}>اختر قسم</option>
                                @foreach ($sections as $section)
                                    <optgroup label="{{ $section->name }}">
                                        @if(isset($section->nodes))
                                            @foreach ($section->nodes as $item)
                                                <option value="{{ $item->id }}" {!! (Input::old('node_id') == $item->id || (isset($node) && $node->id==$item->id)) ? 'selected' : ''; !!} >
                                                    - {{ $item->name }}</option>
                                            @endforeach
                                        @endif
                                    </optgroup>
                                @endforeach
                            </select>
							
							
							<select class="form-control selectpicker" name="thread[node3_id]">
                                <option value=""
                                        disabled {!! $node ? null : 'selected'; !!}>اختر قسم</option>
                                @foreach ($sections as $section)
                                    <optgroup label="{{ $section->name }}">
                                        @if(isset($section->nodes))
                                            @foreach ($section->nodes as $item)
                                                <option value="{{ $item->id }}" {!! (Input::old('node_id') == $item->id || (isset($node) && $node->id==$item->id)) ? 'selected' : ''; !!} >
                                                    - {{ $item->name }}</option>
                                            @endforeach
                                        @endif
                                    </optgroup>
                                @endforeach
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
                        @include('threads.partials.editor_toolbar')
                    <!-- end -->
                        <div class="form-group" hidden>
                            {!! Form::textarea('', isset($thread) ? $thread->body_original : null, ['class' => 'post-editor form-control',
                                                              'rows' => 15,
                                                              'style' => "overflow:hidden",
                                                              'id' => 'body_field',
                                                              'placeholder' => trans('hifone.markdown_support')]) !!}
															  
															  
                        </div>

						
						<textarea name="thread[body]" id="froala-editor">ادخل المزيد من المعلومات</textarea>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script><script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.js"></script><script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/mode/xml/xml.min.js"></script><script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.6.0//js/froala_editor.pkgd.min.js"></script>
	  <script type="text/javascript">
		$(function() {
  $('textarea#froala-editor').froalaEditor()
});
		</script>				
                        

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

            @if ( $node )
                <div class="panel panel-default corner-radius help-box">
                    <div class="panel-heading text-center">
                        <h3 class="panel-title">{{ trans('hifone.nodes.current') }} : {{ $node->name }}</h3>
                    </div>
                    <div class="panel-body">
                        {{ $node->description }}
                    </div>
                </div>
            @endif

            
            

        </div>
    </div>

@stop
