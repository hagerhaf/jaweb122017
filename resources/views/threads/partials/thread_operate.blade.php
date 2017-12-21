<div class="panel-footer operate">

  <div class="pull-left" style="font-size:15px;">
    <a class="" href="http://service.weibo.com/share/share.php?url={!! urlencode(Request::url()) !!}&type=3&pic=&title={{{ $thread->title }}}" target="_blank" title="{{ trans('hifone.threads.share2weibo') }}">
      <i class="fa fa-weibo"></i>
    </a>
    <a href="https://twitter.com/intent/tweet?url={!! urlencode(Request::url()) !!}&text={{{ $thread->title }}}&via=hifone.com" class=""  target="_blank" title="{{ trans('hifone.threads.share2twitter') }}">
      <i class="fa fa-twitter"></i>
    </a>
    <a href="http://www.facebook.com/sharer.php?u={!! urlencode(Request::url()) !!}" class=""  target="_blank" title="{{ trans('hifone.threads.share2facebook') }}">
      <i class="fa fa-facebook"></i>
    </a>
    <a href="https://plus.google.com/share?url={!! urlencode(Request::url()) !!}" class=""  target="_blank" title="{{ trans('hifone.threads.share2google') }}">
      <i class="fa fa-google-plus"></i>
    </a>
  </div>

  <div class="pull-right">
    @if($thread->tagsList)
      <span class="tag-list hidden-xs">
      Tags: 
      @foreach($thread->tags as $tag)
      <a href="/tag/{{ urlencode($tag->name) }}"><span class="tag">{{ $tag->name }}</span></a>
      @endforeach
      </span>
    @endif
	
	
	
	
	
	@if($thread->user_id != Auth::user()->id)
    @if (($follows != null))
     <form method="post" action="{{$thread->id}}" >
		
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="DELETE" />
		<button type="submit" id="completed-task" class="fabutton"   title="الغاء">
		  <i class="fa fa-eye" aria-hidden="true"  title="الغاء" >الغاء</i></button>
		</form>	
	  
	 
	  
    @else
      
	  
	  
	   <form method="post" action="{{$thread->id}}" >
		
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="POST" />
		<button type="submit" id="completed-task" class="fabutton"   title="متابعة"">
		  <i class="fa fa-eye" aria-hidden="true"  title="متابعة" >متابعة</i></button>
		</form>	
	  
    @endif

	@endif
	
	<!-- DELETE OR REPORT -->
	
	 @if ( Auth::user()->username != $thread->user->username)
		
	<form method="post" action="/thread/{{ $thread->id }}/report">
		
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
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
	
	@if($later == null)
	<form method="post" action="/thread/{{ $thread->id }}/later">
		
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="POST" />
		<button type="submit" id="completed-task" class="fabutton">
<i class="fa fa-clock-o"   aria-hidden="true" title="لاحقا "></i></button>
		
	       
	</form>
	@endif
	
	@else
		
	<form action="{{ $thread->id }}/delete" method="POST">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="DELETE" />
                                <button type="submit" class="btn waves-effect red"><i class="fa fa-trash-o"></i></button> 
                              </form>
							  
							  
							  
							  
		@endif
	
	
	<!-- DELETE OR REPORT -->
	
	@if ($thread->user_id != Auth::user()->id)
    @if (($favorites != null))
	  
	  <form method="post" action="{{$thread->id}}" >
		
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="DELETE" />
		<button type="submit" id="completed-task" class="fabutton"   >
		  <i id="faved" class="fa fa-bookmark" aria-hidden="true"   ></i><span id="faved">مفضلة</span></button>
		  <style>
		  #faved{
			  color:green;
			  
		  }
		  </style>
		</form>	
	  
    @else
       <form method="post" action="{{$thread->id}}" >
		
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="POST" />
		<button type="submit" id="completed-task" class="fabutton"   >
		  <i class="fa fa-bookmark" aria-hidden="true"   ></i>تثبيت</button>
		</form>	
    @endif
	@endif

    @if (Auth::user() && Auth::user()->can("manage_threads") )
        <a data-method="post" id="thread-recommend-button" href="javascript:void(0);" data-url="{{ route('thread.recommend', [$thread->id]) }}" class="admin {!! $thread->is_excellent ? 'active' :'';!!}" title="{{ trans('hifone.threads.mark_excellent') }}">
        <i class="fa fa-trophy"></i>
        </a>

        @if ($thread->order >= 0)
          <a data-method="post" id="thread-pin-button" href="javascript:void(0);" data-url="{{ route('thread.pin', [$thread->id]) }}" class="admin {!! $thread->order > 0 ? 'active' : '' !!}" title="{{ trans('hifone.threads.mark_stick') }}">
            <i class="fa fa-thumb-tack"></i>
          </a>
        @endif

        @if ($thread->order <= 0)
            <a data-method="post" id="thread-sink-button" href="javascript:void(0);" data-url="{{ route('thread.sink', [$thread->id]) }}" class="admin {!! $thread->order < 0 ? 'active' : '' !!}" title="{{ trans('hifone.threads.mark_sink') }}">
                <i class="fa fa-anchor"></i>
            </a>
        @endif

        <a data-method="delete" id="thread-delete-button" href="javascript:void(0);" data-url="{{ route('thread.destroy', [$thread->id]) }}"  class="admin {!! $thread->order < 0 ? 'active' : '' !!}">
            <i class="fa fa-trash-o"></i>
        </a>
    @endif

    @if ( Auth::user() && (Auth::user()->can("manage_threads") || Auth::user()->id == $thread->user_id) )
      <a id="thread-append-button" href="javascript:void(0);" title="{{ trans('hifone.appends.appends') }}" class="admin" data-toggle="modal" data-target="#exampleModal">
        <i class="fa fa-plus"></i>
      </a>

      <a id="thread-edit-button" href="{{ route('thread.edit', [$thread->id]) }}" title="{{ trans('forms.edit') }}" class="admin">
        <i class="fa fa-pencil-square-o"></i>
      </a>
    @endif

  </div>
  <div class="clearfix"></div>
</div>


<div class="modal fade" id="exampleModal" tabindex="-1" role="" aria-labelledby="exampleModalLabel" >
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">{{ trans('hifone.appends.content') }}</h4>
      </div>

     {!! Form::open(['route' => ['thread.append', $thread->id],'method' => 'post']) !!}

        <div class="modal-body">

          <div class="alert alert-warning">
              {{ trans('hifone.appends.notice') }}
          </div>

          <div class="form-group">
            {!! Form::textarea('content', null, ['class' => 'form-control',
                                                'style' => 'min-height:20px',
                                          'placeholder' => trans('hifone.markdown_support')]) !!}

          </div>

          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('forms.close') }}</button>
            <button type="submit" class="btn btn-primary">{{ trans('forms.submit') }}</button>
          </div>

      {!! Form::close() !!}

    </div>
  </div>
</div>
