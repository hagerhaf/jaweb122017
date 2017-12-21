<?php

namespace Hifone\Http\Controllers;

use Illuminate\Http\Request;

use Hifone\Http\Requests;

class VisitInController extends Controller
{
    public function insertform(){
return view('visits');
}


public function insert(Request $request){
$name = $request->input('visits');
DB::insert('insert into visits (name) values(?)',[$name]);
echo "Record inserted successfully.<br/>";
echo '<a href="/insert">Click Here</a> to go back.';
}
}
