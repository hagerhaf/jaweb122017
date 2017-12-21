<ul class="list-group">
  @foreach ($blocked as $block) 
 

  
   <li class="list-group-item">

   
      
      <span class="meta">
         <span class="timeago" title="">{!! $block->username !!}  </span>
      </span>
      

  </li>
  
  @endforeach


</ul>
