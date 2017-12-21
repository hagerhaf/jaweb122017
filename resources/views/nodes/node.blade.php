@extends('layouts.default')

@section('content')

<div class="col-md-9 main-col">
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{  $node->name  }}</h3>
        </div>
        <div class="panel-body">
		<style>
		.fabutton {
  background: none;
  padding: 0px;
  border: none;
}
		</style>
		
		@if($is_sub != 1)
		<form method="post" action="{{$node->id}}" >
		
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="POST" />
		<button type="submit" id="completed-task" class="fabutton"   title="متابعة">
		  <i class="fa fa-eye" aria-hidden="true"  title="متابعة" >متابعة</i></button>
		</form>	
		@else
		 <form method="post" action="{{$node->id}}" >
		
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="DELETE" />
		<button type="submit" id="completed-task" class="fabutton"   title="الغاء">
		  <i class="fa fa-eye" aria-hidden="true"  title="الغاء" >  الغاء المتابعة</i></button>
		</form>	
		@endif
		  <span class="pull-right text-right">
          {{  $node->created_at  }} <br>
         {{  $node->thread_count  }}	عدد الاسئلة <br>	  
         {{  $node->reply_count  }}		عدد الاجوبة  <br>	
         {{  $subs  }}   عدد المشاركين <br>	
		 {{  $node->visits  }}  عدد الزيارات<br>
		   </span class="pull-right text-right">
		 
        </div>
    </div>
   
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title"><span class="pull-right text-right">الاسئلة </span></h3>
        </div>
        <div class="panel-body">
           
            <ul class="media-list">
               @foreach($threads as $thread)
                <li class="media section">
                    
                    <span class="pull-right text-right"><h4><a href="../thread/{{$thread->id}}">{{$thread->title}}</a></h4></span>
                    <div class="media-body">
                        <h4 class="media-heading"><a href=""></a></h4>
                        <p class="text-muted">
                           
                        </p>
                    </div>
                </li>
               @endforeach
            </ul>
           
        </div>
    </div>
	
	
	
	<div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title"><span class="pull-right text-right">المشاركون </span></h3>
        </div>
        <div class="panel-body">
           
            <ul class="media-list">
               @foreach($users as $user)
                <li class="media section">
                    <div class="avatar pull-right">
                            <a href="../user/{{$user->id}}">
                                <img class="media-object img-thumbnail avatar" alt="" src="{{$user->avatar_url}}"  style="width:48px;height:48px;"/> </a>
								<span class="pull-right text-right"><h4><a href="../user/{{$user->id}}">{{$user->username}}</a></h4></span>
                           
                        </div>
                    
                    <div class="media-body">
                        <h4 class="media-heading"><a href=""></a></h4>
                        <p class="text-muted">
                           
                        </p>
                    </div>
                </li>
               @endforeach
            </ul>
           
        </div>
    </div>
	
	
	
	
</div>


@stop