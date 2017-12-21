

@extends('layouts.default')

@section('title')
@if(Request::is('/'))

@else
{{ trans('hifone.threads.list') }}
 - @parent
@endif
@stop

@section('content')

<div class="col-md-9 threads-index main-col">
    <div class="panel panel-default">

        <div class="panel-heading">
        <div class="pull-left hidden-sm hidden-xs">
          @if (Request::is('/'))
            <i class="fa fa-list"></i> الاستقبال
          
          @elseif (isset($tag))
          <div class="node-info">
          {{ trans('hifone.tags.name') }}: <strong>{{ $tag->name }}</strong>
          <span class="total">, {{ trans('hifone.threads.thread_count', ['threads' => $tag->threads->count() ]) }}</span>
          </div>
          @else
          <i class="fa fa-comments-o"></i> {{ trans('hifone.threads.threads') }}
          @endif
          </div>
          @if (!isset($tag))
            @include('threads.partials.filter')
          @endif
          <div class="clearfix"></div>
        </div>

        @if ( ! $threads == null)

            <div class="panel-body remove-padding-horizontal">
                @include('threads.partials.threads')
            </div>

            <div class="panel-footer text-right remove-padding-horizontal pager-footer">
                <!-- Pager -->
               
            </div>

        @else
            <div class="panel-body">
                <div class="empty-block">ما من اسئلة</div>
            </div>
        @endif

	
    </div>
<br>
	<div class="panel panel-default">

        <div class="panel-heading">
        <div class="pull-left hidden-sm hidden-xs">
         
            <i class="fa fa-list"></i> ربما تود الإجابه عن
          
         
          </div>
         
          <div class="clearfix"></div>
        </div>

        @if (  count($random_q) != 0 )

            <div class="panel-body remove-padding-horizontal">
                @include('threads.partials.random')
            </div>

            

        @else
            <div class="panel-body">
                <div class="empty-block">مامن اسئلة</div>
            </div>
        @endif

		
	
    </div>

	<br>
	<div class="panel panel-default">

        <div class="panel-heading">
        <div class="pull-left hidden-sm hidden-xs">
         
            <i class="fa fa-list"></i> اسئلة الذين انابعهم
          
         
          </div>
         
          <div class="clearfix"></div>
        </div>

        @if (  count($subthreads) != 0 )

            <div class="panel-body remove-padding-horizontal">
                @include('threads.partials.subthreads')
            </div>

            

        @else
            <div class="panel-body">
                <div class="empty-block">مامن اسئلة</div>
            </div>
        @endif

		
	
    </div>

	
	
    <!-- Nodes List -->
   

</div>
 
@include('partials.sidebar')


@stop

