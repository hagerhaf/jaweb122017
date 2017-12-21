
 @if (count($subthreads) >0)

	<ul class="list-group row thread-list">
	
    @foreach ($subthreads as  $randq)
	
	<li class="list-group-item media " style="margin-top: 0px;">
	<a class="pull-right" href="{{ route('thread.show', [$randq->id]) }}" >
            <span class="badge badge-reply-count"> {{ $randq->reply_count }} </span>
        </a>

        <div class="avatar pull-left">
           
        </div>
	
	  <div class="infos">
	
	
	
	
	
	 <div class="media-heading">
	 
	 
	
	
	 <a href="{{ route('thread.show', [$randq->id]) }}" title="{{ $randq->title }}">
                {{  $randq->title  }}
				
				 @if ($randq->best_answer != 0)
                    
		   
				<i class="fa fa-check" aria-hidden="true"></i>
				
				
               
				
                
				
				
            @endif
            </a>
			
			</div>
			
			
	<div class="media-body meta">
            @if ($randq->like_count > 0)
                <a href="{{ route('thread.show', [$randq->id]) }}" class="remove-padding-left" id="pin-{{ $randq->id }}">
                    <span class="fa fa-thumbs-o-up"> {{ $randq->like_count }} </span>
                </a>
                <span> • </span>
            @endif

            
			
			
			
			
			<!-- Add USERNAMES-->
			
          
		   
		   @php
		   
		   $auth=null;
  
@endphp
		   
		   @foreach($authors as $author)
		   
		   
		   
		   @if($randq->user_id == $author->id)
			   
		   @php
   $auth=$author->username;
   $authid=$author->id;
@endphp

@endif
		   @endforeach
		   
		    <span> • </span>
		  <a href=" user/{{$authid}}"> {{ $auth }} </a>
			<span class="timeago {{ $randq->created_at }}" data-toggle="tooltip" data-placement="top" title="{{ $randq->created_at }}">{{ $randq->created_at }}</span>
			<span class=" {{ $randq->points }}" data-toggle="tooltip" data-placement="top" title="{{ $randq->points }}">{{ $randq->points }} points</span>
			
         
          </div>

			
			
			
			</li>
	
	
	
	@endforeach
	</ul>
	
@endif




	


