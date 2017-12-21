<?php

namespace Hifone\Http\Controllers;
use DB;
use Auth;
use Illuminate\Http\Request;

use Hifone\Http\Requests;
use Hifone\Models\User;

use Hash;
use Hifone\Models\Identity;
use Hifone\Models\Location;
use Hifone\Models\Provider;

use Hifone\Models\Message;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use Input;
use Redirect;

class PrivateMsgController extends Controller
{
	
	

        public function __construct()
    {
        parent::__construct();

        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
public function index()
    {
		
		//$messages = Message::paginate();
		
		$messages= DB::select("SELECT * from messages where id in (
SELECT MAX(id) AS id
FROM messages
WHERE msg_to ='".Auth::user()->id."' OR msg_from ='".Auth::user()->id."'
GROUP BY (IF(msg_to ='".Auth::user()->id."', msg_from, msg_to)))");


 $update2=DB::update("UPDATE users SET newmessagesCount='". 0 ."
 ' WHERE id='". Auth::user()->id ."'");

$users_pic=DB::select("SELECT id,username,avatar_url FROM users WHERE id <> '".Auth::user()->id."'");

	
    return view('messages.index',[ 'messages' => $messages,'users'=>$users_pic]);

    }

    public function show($id)
    {   $user = Auth::user();
        $messages =DB::table('messages')->where('msg_from','=',$user->id)->where('msg_to','=',$id)->orwhere('msg_from','=',$id)->where('msg_to','=',$user->id)->get();
	$partner=DB::table('users')->where('id','=',$id)
	->first();
	
	
	$update=DB::update("UPDATE messages SET msg_read='1
 ' WHERE msg_from='". $user->id ."' AND msg_to='".$id."'");
	
	
	
	
	$users_pic=DB::select("SELECT id,username,avatar_url FROM users WHERE id <> '".Auth::user()->id."'");
        return view('messages.show',['messages'=>$messages,'partner'=>$partner,'id'=>$id,'user'=>$user,'users_pic'=>$users_pic]);
		
		
      
		
		
    }

   /*  public function create($id)
    {
        
        return view('messages.create');
    }
 */
   // public function store(Request $request, Markdown $markdown)
    public function store(Request $request)
    {
		$text = $request->input('message');
		$sender=Auth::user();
		$msg_to=$request->input('msg_to');
		$msg_date=date("Y-m-d H:i:s");
		$warning=null;
		$pos = strpos($text,'http://');
		
		if(strlen(strstr($text,'http://'))>0){
			
		$warning="(توخي الحذر عند نقر اي رابط فقد يكون مشبوها)";	
		$text =$text."\n ".$warning;	
		}
		
		
		DB::table('messages')->insert(
    ['msg_from' => $sender->id, 'msg_to' => $msg_to, 'text' => $text,'date' => $msg_date,'msg_read' => 0]
);

$msgto = User::where('id', '=',  $msg_to)->first();
//$msgto=DB::select("SELECT * FROM users WHERE id='".$msg_to."' LIMIT 1");
 //$update=User::where('id', $msgto->id)->update(array('newmessagesCount' => $msgto->newmessagesCount+1));
 $inc=$msgto->newmessagesCount +1;
 $update=DB::update("UPDATE users SET newmessagesCount='".$inc ."
 ' WHERE id='". $msgto->id ."'");
 
return Redirect::route('messages.show', ['id'=>$msg_to]);
		
		
        
    }
}
