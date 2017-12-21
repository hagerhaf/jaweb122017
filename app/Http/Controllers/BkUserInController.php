<?php

namespace Hifone\Http\Controllers;

use Illuminate\Http\Request;

use Hifone\Http\Requests;

class BkUserInController extends Controller
{
  public function insertform(){
return view('user_blocked');
}


public function insert(Request $request){
$name = $request->input('stud_name');
DB::insert('insert into block (name) values(?)',[$name]);
echo "Record inserted successfully.<br/>";
echo '<a href="/insert">Click Here</a> to go back.';
}
}
