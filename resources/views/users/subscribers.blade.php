 @extends('layouts.default')

@section('title')
{{{ $user->username }}} {{ trans('hifone.sucscribers.list') }}_@parent
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
      @if (count($subscribers))
	    @include('users.partials.subscribers')
	    <div class="pull-right add-padding-vertically">
	        
	    </div>
      @else
        <div class="empty-block"></div>
      @endif

    </div>

  </div>
</div>
</div>

@stop
