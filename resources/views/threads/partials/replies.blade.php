<ul class="list-group row">

			
  @foreach ($replies as $index => $reply)
  @if ($thread->best_answer  == $reply->id)  
		<!--BEST ANSWER-->
	
	<li class="list-group-item media {{ $reply->highlight }}" id="reply{{$reply->id}}" style="background-color:#a9dac1;">
    <div class="avatar pull-left">
      <a href="{!! route('user.show', [$reply->user_id]) !!}">
        <img class="media-object img-thumbnail avatar" alt="{!! $reply->user->username !!}" src="{!! $reply->user->avatar_small !!}"  style="width:48px;height:48px;"/>
      </a>
    </div>
    <div class="infos">

      <div class="media-heading meta">

        <a href="{!! route('user.show', [$reply->user_id]) !!}" title="{!! $reply->user->username !!}" class="remove-padding-left author">
           <b> {!! $reply->user->username !!} </b> Best Answerer
        </a>
        <abbr class="timeago" title="{!! $reply->created_at !!}">{!! $reply->created_at !!}</abbr>
        <a name="reply{!! $thread->replyFloorFromIndex($index) !!}" class="anchor" href="#reply{!! $thread->replyFloorFromIndex($index) !!}" aria-hidden="true">#{!! $thread->replyFloorFromIndex($index) !!}</a>

        <span class="opts pull-right">
          <span >
            @if (Auth::user() && (Auth::user()->can("manage_threads") || Auth::user()->id == $reply->user_id) )
            <a class="fa fa-trash-o" id="reply-delete-{!! $reply->id !!}" data-method="delete"  href="javascript:void(0);" data-url="{!! route('reply.destroy', [$reply->id]) !!}" title="{!! trans('forms.delete') !!}"></a>
          @endif
		  
		  
		  
		  @if ( Auth::user() && (Auth::user()->can("manage_replies") || Auth::user()->id == $reply->user_id) )
      <a id="reply-append-button" href="javascript:void(0);" title="{{ trans('hifone.appends.appends') }}" class="admin" data-toggle="modal" data-target="#exampleModal21">
        <i class="fa fa-plus"></i>
      </a>
	  <br>

	  
	  <div class="modal fade" id="exampleModal2" tabindex="-1" role="" aria-labelledby="exampleModalLabel2" >
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel2">{{ trans('hifone.appends.content') }}</h4>
      </div>

     {!! Form::open(['route' => ['reply.edit', $reply->id],'method' => 'post']) !!}

        <div class="modal-body">

          <div class="alert alert-warning">
              {{ trans('hifone.appends.notice') }} 
          </div>

          <div class="form-group">
            {!! Form::textarea('content', null, ['class' => 'form-control',
                                                'style' => 'min-height:20px',
                                          'placeholder' => trans('hifone.markdown_support')	])
																		  !!}

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
	  
    @endif
		  
		  
		 
            <a class="fa fa-reply btn-reply2reply" data-floor={{ $index + 1 }} data-username="{{ $reply->user->username }}" href="#" title="{!! $reply->user->username !!} اجابة "></a>
          </span>
		  
		   @if(Auth::user()->id != $reply->user_id)
			   
        
		  <form method="post" action="{{$reply->id}}/like" >
		
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="POST" />
		<button type="submit" id="completed-task" class="fabutton"   title="اعجبني">
		  <i class="likeable fa fa-thumbs-o-up" aria-hidden="true"  title="اعجبني" >اعجبني</i></button>
		</form>	
					  
		
		  
		  
        </span>
		@endif

      </div>

      <div class="media-body markdown-reply content-body">
    <b>  {!! $reply->body !!} </b>
      </div>
    </div>
	</li>
	
	
	
	<!--BEST ANSWER-->	
		@endif

@endforeach
		
		
		
		
  @foreach ($replies as $index => $reply)
  
  
		
  
  
   <li class="list-group-item media {{ $reply->highlight }}" id="reply{{$reply->id}}">
    <div class="avatar pull-left">
      <a href="{!! route('user.show', [$reply->user_id]) !!}">
        <img class="media-object img-thumbnail avatar" alt="{!! $reply->user->username !!}" src="{!! $reply->user->avatar_small !!}"  style="width:48px;height:48px;"/>
      </a>
    </div>
    <div class="infos">

      <div class="media-heading meta">

        <a href="{!! route('user.show', [$reply->user_id]) !!}" title="{!! $reply->user->username !!}" class="remove-padding-left author">
            {!! $reply->user->username !!}
        </a><span>{!! $reply->credentials !!}</span>
        <abbr class="timeago" title="{!! $reply->created_at !!}">{!! $reply->created_at !!}</abbr>
        <a name="reply{!! $thread->replyFloorFromIndex($index) !!}" class="anchor" href="#reply{!! $thread->replyFloorFromIndex($index) !!}" aria-hidden="true">#{!! $thread->replyFloorFromIndex($index) !!}</a>

        <span class="opts pull-right">
          <span >
		  
		  
            @if (Auth::user() && (Auth::user()->can("manage_threads") || Auth::user()->id == $reply->user_id) )
				
			<form method="POST" action="/reply/{{ $reply->id }}/delete">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
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
		  @endif
		  
		  @if (  $thread->user_id == Auth::user()->id )
			  <form method="post" action="/reply/{{ $reply->id }}/best">
		
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="POST" />
		<button type="submit" id="completed-task" class="fabutton">
		  <i class="fa fa-check" aria-hidden="true" title="افضل اجابة" ></i></button>
		</form>
	       @endif
		   
		   @if (  $reply->user_id != Auth::user()->id )
		<form method="post" action="/reply/{{ $reply->id }}/report">
		
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
		 
		  
		  @endif
		  
		   @if(Auth::user()->id != $reply->user_id)
			   
        
		 <form method="post" action="/reply/{{ $reply->id }}/like" >
		{{$reply->like_count}} 
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="POST" />
		<button type="submit" id="completed-task" class="fabutton"   title="اعجبني">
		  <i class="likeable fa fa-thumbs-o-up" aria-hidden="true"  title="اعجبني" ></i></button>
		</form>	
					  
		
		  
		  
       
		@endif
		  
		  
		  @if ( Auth::user() && (Auth::user()->can("manage_replies") || Auth::user()->id == $reply->user_id) )
      <a id="reply-append-button" href="javascript:void(0);" title="{{ trans('hifone.appends.appends') }}" class="admin" data-toggle="modal" data-target="#exampleModal">
        <i class="fa fa-plus"></i>
      </a>
<br>
    @endif
		  
            <a class="fa fa-reply btn-reply2reply" data-floor={{ $index + 1 }} data-username="{{ $reply->user->username }}" href="#" title="{!! $reply->user->username !!} اجابة "></a>
          </span>
		  @if(Auth::user()->id != $reply->user_id)
         <!--  <a class="likeable fa fa-thumbs-o-up" data-action="like" data-url="" data-type="Reply" data-id="{{ $reply->id }}" data-count="{!! $reply->like_count ?: 0 !!}" href="javascript:void(0);" title="{!! trans('hifone.like') !!}"> {!! $reply->like_count ?: '' !!}
          </a> -->
		  @endif
        </span>

      </div>

      <div class="media-body markdown-reply content-body">
      {!! $reply->body !!}
      </div>
    </div>
  </li>
  @endforeach
</ul>