<?php

namespace Hifone\Http\Controllers;

use Illuminate\Http\Request;

use Hifone\Http\Requests;

class ReportInController extends Controller
{
   public function insertform(){
return view('stud_create');
}


public function insert(Request $request){
$name = $request->input('stud_name');
DB::insert('insert into report (name) values(?)',[$name]);
echo "Record inserted successfully.<br/>";
echo '<a href="/insert">Click Here</a> to go back.';
}
}
