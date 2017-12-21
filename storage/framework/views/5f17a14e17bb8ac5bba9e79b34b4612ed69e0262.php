<ul class="list-group">
  <?php foreach($later as $lat): ?> 
 

  
   <li class="list-group-item">

   
      
      <span class="meta">
         <span class="timeago" title=""><a href="<?php echo route('thread.show', [$lat->id]); ?>"><?php echo $lat->title; ?> </a> </span>
      </span>
      

  </li>
  
  <?php endforeach; ?>


</ul>
