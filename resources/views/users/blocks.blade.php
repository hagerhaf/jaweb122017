@extends('layouts.default')
 
@section('title')
{!! $user->username !!} 
@stop

@section('content')


<div class="users-show">

  <div class="col-md-3 box">
    @include('users.partials.basicinfo')
  </div>

  <div class="col-md-9 left-col">


  <div class="panel panel-default">

    <div class="panel-body">
      @include('users.partials.infonav')
      @if (count($blocked))
	      @include('users.partials.blocks')
	      <div class="pull-right add-padding-vertically">
	       Blocked 
	      </div>
      @else
	       <div class="empty-block">You have not blocked people yet</div>
      @endif

    </div>

  </div>
</div>
</div>

@stop
