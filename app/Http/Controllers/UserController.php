<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Http\Controllers;
use Illuminate\Http\Request;
use AltThree\Validator\ValidationException;
use Hifone\Models\Node;
use Auth;
use Hash;
use Hifone\Models\Identity;
use Hifone\Models\Location;
use Hifone\Models\Provider;
use Hifone\Models\Reply;
use Hifone\Models\Thread;
use Hifone\Models\Follow;
use Hifone\Models\User;
use Hifone\Models\Block;
use Hifone\Models\Visit;
use Hifone\Models\Following;
use Illuminate\Support\Facades\View;
use Input;
use Intervention\Image\ImageManagerStatic as Image;
use Redirect;
use DB;
use Hifone\Http\Controllers\Config;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['only' => ['edit', 'update', 'destroy', 'unbind']]);
    }

    public function index()
    {
        $users = User::recent()->take(48)->get();

        return $this->view('users.index')
            ->withUsers($users);
    }
	
	
	
	

    public function show(User $user)
    {
        $threads = Thread::forUser($user->id)->recent()->limit(10)->get();
        $replies = Reply::forUser($user->id)->recent()->limit(10)->get();
		$followers=DB::table('followings')->where('followed','=',$user->id);
		$followed=DB::table('followings')->where('follower','=',$user->id);
		$view=$this->view('users.show');
		/*  {


       $view= $this->view('auth.register');
			 
		 }*/
		
		if(Auth::user()!=null) { 
		$is_blocked=DB::select("SELECT * FROM block WHERE blocked='".Auth::user()->id."' AND blocker='".$user->id."' AND active=1 ");
		$has_blocked=DB::select("SELECT * FROM block WHERE blocker='".Auth::user()->id."' AND blocked='".$user->id."' AND active=1 ");
		
		
		//$subto=DB::select("SELECT * FROM followings WHERE follower='".Auth::user()->id."' AND followed='".$user->id."' ");
		 $subto=DB::table('followings')->where('follower','=', Auth::user()->id)->where('followed','=',$user->id)->count();
		 
		 if($user->id != Auth::user()->id )
		 { $visit=[
		'visitor'=> Auth::user()->id,
	'visited'=> $user->id,
		'date'=> date('Y-m-d H:i:s'),

		];
		
		 DB::table('visits')->insert(
   $visit);}
		
		 $view=$this->view('users.show',['is_blocked'=>$is_blocked,'has_blocked'=>$has_blocked,'subto'=>$subto,'followers'=>$followers,'followed'=>$followed])
            ->withUser($user)
            ->withThreads($threads)
            ->withReplies($replies);
		 
		}
		
		 
        return $view;
		
		
		
    }
	
	
	
	public function later(User $user){
		
		$later=DB::select("SELECT threads.id,threads.title FROM threads INNER JOIN answer_later ON (threads.id=answer_later.thread_id) AND (answer_later.anserer_id='".Auth::user()->id."')");
		 return Redirect::route('users.later', ['user'=>$user->id,'later'=>$later]);
	}
	
	
		public function blok(User $user){
		
		$block=[
		'blocker'=> Auth::user()->id,
		'blocked'=>$user->id,
		'active'=> 1,
		
		];
		
		 DB::table('block')->insert(
   $block);
		
		
		
		  return Redirect::route('user.show', $user->id)
            ->withSuccess(sprintf('%s %s', trans('hifone.awesome'), trans('hifone.success')));
	}
	
	public function unblok(User $user){
		
		
		
		$nr_afr = DB::delete("delete from block where blocked ='".$user->id."'  and blocker='".Auth::user()->id."'");
		
		
		  return Redirect::route('user.show', $user->id)
            ->withSuccess(sprintf('%s %s', trans('hifone.awesome'), trans('hifone.success')));
	}
	
	
	

    public function showByUsername($username)
    {
        return $this->show(User::findByUsernameOrFail($username));
    }

    public function edit(User $user)
    {
        $this->needAuthorOrAdminPermission($user->id);
        $providers = Provider::recent()->get();
        $ids = $user->identities()->pluck('provider_id')->all();

        return $this->view('users.edit')
            ->withProviders($providers)
            ->withTab(Input::get('tab'))
            ->withBindOauthIds($ids)
            ->withUser($user);
    }

    public function update(User $user)
    {
        $this->needAuthorOrAdminPermission($user->id);
        $data = Input::only('nickname', 'location', 'company', 'website', 'signature', 'bio', 'locale');
        try {
            if ($data['location']) {
                $location = Location::where('name', $data['location'])->first();
                if (!is_null($location)) {
                    $data['location_id'] = $location->id;
                }
            }

            $user->update($data);
        } catch (ValidationException $e) {
            return Redirect::route('user.edit')
                ->withInput(Input::all())
                ->withErrors($e->getMessageBag());
        }

        return Redirect::route('user.edit', $user->id)
            ->withSuccess(sprintf('%s %s', trans('hifone.awesome'), trans('hifone.success')));
    }

    public function destroy(User $user)
    {
        $this->needAuthorOrAdminPermission($user->id);
    }

    public function replies(User $user)
    {
        $replies = Reply::forUser($user->id)->recent()->paginate(15);

        return $this->view('users.replies')
            ->withUser($user)
            ->withReplies($replies);
    }

    public function threads(User $user)
    {
        $threads = Thread::forUser($user->id)->recent()->paginate(15);

        return $this->view('users.threads')
            ->withUser($user)
            ->withThreads($threads);
    }


	
	  public function following(User $user){
		 
		 $following = Follow::forUser($user->id)->recent()->paginate(15);

        return $this->view('users.following')
            ->withUser($user)
            ->withThreads($following);
	 }
	 
	 
	 public function followers(User $user){
		 
		 $followers = Follow::forUser($user->id)->recent()->paginate(15);

        return $this->view('users.followers')
            ->withUser($user)
            ->withThreads($followers);
	 } 
	

	
	
	
	
	
    public function favorites(User $user)
    {
        $threads = $user->favoriteThreads()->paginate(15);
		$later=DB::select("SELECT threads.id,threads.title FROM threads INNER JOIN answer_later ON (threads.id=answer_later.thread_id) AND (answer_later.anserer_id='".Auth::user()->id."')");

        return $this->view('users.favorites',['later'=>$later])
            ->withUser($user)
            ->withThreads($threads);
    }

    public function credits(User $user)
    {
        $credits = $user->credits()->paginate(15);

        return $this->view('users.credits')
            ->withUser($user)
            ->withCredits($credits);
    }

    public function city($name)
    {
        $location = Location::where('name', $name)->firstOrFail();
        $users = $location->users()->paginate(15);

        return $this->view('users.city')
            ->withLocation($location)
            ->withUsers($users);
    }

    public function blocking(User $user)
    {
        $user->is_banned = (!$user->is_banned);
        $user->save();

        return Redirect::route('users.show', $user->id);
    }

    public function unbind(User $user)
    {
        $this->needAuthorOrAdminPermission($user->id);
        $record = Identity::where('user_id', '=', $user->id)->where('provider_id', '=', Input::get('provider_id'))->first();

        $record ? $record->delete() : null;

        return Redirect::route('user.edit', $user->id)
            ->withSuccess(trans('hifone.login.oauth.unbound_success'));
    }

    public function avatarupdate()
    {
        $user_id = Auth::id();
        $originFile = Input::file('avatar');

        $path = ($user_id % 10).'/'.($user_id % 10).'/';
        $destinationPath = public_path().'/uploads/avatar/'.$path;
        $saveName = $user_id.'.jpg';

        $originFile->move($destinationPath, $saveName);
        $img = Image::make($destinationPath.'/'.$saveName);

        $img->resize(192, 192)
            ->encode('jpg')
            ->save();

        $img->resize(48, 48)
            ->encode('jpg')
            ->save($destinationPath.$user_id.'_small.jpg');

        $user = Auth::user();
        $user->avatar_url = '/uploads/avatar/'.$path.$user_id.'.jpg';
        $user->save();

        return Redirect::back()
            ->withSuccess(trans('hifone.users.avatar_upload_success'));
    }

    protected function resetPassword()
    {
        $user = Auth::user();

        if (Hash::check(Input::only('old_password')['old_password'], $user->password)) {
            $password = Input::only('password')['password'];

            $password_confirmation = Input::only('password_confirmation')['password_confirmation'];

            if (!($password == $password_confirmation)) {
                return Redirect::back()
                    ->withInfo('当前输入新密码与错密码不一致, 请重新输入.');
            } else {
                $user->password = Hash::make(Input::only('password')['password']);

                $user->save();

                return Redirect::back()
                    ->withSuccess('密码修改成功!');
            }
        } else {
            return Redirect::back()
                ->withError('输入当前密码输入错误, 请重新输入.');
        }
    }
	
	
	 protected function blocked(User $user)
    {
	
		/* SELECT users.username
FROM users
INNER JOIN block ON ((users.id=block.blocked)AND (block.blocker=1)) ; */
		
	$blocked  = DB::table('users as u')
	->join ('block as b',  'b.blocked', '=' ,'u.id')
	->where('b.blocker','=',$user->id)
    ->select('u.username')
	->get();
		 /* return $this->view('users.blocks')
            ->withUser($user)
            ->withVisits($blocked); */
			 return view('users.blocks', ['blocked' => $blocked,'user'=> $user]);
	}
	
	
	
	protected function nodes_sub(User $user)
    {
	
		/* SELECT users.username
FROM users
INNER JOIN block ON ((users.id=block.blocked)AND (block.blocker=1)) ; */
		
	$nodes_sub  = DB::table('nodes as u')
	->join ('node_subscription as b', 'b.node_id','=','u.id')
	->where('b.subscriber', '=' ,Auth::user()->id)
    ->select('u.name','u.id')
	->get();
	
			 return view('users.nodes', ['nodes' => $nodes_sub,'user'=> $user]);
	}
	
		public function create_node_user(Request $request)	{
		
		$curdatetime= date('Y-m-d H:i:s');

		//$nodeData = Input::get('nodes');
		$node= new Node;
		$node->name= $request->input('name');
		$node->section_id=1;
		$node->created_at=$curdatetime;
	
$last_record = DB::table('nodes')->orderBy('id', 'desc')->first();


$numbers  = DB::table('node_creation as u')
	->where ('u.created_by',  '=', Auth::user()->id)
    ->select('u.id')
	->count();	
	
	if($numbers<10)  {DB::table('nodes')->insert(
    ['name' => $node->name, 'section_id' =>$node->section_id, 'created_at' => $node->created_at]
);	


DB::table('node_creation')->insert(
    ['node_id' => $last_record->id +1, 'created_by' => Auth::user()->id,'date' => $node->created_at]
);

DB::table('node_subscription')->insert(
    [ 'subscriber' => Auth::user()->id,'node_id' => $last_record->id +1,'date' => $node->created_at]
);
$nodes_sub  = DB::table('nodes as u')
	->join ('node_subscription as b', 'b.node_id','=','u.id')
	->where('b.subscriber', '=' ,Auth::user()->id)
    ->select('u.name','u.id')
	->get();
	
			 $message= view('users.nodes', ['nodes' => $nodes_sub,'user'=> Auth::user()]);
//$message=view('users.nodes',['user'=>Auth::user()->id]);
	}
		
		else
		{
			
			
			$message=view('users.nodes',['user'=>Auth::user()->id])->withSuccess(sprintf('%s %s', "Error !", "لقد تجاوزت عدد التصنيفات المتاحة"));
		}
		
		 return $message;
		
	}
	

	
	public function visits(User $user)
    {    //$user = Auth::user();
        $visits =DB::table('visits')->where('visited','=',$user->id)
	->get();
	$today = date("Y-m-d H:i:s");
	$visits_day =DB::table('visits')->where('visited','=',$user->id)->where('date','=',$today)
	->get();
	$currentMonth = date('m');
	$visits_month =DB::table('visits')->where('visited','=',$user->id)->whereRaw('MONTH(date) = ?',[$currentMonth])
	->get();
   // return view('users.partials.visits', ['visits' => $visits]); 
	
	//$visits = DB::table('visits')->forUser($user->id)->recent()->paginate(15);

       /*  return $this->view('users.visits')
            ->withUser($user)
            ->withVisits($visits,$visits_day,$visits_month); */
			 return view('users.visits', ['user' =>$user,'visits' =>$visits,'visits_day' =>$visits_day,'visits_month' =>$visits_month]);
    }
	
	
		
	
	
	
	 public function subscribers(User $user){
		 
		  $subscribers  = DB::table('users as u')
	->join ('followings as b',  'b.follower', '=' ,'u.id')
	->where('b.followed','=',$user->id)
    ->select('u.*')
	->get();

      
			 return view('users.subscribers', ['subscribers' => $subscribers,'user'=> $user]);
		 
		 
	 }
	 
	 
	 
	 
	 
	 
	 public function subscribed(User $user){
		 
		 
		 $subscribed  = DB::table('users as u')
	->join ('followings as b',  'b.followed', '=' ,'u.id')
	->where('b.follower','=',$user->id)
    ->select('u.*')
	->get();

       /*  return $this->view('users.subscribed')
            ->withUser($user)
            ->withThreads('subscribed',$subscribed); */
		 
		 return view('users.subscribed', ['subscribed' => $subscribed,'user'=> $user]);
		 
	 }
	
	
	
	 public function follow(User $user){
		 $dnow=date("Y-m-d H:i:s");
		 $data = [
            'follower'     => Auth::user()->id,
            'followed'       => $user->id,
			'date' =>$dnow,
			
        ];

       User::where('id', $user->id)->update(array('notification_count' => $user->notification_count+1));
       User::where('id', Auth::user()->id)->update(array('notification_count' =>Auth::user()->notification_count+1));
	   
	   
	   $notif_me = [
            'author_id'     => Auth::user()->id,
            'user_id'       => $user->id,
			//'object_id'     =>  17,
			//'object_type'  =>   'Hifone\Models\Follow',
            'body'          =>" باتباعك وتستحق +1 سمعة  ".Auth::user()->username."  قام",
            'type'          => 'followed',
            'created_at'    => $dnow,
            'updated_at'    => $dnow,
        ];

    DB::table('notifications')->insert(
   $notif_me);	
   
   
    $notif = [
            'author_id'     => $user->id,
            'user_id'       => Auth::user()->id,
			//'object_id'     =>  17,
			//'object_type'  =>   'Hifone\Models\Follow',
            'body'          => " قمت باتباع احدهم تستحق +1 نقطة",
            'type'          => 'follow',
            'created_at'    => $dnow,
            'updated_at'    => $dnow,
        ];

    DB::table('notifications')->insert(
   $notif);	
   
	   
       User::where('id', $user->id)->update(array('somaa' => $user->somaa+1));
       User::where('id', Auth::user()->id)->update(array('score' => Auth::user()->score+1));
	   
	   
    DB::table('followings')->insert(
   $data);	


   return Redirect::route('user.show', $user->id);
		 
	 }
	 
	  public function unfollow(User $user){
		 
		 DB::delete("delete from followings where follower = '".Auth::user()->id."' AND followed='".$user->id."'");	 
		 User::where('id', $user->id)->update(array('somaa' => $user->somaa-1));
       User::where('id', Auth::user()->id)->update(array('score' => Auth::user()->score-1));
	   
	   return Redirect::route('user.show', $user->id);
		 
	 }
	 
	 /* 
	  public function bestanswerers(User $user){
		 	 
		 
	 } */
	 /*
	 
	  public function scoreminus(User $user){
		 
		 	 
		 
	 } */
	
	
}
