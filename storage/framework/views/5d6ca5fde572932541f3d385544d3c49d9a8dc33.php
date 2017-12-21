<ul class="list-group">
  <?php foreach($blocked as $block): ?> 
 

  
   <li class="list-group-item">

   
      
      <span class="meta">
         <span class="timeago" title=""><?php echo $block->username; ?>  </span>
      </span>
      

  </li>
  
  <?php endforeach; ?>


</ul>
