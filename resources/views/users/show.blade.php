
@if(Auth::user() !=null)
@extends('layouts.default')

<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
<script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
	

@section('title')
{{{ $user->username }}} {{ trans('hifone.users.info') }}_@parent
@stop

@section('content')



<div class="users-show">

  <div class="col-md-3 box">
    @include('users.partials.basicinfo')
  </div>

  <div class="col-md-9 left-col">

    @if ($user->is_banned)
      <div class="text-center alert alert-info"><b>{{ trans('hifone.users.is_banned') }}</b></div>
    @endif

    <div class="panel panel-default">
        <div class="panel-body">
          @include('users.partials.infonav')
        
            <div class="user-card">
                <div class="header pull-right">
                  <a class="avatar" href="{{ $user->url }}" target="_blank"><img  src="{{ $user->avatar }}"><strong><span>{{ '@'.$user->username }}</span></strong><br><br></a>
<br>   <br><br>              
				 @if($current_user && $current_user->id != $user->id && $current_user->is_banned == 0)
					   
				  @if($is_blocked != null) 
					   <b style="color:red;">لا يمكنك التواصل مع هذا المستعمل </b>
				   @else
					     <a class=" msg" href="../messages/{{ $user->id }}" data-type="User" data-id="{{ $user->id }}" data-url="">
                         <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored pull-right"> <i class="fa fa-minus"></i> ارسل رسالة</button>
						 
                      </a>
				   
				  @endif
					<br><br><br>
				 @if ( $subto ==1)
                     
					  
					  <form method="post" action="../user/{{$user->id}}/unfollow" class="pull-right" >
		
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="DELETE" />
		<button type="submit" id="completed-task" class="fabutton mdl-button mdl-js-button mdl-button--raised mdl-button--colored pull-right"   title="عدم الاتباع">
		  <i class="fa fa-check" aria-hidden="true"  title="عدم الاتباع" >عدم الاتباع</i></button>
		</form>	
					  
                    @else
                      <form method="post" action="../user/{{$user->id}}/follow" class="pull-right" >
		
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="POST" />
		<button type="submit" id="completed-task" class="fabutton mdl-button mdl-js-button mdl-button--raised mdl-button--colored pull-right"   title="اتباع">
		  <i class="fa fa-plus" aria-hidden="true"  title="اتباع" >اتباع</i></button>
		</form>	
                    @endif
&#9; &#9;<br><br>
<br>				@if($has_blocked == null )
	   <form method="post" action="{{$user->id}}/blok" >
		
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="POST" />
		<button type="submit" id="completed-task" class="fabutton mdl-button mdl-js-button mdl-button--raised mdl-button--colored pull-right"   title="حظر">
		  <i class="fa fa-ban" aria-hidden="true"  title="حظر" >حظر</i></button>
		</form>	
		
		
		@else
		
		<form method="post" action="{{$user->id}}/unblok" >
		
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="DELETE" />
		<button type="submit" id="completed-task" class="fabutton mdl-button mdl-js-button mdl-button--raised mdl-button--colored pull-right"   title="رفع الحظر">
		  <i class="fa fa-ban" aria-hidden="true"  title="رفع الحظر" >رفع الحظر</i></button>
		</form>	
					  
					  @endif
					  
					  
					  
					  
					  
					<br>  
					  
					  
                  
					
					
					
					
                  @endif
				  
				 
				  
                </div>
				<br><br>
                <ul class="status">
                  <li><a href="{!! route('user.threads', $user->id) !!}"><strong>{{ $user->thread_count }}</strong>الاسئلة</a></li>
                  <li><a href="{!! route('user.replies', $user->id) !!}"><strong>{{ $user->reply_count }}</strong>الاجوبة</a></li>
				  <li><a href=""><strong>{{ $followed->count()}}</strong>يتبع</a></li>
                  <li><a href="#"><strong>{{ $followers->count()}}</strong>المتابعين</a></li>
				 
                </ul>
                <div class="footer">
                {{ $user->bio }}
                </div>
        </div>
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