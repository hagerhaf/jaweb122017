 <ul class="list-group pull-right">

  @foreach ($subscribed as $index => $subd)
   <li class="list-group-item pull-right" >

     

      

        <a href="../{!! $subd->id !!}" title="">
        <b color="black">  {!! $subd->username !!} </b><img src="  {!! $subd->avatar_url !!}" width="30px" height="30px">
        </a>
       
       

    

  </li>
  <br>
  @endforeach

</ul>
