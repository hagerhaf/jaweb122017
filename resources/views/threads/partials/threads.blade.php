
@if (count($threads))

	<ul class="list-group row thread-list">
	    @php
		   
		   $auth=null;
  
@endphp
    @foreach ($threads as  $thread)
	
	 @foreach($authors as $author)
		   
		   
		   
		   @if($thread->user_id == $author->id)
			 
		 @php
		   
		   $auth=$author;
  
@endphp 
		   
		   @endif
		   @endforeach
	<li class="list-group-item media " style="margin-top: 0px;">
	<a class="pull-right" href="{{ route('thread.show', [$thread->id]) }}" >
            <span class="badge badge-reply-count"> {{ $thread->reply_count }} </span>
        </a>

        <div class="avatar pull-left">
            <a href="">
                <img class="media-object img-thumbnail avatar-48" alt="" src="{{ $author->avatar_url}}"/>
            </a>
        </div>
	
	  <div class="infos">
	
	
	
	
	
	 <div class="media-heading">
	 
	 
	 @if ($thread->is_excellent !=0 && !Input::get('filter') && Route::currentRouteName() != 'excellent' )
                <i class="{{ $thread->icon }}"></i>
           
            @endif
	 
	
	 <a href="{{ route('thread.show', [$thread->id]) }}" title="{{ $thread->title }}">
                {{$thread->title  }}
				 @if ($thread->best_answer != 0)
                    
		   
				<i class="fa fa-check" aria-hidden="true"></i>
				
				
               
				
                
				
				
            @endif
            </a>
			
			</div>
			
			
	<div class="media-body meta">
            @if ($thread->like_count > 0)
                <a href="{{ route('thread.show', [$thread->id]) }}" class="remove-padding-left" id="pin-{{ $thread->id }}">
                    <span class="fa fa-thumbs-o-up"> {{ $thread->like_count }} </span>
                </a>
                <span> • </span>
            @endif

            @if(!isset($node))
            <a href="" title="" {{ $thread->like_count == 0 || 'class="remove-padding-left"'}}>
                <!-- Add NODE NAME-->
            </a>
            <span> • </span>
                <!-- <span> • </span> -->
            @endif
             <!-- Add TAG LIST-->
            @if ($thread->reply_count == 0)
                    
		   
				
				
				
               
				
                
				
				
            @endif
			
			
			
			
			<!-- Add USERNAMES-->
			
          
		   
		   @php
		   
		   $auth=null;
  
@endphp
		   
		   @foreach($authors as $author)
		   
		   
		   
		   @if($thread->user_id == $author->id)
			   
		   @php
   $auth=$author->username;
   $authid=$author->id;
@endphp

@endif
		   @endforeach
		   
		    <span> • </span>
			@if($thread->anonymous == 0)
		  <a href=" user/{{$authid}}"> {{ $auth }} </a>
	  @else
	   <a href=""> مجهول </a>
	  @endif
			<span class="timeago {{ $thread->created_at }}" data-toggle="tooltip" data-placement="top" title="{{ $thread->created_at }}">{{ $thread->created_at }}</span>
			<span class=" {{ $thread->points }}" data-toggle="tooltip" data-placement="top" title="{{ $thread->points }}">{{ $thread->points }} points</span>
			
            @if ($thread->reply_count > 0 && count($thread->last_reply_user_id))
               
                <span> • </span>
                <span class="timeago {{ $thread->created_at }}" data-toggle="tooltip" data-placement="top" title="{{ $thread->updated_at }}">{{ $thread->updated_at }}</span>
            @endif
          </div>

			
			
			
			</li>
	
	
	
	@endforeach
	</ul>
	
	@endif
