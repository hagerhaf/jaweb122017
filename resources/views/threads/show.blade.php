@if(Auth::user() !=null)
@extends('layouts.default')

@section('title')
{{ $thread->title }} - @parent
@stop

@section('description')
{{ $thread->excerpt }}
@stop

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="{{ elixir('dist/js/all.js') }}"></script>
		 

        <script type="text/javascript">
            Hifone.Config = {
                'locale' : '{{ $user_locale or $site_locale }}',
                'current_user_id' : {{ Auth::user() ? Auth::user()->id : 'null' }},
                'token' : '{{ csrf_token() }}',
                'emoj_cdn' : 'https://dn-phphub.qbox.me',
                'uploader_url' : '{{ route('upload_image') }}',
                'notification_url' : '{{ route('notification.count') }}'
            };
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
<div class="col-md-9 threads-show main-col">

  <!-- Thread Detial -->
  <div class="thread panel panel-default">
    <div class="infos panel-heading">

      <div class="pull-right avatar">
	  @if($thread->anonymous == 0)
		  
	  
	   @if($current_user)
        <a href="{{ route('user.home', $thread->user->username) }}">
	 <img src="{{ $thread->user->avatar }}" class="media-object img-thumbnail avatar-64" />
        </a>
		@else
			<a href="{{ route('auth.login') }}">
		 <img src="{{ $thread->user->avatar }}" class="media-object img-thumbnail avatar-64" />
        </a>
		@endif
		
		
		
         
		
	  @endif
      </div>

      <h1 class="panel-title thread-title" id="title">{{ $thread->title }}</h1>
    
	 
      <div class="likes">
            
            
			<form method="post" action="{{$thread->id}}/like" >
		
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="POST"  />
		<button type="submit" id="completed-task" class="fabutton" >
		  <i class="fa fa-chevron-up likeable like" aria-hidden="true" ></i></button>
		</form>
			
		
			&nbsp {{ $thread->like_count }}
			<form method="post" action="{{$thread->id}}/unlike" >
		
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="POST" />
		<button type="submit" id="completed-task" class="fabutton"   title="{{ trans('hifone.unlike') }}">
		  <i class="fa fa-chevron-down likeable like" aria-hidden="true"  title="{{ trans('hifone.unlike') }}" ></i></button>
		</form>	
			
			
      </div>
	  
	  
	  
	 

      @include('threads.partials.meta')
    </div>

    <div class="panel-body content-body">

      @include('threads.partials.body', array('body' => $thread->body))

      @include('threads.partials.ribbon')
    </div>
 
    @foreach ($thread->appends as $index => $append)

        <div class="appends">
            <span class="meta">{{ trans('hifone.appends.appends') }} {{ $index + 1 }} &nbsp;k·&nbsp; <abbr title="{!! $append->created_at !!}" class="timeago">{{ $append->created_at }}</abbr></span>
            <div class="sep5"></div>
            <div class="markdown-reply append-content">
                {!! $append->content !!}
            </div>
        </div>

    @endforeach

    @include('threads.partials.thread_operate')
  </div>

  <!-- Reply List -->
  <div class="replies panel panel-default list-panel replies-index">
    <div class="panel-heading">
      <div class="total">{{ trans('hifone.replies.total') }}: <b>{{ $replies->total() }}</b> </div>	 <div class="pull-right"> <a href="recent_rep"><i class="fa fa-thumbs-o-up">الاحدث </i></a> &nbsp; &nbsp; &nbsp; <a href="liked_rep">الاكثر اعجابا<i class="fa fa-history"></i></a></div>
<br>
    </div>

    <div class="panel-body">

      @if (count($replies))
		
	  
        @include('threads.partials.replies')
      @else
         <div class="empty-block">{{ trans('hifone.replies.noitem') }}</div>
      @endif

      <!-- Pager -->
      <div class="pull-right" style="padding-right:20px">
        {!! $replies->appends(Request::except('page'))->render(); !!}
      </div>
    </div>
  </div>

  <!-- Reply Box -->
<div class="panel panel-default">
  <div class="panel-heading">
  {{ trans('hifone.replies.add') }}
  </div>
  <div class="panel-body">
    <div class="reply-box form">
    @if($current_user)
    {!! Form::open(['route' => 'reply.store', 'id' => 'reply_create_form', 'class' => 'create_form', 'method' => 'post']) !!}
      <input type="hidden" name="reply[thread_id]" value="{{ $thread->id }}" />
        <!-- editor start -->
        @include('threads.partials.editor_toolbar')
        <!-- end -->
        <div class="form-group">
              {!! Form::textarea('reply[body]', null, ['class' => 'post-editor form-control',
                                                'rows' => 5,
                                                'placeholder' => trans('hifone.markdown_support'),
                                                'style' => "overflow:hidden",
                                                'id' => 'body_field']) !!}
        </div>
		<br>
		<div class="form-group">
              {!! Form::textarea('reply[credentials]', null, ['class' => 'post-editor form-control',
                                                'rows' => 1,
                                                'placeholder' => 'Credentials',
                                                'style' => "overflow:hidden",
                                                'id' => 'credentials']) !!}
        </div>

        <div class="form-group status-post-submit">
              {!! Form::submit(trans('forms.publish'), ['class' => 'btn btn-primary', 'id' => 'reply-create-submit']) !!}
           
            <span class="pull-right">
              <small>{!! trans('hifone.photos.drag_drop') !!}</small>
            </span>
        </div>
    {!! Form::close() !!}
    @else
    <div style="padding:20px;">
    {!! trans('hifone.threads.login_needed') !!}
  </div>
    @endif
    </div>
  </div>
</div>

</div>


@stop

@else
	
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

@endif
