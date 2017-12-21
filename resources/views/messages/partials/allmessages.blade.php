@foreach ($messages as $message) 
  <li>{{ $message->text }}</li>
@endforeach