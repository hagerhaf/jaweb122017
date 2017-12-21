<ul class="list-group">
  <?php foreach($nodes as $node): ?> 
 

  
   <li class="list-group-item">

   
      
      <span class="meta">
         <span class="timeago" title=""><?php echo $node->name; ?>  </span>
      </span>
      

  </li>
  
  <?php endforeach; ?>


</ul>
