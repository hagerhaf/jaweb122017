

@section('content')
    @foreach($messages as $message)
        <p>{{ $message->name }}</p>
    @endforeach
@stop