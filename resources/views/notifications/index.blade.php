@extends('layouts.default')

@section('title')
تنبيهاتي @parent
@stop

@section('content')

<div class="notifications panel">

    <div class="panel-heading clearfix">
      التنبيهات
      <span class="pull-right">
          <a class="btn btn-sm btn-danger" rel="nofollow" data-method="post" data-url="/notification/clean">محو</a>
      </span>
    </div>

    @if (count($notifications))
	<div class="panel-body remove-padding-horizontal notification-index content-body">

		<ul class="list-group row">
			@foreach ($notifications as $notif )
				<div class="notification-group">
				<div class="group-title"><i class="fa fa-clock-o"></i> {{ $notif->created_at }}</div>
			<div class="pull-right">	{{ $notif->body }}</div>
				</div>
			@endforeach
		</ul>
	</div>
	<div class="panel-footer text-right remove-padding-horizontal pager-footer">
		<!-- Pager -->
	</div>
    @else
	<div class="panel-body">
		<div class="empty-block">ما من تنبيهات</div>
	</div>
    @endif

</div>


@stop
