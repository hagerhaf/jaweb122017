<div class="meta inline-block" >

  <a href="../node/{{ $thread->node_id }}" class="remove-padding-left">
    {{ $thread->node->name }}
  </a>
  
  
  @if($thread->anonymous == 0)
	  
  
  
  @if($current_user==true)
	  
  •
  <a href="{{ route('user.home', $thread->user->username) }}">
    @if($thread->user->nickname)
      {{ $thread->user->nickname }}
    @else
      {{ $thread->user->username }}
    @endif
  </a>
  
  @else
	
 •
  <a href="{{ route('user.home', $thread->user->username) }}">
    @if($thread->user->nickname)
      {{ $thread->user->nickname }}
    @else
      {{ $thread->user->username }}
    @endif
  </a>
  
  @endif
  
  
  
  
  
  
  
  
  @else
	  
  
   •
  <a href="">
   مجهول
  </a>
  
  
	  @endif

  @if ($thread->user->hasBadge)
    <span class="label label-warning" style="position: relative;">{{ $thread->user->badgeName }}</span>
  @endif
  •
  {{ trans('hifone.at') }} <abbr title="{{ $thread->created_at }}" class="timeago">{{ $thread->created_at }}</abbr>
  •

  @if (count($thread->lastReplyUser))
    {{ trans('hifone.threads.last_reply_by') }}
      <a href="{{ route('user.home', [$thread->lastReplyUser->username]) }}">
        @if($thread->lastReplyUser->nickname)
          {{ $thread->lastReplyUser->nickname }}
        @else
          {{ $thread->lastReplyUser->username }}
        @endif
      </a>
     {{ trans('hifone.at') }} <abbr title="{{ $thread->updated_at }}" class="timeago">{{ $thread->updated_at }}</abbr>
    •
  @endif

  {{ $thread->view_count }} {{ trans('hifone.view_count') }}
</div>
<div class="clearfix"></div>
