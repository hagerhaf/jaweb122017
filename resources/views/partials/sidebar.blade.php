<div class="col-md-3 side-bar">
  @if(Auth::check())
  <div class="panel panel-default corner-radius">
      
    <div class="panel-body text-center">
	
      <div class="btn-group">
	  @if(Auth::user()->is_banned == 0)
        <a href="{!! isset($node) ? URL::route('thread.create') : URL::route('thread.create') ; !!}" class="btn btn-primary">
          <i class="fa fa-pencil"> </i> اطرح سوالا
        </a>
		@else
			لقد تم سجنك
		@endif
        @if($new_thread_dropdowns)
        <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
          {!! $new_thread_dropdowns !!}
        </ul>
        @endif
      </div>
    </div>
  </div>
  
   
	
	<div class="panel panel-default corner-radius">
    <div class="panel-heading">
      <h3 class="panel-title">افضل مستعمل</h3>
    </div>
<div class="panel-body">
      <table class="table table-striped">
      <tbody>
     
        <tr>
        <td style="text-align: center;"><div class="avatar">
               
              
        </div></td>
        <td style="vertical-align: middle; font-size: 80%;">
            
        <i class="fa fa-star"></i>        <a href="{{ route('user.home',$best_user->username) }}">{{ $best_user->username }}</a>
           
        <td>
        <td style="vertical-align: middle;"><small data-toggle="tooltip" data-placement="top" title="{{ $best_user->score }}">{!! $best_user->score !!}</small></td>
        </tr>
     
      </tbody>
      </table>
    </div>
</div>

	
	
  
  
  
    @if(Config::get('setting.module_active_pms'))
    <div class="panel panel-default corner-radius">
        <div class="panel-heading">
            <h3 class="panel-title">{{ trans('hifone.pms.pms') }}</h3>
        </div>
        <div class="panel-body text-center">
            <div class="btn-group">
                <a href="{!! URL::route('messages.create') !!}" class="btn btn-primary">
                    <i class="fa fa-pencil"> </i> {!! trans('hifone.pms.create') !!}
                </a>
            </div>
            <br><br>
            <div class="btn-group">
                <a href="{!! URL::route('messages.index') !!}" class="btn btn-primary">
                    <i> </i> {!! trans('hifone.pms.nav_inbox') !!}
                </a>
            </div>
        </div>
    </div>
    @endif
  @else
  <div class="panel panel-default corner-radius">
    <div class="panel-heading">
      <h3 class="panel-title"> </h3>
    </div>
    <div class="panel-body text-center">
        <a href="/auth/register" class="btn btn-primary">
          <i class="fa fa-user"> </i> التسجيل
        </a>
    </div>
    <div class="panel-footer text-center">
      للمستعملين القدماء <a href="/auth/login">الولوج</a>
    </div>
  </div>
  @endif

{{ Widget::Adblock(['slug' => 'sidebar_top', 'template'=>'sidebar']) }}

@if(Request::is('/'))
<div class="panel panel-default corner-radius">
    <div class="panel-heading">
      <h3 class="panel-title">الترتيب</h3>
    </div>
    <div class="panel-body">
      <table class="table table-striped">
      <tbody>
      @foreach($top_users as $index => $user)
        <tr>
        <td style="text-align: center;"><div class="avatar">
                @if($user->nickname)
                    <a href="{{ route('user.home',$user->username) }}"><img class="media-object img-thumbnail avatar-32" alt="{{ $user->nickname }}" src="{{ $user->avatar }}"></a>
                @else
                    <a href="{{ route('user.home',$user->username) }}"><img class="media-object img-thumbnail avatar-32" alt="{{ $user->username }}" src="{{ $user->avatar }}"></a>
                @endif
        </div></td>
        <td style="vertical-align: middle; font-size: 80%;">
            @if($user->nickname)
                <a href="{{ route('user.home',$user->username) }}">{{ $user->nickname }}</a>
            @else
                <a href="{{ route('user.home',$user->username) }}">{{ $user->username }}</a>
            @endif
        <td>
        <td style="vertical-align: middle;"><small data-toggle="tooltip" data-placement="top" title="{{ $user->somaa }}">{!! $user->somaa !!}</small></td>
        </tr>
      @endforeach
      </tbody>
      </table>
    </div>	
</div>

<div class="panel panel-default corner-radius">
    <div class="panel-heading">
      <h3 class="panel-title">اصحاب افضل الاجوبة</h3>
    </div>
    <div class="panel-body">
      <table class="table table-striped">
      <tbody>
	  @if($bestanswerers != null)
      @foreach($bestanswerers as $index => $user)
        <tr>
        <td style="text-align: center;"><div class="avatar">
                @if($user->nickname)
                    <a href="{{ route('user.home',$user->username) }}"><img class="media-object img-thumbnail avatar-32" alt="{{ $user->nickname }}" src="{{ $user->avatar_url }}"></a>
                @else
                    <a href="{{ route('user.home',$user->username) }}"><img class="media-object img-thumbnail avatar-32" alt="{{ $user->username }}" src="{{ $user->avatar_url }}"></a>
                @endif
        </div></td>
        <td style="vertical-align: middle; font-size: 80%;">
            @if($user->nickname)
                <a href="{{ route('user.home',$user->username) }}">{{ $user->nickname }}</a>
            @else
                <a href="{{ route('user.home',$user->username) }}">{{ $user->username }}</a>
            @endif
        <td>
        <td style="vertical-align: middle;"><small data-toggle="tooltip" data-placement="top" title="عدد افضل الاجابات">{!! $user->ba !!}</small></td>
        </tr>
      @endforeach
	  @else 
		  
	  @endif
      </tbody>
      </table>
    </div>	
</div>





<div class="panel panel-default corner-radius">
    <div class="panel-heading">
      <h3 class="panel-title">ترتيب حسب السمعة</h3>
    </div>
<div class="panel-body">
      <table class="table table-striped">
      <tbody>
      @foreach($top_users as $index => $user)
        <tr>
        <td style="text-align: center;"><div class="avatar">
                @if($user->nickname)
                    <a href="{{ route('user.home',$user->username) }}"><img class="media-object img-thumbnail avatar-32" alt="{{ $user->nickname }}" src="{{ $user->avatar }}"></a>
                @else
                    <a href="{{ route('user.home',$user->username) }}"><img class="media-object img-thumbnail avatar-32" alt="{{ $user->username }}" src="{{ $user->avatar }}"></a>
                @endif
        </div></td>
        <td style="vertical-align: middle; font-size: 80%;">
            @if($user->nickname)
                <a href="{{ route('user.home',$user->username) }}">{{ $user->nickname }}</a>
            @else
                <a href="{{ route('user.home',$user->username) }}">{{ $user->username }}</a>
            @endif
        <td>
        <td style="vertical-align: middle;"><small data-toggle="tooltip" data-placement="top" title="{{ $user->score }}">{!! $user->score !!}</small></td>
        </tr>
      @endforeach
      </tbody>
      </table>
    </div>
</div>




@endif

{{ Widget::Adblock(['slug' => 'sidebar_middle', 'template'=>'sidebar']) }}

@if (isset($nodeThreads) && count($nodeThreads))
  <div class="panel panel-default corner-radius">
    <div class="panel-heading">
      <h3 class="panel-title">{!! trans('hifone.nodes.same_node_threads') !!}</h3>
    </div>
    <div class="panel-body">
      <ul class="list">

        @foreach ($nodeThreads as $nodeThread)
          <li>
          <a href="{!! route('thread.show', $nodeThread->id) !!}">
            {!! $nodeThread->title !!}
          </a>
          </li>
        @endforeach

      </ul>
    </div>
  </div>
@endif



<div class="panel panel-default corner-radius">
  <div class="panel-heading">
    <h3 class="panel-title">{{ trans('hifone.stats.title') }}</h3>
  </div>
    <ul class="list-group">
      <li class="list-group-item">{{ trans('hifone.stats.users') }}: {{ $stats['user_count'] }} </li>
      <li class="list-group-item">{{ trans('hifone.stats.threads') }}: {{ $stats['thread_count'] }}</li>
      <li class="list-group-item">{{ trans('hifone.stats.replies') }}: {{ $stats['reply_count'] }}</li>
    </ul>
</div>

{{ Widget::Adblock(['slug' => 'sidebar_bottom', 'template'=>'sidebar']) }}

</div>
<div class="clearfix"></div>
