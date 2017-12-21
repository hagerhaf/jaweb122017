@extends('layouts.default')



@section('content')

<div class="messages">

    

    <div class="col-md-9  right-col ">

        <div class="panel panel-default padding-sm">

            <div class="panel-body">
                <div><a href="../messages" class="normalize-link-color"><i class="fa fa-arrow-right" aria-hidden="true"></i> الرجوع</a></div>
                <br>
               

                

                <hr>

                <ul class="list-group row">
                   @foreach ($messages as $message) 
  

                     <li class="list-group-item media " style="margin-top: 0px;"  >
                       
								
							@if($message->msg_from == $id)
								  <div class="avatar pull-right">
                            <a href="">
                                <img class="media-object img-thumbnail avatar" alt="" src="{{$partner->avatar_url}}"  style="width:48px;height:48px;"/>
                            </a>
                        </div>

                        <div class="infos pull-right">

                          <div class="media-heading ">

                           <small class="pull-left"><i>{{ $message->date }}</i></small>
                             
								  <a href="../user/{{$partner->id}}" class="pull-right">
								<h4>{{ $partner->username }}</h4>
								</a>
								  
                           
							
                          </div>
							<br>
                          <div class="media-body markdown-reply content-body">
                                <h3 class="pull-right"> {{ $message->text }} </h3>
                          </div>

                           
                        </div>
						
							@elseif($message->msg_from == $user->id)
							  <div class="avatar pull-right">
                            <a href="">
                                <img class="media-object img-thumbnail avatar" alt="" src="{{$user->avatar_url}}"  style="width:48px;height:48px;"/>
                            </a>
                        </div>

                        <div class="infos pull-right">

                          <div class="media-heading ">

                         
                               <small class="pull-left"><i>{{ $message->date }}</i></small>
							  <a href="" class="pull-right">
								<h3>انت</h3>
								</a>
								  
                          <div >
                                
                            </div>
							<br>
                          </div>
							<br>
                          <div class="media-body markdown-reply content-body ">
                              <h3 class="pull-right"> {{ $message->text }} </h3>
                          </div>

                            
                        </div>
								@endif
                                     
                                
                         
                    </li>
                   @endforeach
                </ul>
				@include('messages.create')
            </div>
        </div>
    </div>
</div>


@stop


