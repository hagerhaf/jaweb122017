<ul class="list-group">
  @foreach ($later as $lat) 
 

  
   <li class="list-group-item">

   
      
      <span class="meta">
         <span class="timeago" title=""><a href="{!! route('thread.show', [$lat->id]) !!}">{!! $lat->title !!} </a> </span>
      </span>
      

  </li>
  
  @endforeach


</ul>
