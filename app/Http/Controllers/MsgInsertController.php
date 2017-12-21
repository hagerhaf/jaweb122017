<?php

namespace Hifone\Http\Controllers;

use Illuminate\Http\Request;

use Hifone\Http\Requests;

class MsgInsertController extends Controller
{
    public function insertform(){
return view('message_create');
}
public function insert(Request $request){
/* $name = $request->input('message');
DB::insert('insert into messages (name) values(?)',[$name]);
echo "Record inserted successfully.<br/>";
echo '<a href="/insert">Click Here</a> to go back.'; */
}

}
