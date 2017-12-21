 <ul class="list-group pull-right">

  <?php foreach($subscribed as $index => $subd): ?>
   <li class="list-group-item pull-right" >

     

      

        <a href="../<?php echo $subd->id; ?>" title="">
        <b color="black">  <?php echo $subd->username; ?> </b><img src="  <?php echo $subd->avatar_url; ?>" width="30px" height="30px">
        </a>
       
       

    

  </li>
  <br>
  <?php endforeach; ?>

</ul>
