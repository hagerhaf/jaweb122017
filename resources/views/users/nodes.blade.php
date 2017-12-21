@extends('layouts.default')
 
@section('title')
{!! $user->username !!} 
@stop

@section('content')


<div class="users-show">

  <div class="col-md-3 box">
    @include('users.partials.basicinfo')
  </div>

  <div class="col-md-9 left-col">


  <div class="panel panel-default">

    <div class="panel-body">
      @include('users.partials.infonav')
      @if (count($nodes))
	      @include('users.partials.nodes')
	      <div class="pull-right add-padding-vertically">
	      @if($user->username == Auth::user()->username)
		  <button id="myBtn">اضافة تصنيف</button>
	  
	  <div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <form method="POST" action="new_node">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
	<input name="name" type="text" placehoder="ادخل اسم التصنيف"/>
	<input type="submit" />
	
	</form>
  </div>

</div>
<style>
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
}

/* The Close Button */
.close {
    color: #aaaaaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}
</style>
<script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
	  
	  
	  @endif
	      </div>
      @else
	       <div class="empty-block">لم يشترك في تصنيف بعد</div>
      @endif

    </div>

  </div>
</div>
</div>

@stop
