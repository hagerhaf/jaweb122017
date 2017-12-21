@extends('layouts.default')


@section('content')
<div class="messages">



<div class="col-md-9  left-col ">

    <div class="panel panel-default padding-sm">

        <div class="panel-heading">
            <h1 class="pull-right">الرسائل</h1>
        </div>

      <br><br>
      <br><br>
            <div class="panel-body remove-padding-horizontal notification-index">
 @php $other=null;  @endphp
                <ul class="list-group row">
                
@foreach ($messages as $message) 

                    @if($message->msg_read ==0 )
						  <li class="list-group-item media " style="margin-top: 0px;background-color: aliceblue;">
					@if($message->msg_from != Auth::user()->id)
						 @foreach($users as $pic)
							@if($pic->id == $message->msg_from)
								<div class="avatar pull-right">
								<a href="">
                                <img class="media-object img-thumbnail avatar" alt="" src="{{ $pic->avatar_url}}"  style="width:48px;height:48px;"/>
								</a>
								</div><br>
																<b class="pull-right">{{ $pic->username}} </b>

							
								@php $other=$message->msg_from;  @endphp
								
							@endif
						@endforeach
					@else
						@foreach($users as $pic)
							@if($pic->id == $message->msg_to)
								<div class="avatar pull-right">
								<a href="">
                                <img class="media-object img-thumbnail avatar" alt="" src="{{ $pic->avatar_url}}"  style="width:48px;height:48px;"/>
								</a>
								</div><br>
								<b class="pull-right">{{ $pic->username}} </b>
							    @php $other=$message->msg_to;  @endphp
								
							@endif
						@endforeach
				    @endif
                       

<div class="infos">

<div class="media-heading">
<span class="meta">
<span class="timeago"><i class="pull-left">{{ $message->date }} </i></span>
</span>
</div>
<br>
<div class="media-body markdown-reply content-body"  >
<b class="pull-right" >   {{ $message->text }} </b>
 </div>
  <div class="message-meta push-right">
<p>	
@if($message->msg_from !=Auth::user()->id)
<a href="messages/{{ $message->msg_from }}" class="normalize-link-color ">                                
<span style="color:#ff7b00;" class="pull-right">
<i class="fa fa-commenting-o" aria-hidden="true"><b class="pull-right">اقرا المحادثة </b></i>
</span>    </a>
@else

<a href="messages/{{ $message->msg_to }}" class="normalize-link-color ">                                
<span style="color:#ff7b00;" class="pull-right">
<i class="fa fa-commenting-o" aria-hidden="true"><b class="pull-right">اقرا المحادثة </b></i>
</span>    </a>
@endif															

								
								
							
                                </p>
                            </div>
                        </div>
                    </li>
					
					
						  @else
							   <li class="list-group-item media " style="margin-top: 0px;">
						   
						   
					 @if($message->msg_from != Auth::user()->id)
					@foreach($users as $user)
				 @if($message->msg_from == $user->id)
					 <div class="avatar pull-right">
                            <a href="">
                                <img class="media-object img-thumbnail avatar" alt="" src="{{ $user->avatar_url }}"  style="width:48px;height:48px;"/>
                            </a>
							
                        </div><br>
					 <b class="pull-right">{{ $user->username }}  </b>
				 @endif
				 
				 @endforeach
				 
				 
				 
				 @else
					 
				 @foreach($users as $user)
				 @if($message->msg_to == $user->id)
					 <div class="avatar pull-right">
                            <a href="">
                                <img class="media-object img-thumbnail avatar" alt="" src="{{ $user->avatar_url }}"  style="width:48px;height:48px;"/>
                            </a>
							
                        </div><br>
					 <b class="pull-right">{{ $user->username }}  </b>
				 @endif
				 
				 @endforeach
				 
				 
					
				 @endif
                        

                        <div class="infos">

                          <div class="media-heading">


                           
                            <span class="meta">
                               <span class="timeago"><i class="pull-left">{{ $message->date }} </i></span>
                            </span>
                          </div>
                         
                          <div class="media-body markdown-reply content-body pull-right">
						  
						  
						  <br>
                           <h5 class="pull-right">    {{ $message->text }} </h5>
                          </div>
						    <div class="message-meta">
                                <p>
								@if($message->msg_from !=Auth::user()->id)
									 <a href="messages/{{ $message->msg_from }}" class="normalize-link-color ">

                                 
                                    <span style="color:#ff7b00;" class="pull-right">
                                         <i class="fa fa-commenting-o" aria-hidden="true"><b class="pull-right">اقرا المحادثة </b></i>
                                       
                                    </span>

                                  

                                </a>

@else
 <a href="messages/{{ $message->msg_to }}" class="normalize-link-color ">

                                 
                                    <span style="color:#ff7b00;" class="pull-right">
                                         <i class="fa fa-commenting-o" aria-hidden="true"><b class="pull-right">اقرا المحادثة </b></i>
                                       
                                    </span>

                                  

                                </a>

@endif
                                
                                </p>
                            </div>
                        </div>
                    </li>
						  
						  @endif
						  
						  
                          
                @endforeach
                </ul>
            </div>

            <div class="panel-footer text-right remove-padding-horizontal pager-footer">

            </div>

     

    </div>
</div>
</div>


 @stop
