<ul class="list-group">
  @foreach ($nodes as $node) 
 

  
   <li class="list-group-item">

   
      
      <span class="meta">
         <span class="timeago" title="">{!! $node->name !!}  </span>
      </span>
      

  </li>
  
  @endforeach


</ul>
