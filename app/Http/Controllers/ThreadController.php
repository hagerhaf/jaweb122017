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

use AltThree\Validator\ValidationException;
use Auth;
use Hifone\Commands\Append\AddAppendCommand;
use Hifone\Commands\Thread\AddThreadCommand;
use Hifone\Commands\Thread\RemoveThreadCommand;
use Hifone\Commands\Thread\UpdateThreadCommand;
use Hifone\Events\Thread\ThreadWasViewedEvent;
use Hifone\Models\Node;
use Hifone\Models\Section;
use Hifone\Models\Thread;
use Hifone\Models\User;
use Hifone\Repositories\Criteria\Thread\BelongsToNode;
use Hifone\Repositories\Criteria\Thread\Filter;
use Hifone\Repositories\Criteria\Thread\Search;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use Input;
use Redirect;
use DB;
class ThreadController extends Controller
{
    /**
     * Creates a new thread controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Shows the threads view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
		
		 $repository = app('repository');
     $filter=   $repository->pushCriteria(new Filter(Input::query('filter')));
        $repository->pushCriteria(new Search(Input::query('q')));
	
	         //$threads = $repository->model(Thread::class)->get();
		$threads=DB::table('threads')->get();
			$authors  = DB::table('users as u')
	->join ('threads as b',  'b.user_id', '=' ,'u.id')
    ->select('u.username','u.id','u.avatar_url')
	->get();
			
			
			
			 $node =Node::paginate(30);
			 
			 $threadz=DB::table('threads')->get();


 $dnow=date("Y-m-d H:i:s");
$date1=date_create($dnow);
 



foreach($threadz as $thread)
{
 $dafter=$thread->created_at;
 
 

$date2=date_create($dafter);
$diff=date_diff($date1,$date2);

if($diff->format("%d")>=30 && $thread->reply_count==0){
	
$data = [
            'author_id'     => $thread->user_id,
            'user_id'       => $thread->user_id,
			'object_id'     =>  17,
			'object_type'  =>   'Hifone\Models\Thread',
            'body'          => $thread->title,
            'type'          => '30_days',
            'created_at'    => $dnow,
            'updated_at'    => $dnow,
        ];

       User::where('id', $user->id)->update(array('notification_count' => $user->notification_count+1));
    DB::table('notifications')->insert(
   $data);	
}

			 
		
}
		 
			 
			

$best_user =DB::table('users')->where('score', DB::raw("(select max(`score`) from users)"))->select('users.username','users.id','users.score','users.avatar_url')->first();			
			 
			 
/* $best_answerers=DB::table('users as u')
	->join ('replies as b',  'b.user_id', '=' ,'u.id')
    ->select('u.username','u.id')
	->get();


	*/
	
	
	
	if(Auth::user() !=null) {
		
		$random_q=DB::table('threads as u')
	->join ('node_subscription as b',  'b.node_id', '=' ,'u.node_id')
	->where('b.subscriber','=',Auth::user()->id)
	->where('u.reply_count','=',0)
	->select('u.id','u.title','u.user_id','u.reply_count','u.points','u.created_at','u.best_answer','u.like_count','u.anonymous')
	->orderByRaw('RAND()')
	->take(10)
	->get();
		$subthreads=DB::select("SELECT threads.* FROM threads INNER JOIN followings ON (threads.user_id=followings.followed) AND (followings.follower='".Auth::user()->id."')");

	}
	
	
	else  {
	$random_q=null;	
	$subthreads=null;
		
	}
	
	
			 $bestanswerers=DB::select("SELECT count(*) as ba,users.* FROM users INNER JOIN replies on users.id=replies.user_id INNER JOIN threads t on t.best_answer=replies.id GROUP BY users.id ORDER BY ba DESC LIMIT 10");
		 
			 return $this->view('threads.index',['threads' => $threads,'node' => $node,'authors' => $authors,'best_user'=>$best_user,'random_q'=>$random_q,'subthreads'=>$subthreads,'bestanswerers'=>$bestanswerers]) 
			->withThreads($threads)->withSections(Section::orderBy('order')->get()); 
		
		
			
      
			
    }

	
	
	 public function RecentThreads(){
		 $repository = app('repository');
     $filter=   $repository->pushCriteria(new Filter(Input::query('filter')));
        $repository->pushCriteria(new Search(Input::query('q')));
	
	         $threads = DB::table('threads')->orderBy('id', 'desc')->get();

			 
			 
			$authors  = DB::table('users as u')
	->join ('threads as b',  'b.user_id', '=' ,'u.id')
    ->select('u.username','u.id','u.avatar_url')
	->get();
			
			
			
			 $node =Node::paginate(30);
			 
			 $threadz=DB::table('threads')->get();


 $dnow=date("Y-m-d H:i:s");
$date1=date_create($dnow);
 



foreach($threadz as $thread)
{
 $dafter=$thread->created_at;
 
 

$date2=date_create($dafter);
$diff=date_diff($date1,$date2);

if($diff->format("%d")>=30 && $thread->reply_count==0){
	
$data = [
            'author_id'     => $thread->user_id,
            'user_id'       => $thread->user_id,
			'object_id'     =>  17,
			'object_type'  =>   'Hifone\Models\Thread',
            'body'          => $thread->title,
            'type'          => '30_days',
            'created_at'    => $dnow,
            'updated_at'    => $dnow,
        ];

       User::where('id', $user->id)->update(array('notification_count' => $user->notification_count+1));
    DB::table('notifications')->insert(
   $data);	
}

			 
		
}
		 
			 
			

$best_user =DB::table('users')->where('score', DB::raw("(select max(`score`) from users)"))->select('users.username','users.id','users.score','users.avatar_url')->first();			
			 
			 
/* $best_answerers=DB::table('users as u')
	->join ('replies as b',  'b.user_id', '=' ,'u.id')
    ->select('u.username','u.id')
	->get();


	*/
	
	
	
	if(Auth::user() !=null) {
		
		$random_q=DB::table('threads as u')
	->join ('node_subscription as b',  'b.node_id', '=' ,'u.node_id')
	->where('b.subscriber','=',Auth::user()->id)
	->where('u.reply_count','=',0)
	->select('u.id','u.title','u.user_id','u.reply_count','u.points','u.created_at','u.best_answer','u.like_count','u.anonymous')
	->orderByRaw('RAND()')
	->take(10)
	->get();
		$subthreads=DB::select("SELECT threads.* FROM threads INNER JOIN followings ON (threads.user_id=followings.followed) AND (followings.follower='".Auth::user()->id."')");

	}
	
	
	else  {
	$random_q=null;	
	$subthreads=null;
		
	}
	
	
			 $bestanswerers=DB::select("SELECT count(*) as ba,users.* FROM users INNER JOIN replies on users.id=replies.user_id INNER JOIN threads t on t.best_answer=replies.id GROUP BY users.id ORDER BY ba DESC LIMIT 10");
		 
			 return $this->view('threads.index',['threads' => $threads,'node' => $node,'authors' => $authors,'best_user'=>$best_user,'random_q'=>$random_q,'subthreads'=>$subthreads,'bestanswerers'=>$bestanswerers]) 
			->withThreads($threads)->withSections(Section::orderBy('order')->get()); 
		
		
	} 
	
	
	
	
	 public function LikedThreads(){
		 $repository = app('repository');
     $filter=   $repository->pushCriteria(new Filter(Input::query('filter')));
        $repository->pushCriteria(new Search(Input::query('q')));
	
	         $threads = DB::table('threads')->orderBy('like_count', 'desc')->get();

			 
			 
			$authors  = DB::table('users as u')
	->join ('threads as b',  'b.user_id', '=' ,'u.id')
    ->select('u.username','u.id','u.avatar_url')
	->get();
			
			
			
			 $node =Node::paginate(30);
			 
			 $threadz=DB::table('threads')->get();


 $dnow=date("Y-m-d H:i:s");
$date1=date_create($dnow);
 



foreach($threadz as $thread)
{
 $dafter=$thread->created_at;
 
 

$date2=date_create($dafter);
$diff=date_diff($date1,$date2);

if($diff->format("%d")>=30 && $thread->reply_count==0){
	
$data = [
            'author_id'     => $thread->user_id,
            'user_id'       => $thread->user_id,
			'object_id'     =>  17,
			'object_type'  =>   'Hifone\Models\Thread',
            'body'          => $thread->title,
            'type'          => '30_days',
            'created_at'    => $dnow,
            'updated_at'    => $dnow,
        ];

       User::where('id', $user->id)->update(array('notification_count' => $user->notification_count+1));
    DB::table('notifications')->insert(
   $data);	
}

			 
		
}
		 
			 
			

$best_user =DB::table('users')->where('score', DB::raw("(select max(`score`) from users)"))->select('users.username','users.id','users.score','users.avatar_url')->first();			
			 
			 
/* $best_answerers=DB::table('users as u')
	->join ('replies as b',  'b.user_id', '=' ,'u.id')
    ->select('u.username','u.id')
	->get();


	*/
	
	
	
	if(Auth::user() !=null) {
		
		$random_q=DB::table('threads as u')
	->join ('node_subscription as b',  'b.node_id', '=' ,'u.node_id')
	->where('b.subscriber','=',Auth::user()->id)
	->where('u.reply_count','=',0)
	->select('u.id','u.title','u.user_id','u.reply_count','u.points','u.created_at','u.best_answer','u.like_count','u.anonymous')
	->orderByRaw('RAND()')
	->take(10)
	->get();
		$subthreads=DB::select("SELECT threads.* FROM threads INNER JOIN followings ON (threads.user_id=followings.followed) AND (followings.follower='".Auth::user()->id."')");

	}
	
	
	else  {
	$random_q=null;	
	$subthreads=null;
		
	}
	
	
			 $bestanswerers=DB::select("SELECT count(*) as ba,users.* FROM users INNER JOIN replies on users.id=replies.user_id INNER JOIN threads t on t.best_answer=replies.id GROUP BY users.id ORDER BY ba DESC LIMIT 10");
		 
			 return $this->view('threads.index',['threads' => $threads,'node' => $node,'authors' => $authors,'best_user'=>$best_user,'random_q'=>$random_q,'subthreads'=>$subthreads,'bestanswerers'=>$bestanswerers]) 
			->withThreads($threads)->withSections(Section::orderBy('order')->get()); 
		
		
	} 
	
	
	public function unanswered(){
		 $repository = app('repository');
     $filter=   $repository->pushCriteria(new Filter(Input::query('filter')));
        $repository->pushCriteria(new Search(Input::query('q')));
	
	         $threads = DB::table('threads')->where('reply_count','=', 0)->get();

			 
			 
			$authors  = DB::table('users as u')
	->join ('threads as b',  'b.user_id', '=' ,'u.id')
    ->select('u.username','u.id','u.avatar_url')
	->get();
			
			
			
			 $node =Node::paginate(30);
			 
			 $threadz=DB::table('threads')->get();


 $dnow=date("Y-m-d H:i:s");
$date1=date_create($dnow);
 



foreach($threadz as $thread)
{
 $dafter=$thread->created_at;
 
 

$date2=date_create($dafter);
$diff=date_diff($date1,$date2);

if($diff->format("%d")>=30 && $thread->reply_count==0){
	
$data = [
            'author_id'     => $thread->user_id,
            'user_id'       => $thread->user_id,
			'object_id'     =>  17,
			'object_type'  =>   'Hifone\Models\Thread',
            'body'          => $thread->title,
            'type'          => '30_days',
            'created_at'    => $dnow,
            'updated_at'    => $dnow,
        ];

       User::where('id', $user->id)->update(array('notification_count' => $user->notification_count+1));
    DB::table('notifications')->insert(
   $data);	
}

			 
		
}
		 
			 
			

$best_user =DB::table('users')->where('score', DB::raw("(select max(`score`) from users)"))->select('users.username','users.id','users.score','users.avatar_url')->first();			
			 
			 
/* $best_answerers=DB::table('users as u')
	->join ('replies as b',  'b.user_id', '=' ,'u.id')
    ->select('u.username','u.id')
	->get();


	*/
	
	
	
	if(Auth::user() !=null) {
		
		$random_q=DB::table('threads as u')
	->join ('node_subscription as b',  'b.node_id', '=' ,'u.node_id')
	->where('b.subscriber','=',Auth::user()->id)
	->where('u.reply_count','=',0)
	->select('u.id','u.title','u.user_id','u.reply_count','u.points','u.created_at','u.best_answer','u.like_count','u.anonymous')
	->orderByRaw('RAND()')
	->take(10)
	->get();
		$subthreads=DB::select("SELECT threads.* FROM threads INNER JOIN followings ON (threads.user_id=followings.followed) AND (followings.follower='".Auth::user()->id."')");

	}
	
	
	else  {
	$random_q=null;	
	$subthreads=null;
		
	}
	
	
			 $bestanswerers=DB::select("SELECT count(*) as ba,users.* FROM users INNER JOIN replies on users.id=replies.user_id INNER JOIN threads t on t.best_answer=replies.id GROUP BY users.id ORDER BY ba DESC LIMIT 10");
		 
			 return $this->view('threads.index',['threads' => $threads,'node' => $node,'authors' => $authors,'best_user'=>$best_user,'random_q'=>$random_q,'subthreads'=>$subthreads,'bestanswerers'=>$bestanswerers]) 
			->withThreads($threads)->withSections(Section::orderBy('order')->get()); 
		
		
	} 
	
		
	
    /**
     * Shows a thread in more detail.
     *
      @param \Hifone\Models\Thread $thread
     *
     * @return \Illuminate\View\View
     */
    public function show(Thread $thread)
    {
		$view=$this->view('threads.show');
		
	if(Auth::user()!=null)	{
        $this->breadcrumb->push([
                $thread->node->name => $thread->node->url,
                $thread->title      => $thread->url,
        ]);

        $replies = $thread->replies()
                    ->orderBy('like_count', 'desc')
                    ->paginate(Config::get('setting.replies_per_page', 30));

        $repository = app('repository');
        $repository->pushCriteria(new BelongsToNode($thread->node_id));
        $nodeThreads = $repository->model(Thread::class)->getThreadList(8);

        event(new ThreadWasViewedEvent($thread));
		$other_nodes=DB::table('thread_nodes')->where('thread_id','=',$thread->id)->get();
		$favorites=DB::table('favorites')->where('user_id','=',Auth::user()->id)->where('thread_id','=',$thread->id)->first();
		$follows=DB::table('follows')->where('user_id','=',Auth::user()->id)->where('followable_id','=',$thread->id)->where('followable_type','=','Thread')->first();
		
		
		$later=DB::table('answer_later')->where('anserer_id','=',Auth::user()->id)->where('thread_id','=',$thread->id)->first();
		$view=$this->view('threads.show',['thread'=>$thread,'replies'=>$replies,'nodeThreads'=>$nodeThreads,'favorites'=>$favorites,'follows'=>$follows,'later'=>$later])
		->withSuccess(sprintf('%s %s', trans('hifone.awesome'), trans('hifone.success')));
		
	}
//,['others'=>$other_nodes]
        return $view;
            
    }

   
    public function create()
    {
        $node = Node::find(Input::query('node_id'));
        $sections = Section::orderBy('order')->get();

        $this->breadcrumb->push(trans('hifone.threads.add'), route('thread.create'));

        return $this->view('threads.create_edit')
            ->withSections($sections)
            ->withNode($node);
    }

    /**
     * Creates a new node.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {	
	$node = Node::find(Input::query('node_id'));
        $sections = Section::orderBy('order')->get();
	$view=$this->view('threads.create_edit')->withSections($sections)
            ->withNode($node);
            $anonymous=0;
        $threadData = Input::get('thread');
        $node_id = isset($threadData['node_id']) ? $threadData['node_id'] : null;
		$points= isset($threadData['points']) ? $threadData['points'] : null;
        $tags = isset($threadData['tags']) ? $threadData['tags'] : '';
		
		
		if (isset($_POST['thread[anonymous]'])) {
			$anonymous=$threadData['anonymous'];
			
		}
		
		
		
		//$dbdatetime=DB::table('threads')->orderBy('created_at','DESC')->where('user_id','=',Auth::user()->id)->first();
				$dbdatetime=DB::select("SELECT created_at FROM threads WHERE user_id='".Auth::user()->id."' ORDER BY id DESC LIMIT 1 ");


$thread=[
'title'=>$threadData['title'],
'body'=>$threadData['body'],
'points'=>$points,
'node_id'=>$threadData['node_id'],
'user_id'=>Auth::user()->id,
'anonymous'=>$anonymous,
'created_at'=>gmdate('Y-m-d H:i:s'),

];


$curtime      = gmdate('now');

$str= json_encode($dbdatetime);
$sub= substr($str, 16, 19);
$lasdate=gmdate($sub);
//return round(abs($curtime - $lasdate) / 60,2);
  $to_time = strtotime('now');
        $from_time = strtotime($sub);
        $minutes = ($to_time - $from_time) % 3600 / 60;
/* echo 	gmdate('Y-m-d H:i:s');
echo "<br>";
echo 	gmdate($sub);
echo "<br>";
        return ($minutes < 0 ? 0 : abs($minutes));  
 */
 if((($lasdate == null)||($minutes>= 10))&&(Auth::user()->score >= $threadData['points']))
{DB::table('threads')->insert(
   $thread);



 $curdatetime= date('Y-m-d H:i:s');

$last_record = DB::table('threads')->orderBy('id', 'desc')->first();

$id=$last_record->id ;

	 DB::table('thread_nodes')->insert(
    ['thread_id' => $last_record->id , 'node1' => $threadData['node2_id'], 'node2' => $threadData['node3_id']]
);	 
	
	//Auth::user()->score=Auth::user()->score - $threadData['points'];	
	User::where('id', Auth::user()->id)->update(array('score' => Auth::user()->score - $threadData['points']));	
	$view=Redirect::route('thread.show', ['thread'=>$last_record->id]);
	}
 

 

        return $view;   
		
    }

    /**
     * Shows the edit thread view.
     *
     * @param \Hifone\Models\Thread $thread
     *
     * @return \Illuminate\View\View
     */
    public function edit(Thread $thread)
    {
        $this->needAuthorOrAdminPermission($thread->user_id);
        $sections = Section::orderBy('order')->get();

        $thread->body = $thread->body_original;

        return $this->view('threads.create_edit')
            ->withThread($thread)
            ->withSections($sections)
            ->withNode($thread->node);
    }

	

    /**
     * Creates a new append.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function append(Thread $thread)
    {
        $this->needAuthorOrAdminPermission($thread->user_id);

        $content = Input::get('content') ?: '';

        try {
            /* $append = dispatch(new AddAppendCommand(
                $thread->id,
                $content
            )); */
			Thread::where('id', $thread->id)->update(array('body' => $thread->body."\n".$content));	
        } catch (ValidationException $e) {
            return Redirect::route('thread.show', $thread->id)
                ->withInput(Input::all())
                ->withErrors($e->getMessageBag());
        }

        return Redirect::route('thread.show', $thread->id)
            ->withSuccess(sprintf('%s %s', trans('hifone.awesome'), trans('hifone.success')));
    }

    /**
     * Edit a thread.
     *
     * @param \Hifone\Models\Thread $thread
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Thread $thread)
    {
        $threadData = Input::get('thread');

        $this->needAuthorOrAdminPermission($thread->user_id);

        try {
            $thread = dispatch(new UpdateThreadCommand($thread, $threadData));
        } catch (ValidationException $e) {
            return Redirect::route('thread.edit', $thread->id)
                ->withInput(Input::all())
                ->withErrors($e->getMessageBag());
        }

        return Redirect::route('thread.show', $thread->id)
            ->withSuccess(sprintf('%s %s', trans('hifone.awesome'), trans('hifone.success')));
    }

    /**
     * Recommend a thread.
     *
     * @param \Hifone\Models\Thread $thread
     *
     * @return \Illuminate\View\View
     */
    public function recommend(Thread $thread)
    {
        $this->needAuthorOrAdminPermission($thread->user_id);

        $updateData = [
            'is_excellent' => !$thread->is_excellent,
        ];

        $thread = dispatch(new UpdateThreadCommand($thread, $updateData));

        return Redirect::route('thread.show', $thread->id)
            ->withSuccess(sprintf('%s %s', trans('hifone.awesome'), trans('hifone.success')));
    }

    /**
     * Pin a thread.
     *
     * @param \Hifone\Models\Thread $thread
     *
     * @return \Illuminate\View\View
     */
    public function pin(Thread $thread)
    {
        $this->needAuthorOrAdminPermission($thread->user_id);
        ($thread->order > 0) ? $thread->decrement('order', 1) : $thread->increment('order', 1);

        return Redirect::route('thread.show', $thread->id);
    }

    /**
     * Sink a thread.
     *
     * @param \Hifone\Models\Thread $thread
     *
     * @return \Illuminate\View\View
     */
    public function sink(Thread $thread)
    {
        $this->needAuthorOrAdminPermission($thread->user_id);
        ($thread->order >= 0) ? $thread->decrement('order', 1) : $thread->increment('order', 1);

        return Redirect::route('thread.show', $thread->id);
    }

    /**
     * Deletes a given thread.
     *
     * @param \Hifone\Models\Thread $thread
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Thread $thread)
    {
        //$this->needAuthorOrAdminPermission($thread->user_id);
     /* $off = Thread::findOrFail($thread->id);
 
    $off->delete(); */
       // dispatch(new RemoveThreadCommand($thread));
	   $uid=$thread->user_id;
$nr_afr = DB::delete('delete from threads where id = ?', [$thread->id]);
	    return Redirect::route('home');
	   
	  //  $deletedRows = Hifone\Thread::where('id', $thread->id)->delete();
      //  return Redirect::route('thread.index'); 
           // ->withSuccess(sprintf('%s %s', trans('hifone.awesome'), trans('hifone.success')));
    }
	
	
	public function report_t(Thread $thread)
    {
		$report_date=date("Y-m-d H:i:s");	
	DB::table('reports')->insert(
    ['reporter' => Auth::user()->id, 'reported' => $thread->id, 'url' => 'thread/'.$thread->id,'date' => $report_date]
);	
	
return Redirect::route('thread.show', ['thread'=>$thread->id])
		->withSuccess(sprintf('%s %s', trans('hifone.awesome'), trans('hifone.success'))); 
		
		
		
	}
	

	
	
	public function follow_thread(Thread $thread)
	{
		
		
		$nowTimestamp  =date("Y-m-d H:i:s");
		
		$newfollow=[
		'user_id'=>Auth::user()->id,
		'followable_id'=>$thread->id,
		'followable_type'=>"Thread",
		 

		
		];
	DB::table('follows')->insert(
   $newfollow);	
		
			

        $notif = [
            'author_id'     => Auth::user()->id,
            'user_id'       => $thread->user_id,
            'body'          => $thread->title." قام بمتابعة سوالك".Auth::user()->username,
            'type'          => 'Follow thread',
            'created_at'    => $nowTimestamp,
            'updated_at'    => $nowTimestamp,
        ];
			$user= User::where('id', $thread->user_id)->first();	
			 User::where('id', $thread->user_id)->update(array('notification_count' => $user->notification_count+1));	
			DB::table('notifications')->insert(
   $notif);	
			



//$$$$$$$$$$$$$$$$$$$$$$$$$
    $replies = $thread->replies()
                    ->orderBy('id', 'asc')
                    ->paginate(Config::get('setting.replies_per_page', 30));

        $repository = app('repository');
        $repository->pushCriteria(new BelongsToNode($thread->node_id));
        $nodeThreads = $repository->model(Thread::class)->getThreadList(8);

        
		$other_nodes=DB::table('thread_nodes')->where('thread_id','=',$thread->id)->get();
		$favorites=DB::table('favorites')->where('user_id','=',Auth::user()->id)->where('thread_id','=',$thread->id)->first();
		$follows=DB::table('follows')->where('user_id','=',Auth::user()->id)->where('followable_id','=',$thread->id)->where('followable_type','=','Thread')->first();
		
		
		$later=DB::table('answer_later')->where('anserer_id','=',Auth::user()->id)->where('thread_id','=',$thread->id)->first();
		
		
//,['others'=>$other_nodes]
        return $this->view('threads.show',['thread'=>$thread,'replies'=>$replies,'nodeThreads'=>$nodeThreads,'favorites'=>$favorites,'follows'=>$follows,'later'=>$later])
		->withSuccess(sprintf('%s %s', trans('hifone.awesome'), trans('hifone.success')));			
		
	} 
	
	
	//Unfollow Thread
	
		public function unfollow_thread(Thread $thread)
	{
		
		
		
		$nr_afr = DB::delete("delete from follows where user_id ='".$Auth::user()->id."' AND followable_id='".$thread->id."' AND followable_type='Thread'");	



//$$$$$$$$$$$$$$$$$$$$$$$$$
    $replies = $thread->replies()
                    ->orderBy('id', 'asc')
                    ->paginate(Config::get('setting.replies_per_page', 30));

        $repository = app('repository');
        $repository->pushCriteria(new BelongsToNode($thread->node_id));
        $nodeThreads = $repository->model(Thread::class)->getThreadList(8);

        
		$other_nodes=DB::table('thread_nodes')->where('thread_id','=',$thread->id)->get();
		$favorites=DB::table('favorites')->where('user_id','=',Auth::user()->id)->where('thread_id','=',$thread->id)->first();
		//$follows=DB::table('follows')->where('user_id','=',Auth::user()->id)->where('followable_id','=',$thread->id)->where('followable_type','=','Thread')->first();
		
		
		$later=DB::table('answer_later')->where('anserer_id','=',Auth::user()->id)->where('thread_id','=',$thread->id)->first();
		
		
//,['others'=>$other_nodes]
        return Redirect::route('threads.show',['thread'=>$thread,'replies'=>$replies,'nodeThreads'=>$nodeThreads,'favorites'=>$favorites,'follows'=>null,'later'=>$later]);
					
		
	} 
	
	
	
	
	
	
	
	
	
	
	
	public function fav_thread(Thread $thread)
	{
		
		
		$nowTimestamp  =date("Y-m-d H:i:s");
		
		$newfollow=[
		'user_id'=>Auth::user()->id,
		'thread_id'=>$thread->id,
		//'followable_type'=>"Thread",
		'created_at'    => $nowTimestamp,
            'updated_at'    => $nowTimestamp,
		 

		
		];
	DB::table('favorites')->insert(
   $newfollow);	
		
				

       
		 $replies = $thread->replies()
                    ->orderBy('id', 'asc')
                    ->paginate(Config::get('setting.replies_per_page', 30));

        $repository = app('repository');
        $repository->pushCriteria(new BelongsToNode($thread->node_id));
        $nodeThreads = $repository->model(Thread::class)->getThreadList(8);

        
		$other_nodes=DB::table('thread_nodes')->where('thread_id','=',$thread->id)->get();
		$favorites=DB::table('favorites')->where('user_id','=',Auth::user()->id)->where('thread_id','=',$thread->id)->first();
		//$follows=DB::table('follows')->where('user_id','=',Auth::user()->id)->where('followable_id','=',$thread->id)->where('followable_type','=','Thread')->first();
		
		
		$later=DB::table('answer_later')->where('anserer_id','=',Auth::user()->id)->where('thread_id','=',$thread->id)->first();
		
		
//,['others'=>$other_nodes]
        return Redirect::route('threads.show',['thread'=>$thread,'replies'=>$replies,'nodeThreads'=>$nodeThreads,'favorites'=>$favorites,'follows'=>null,'later'=>$later]);
		
	} 
	
	
	
	//Unfav
	
	public function unfav_thread(Thread $thread)
	{
		
	$unfollow = DB::delete("delete from favorites where thread_id ='".$thread->id."' AND user_id='".Auth::user()->id."'");
		
				

        $replies = $thread->replies()
                    ->orderBy('id', 'asc')
                    ->paginate(Config::get('setting.replies_per_page', 30));

        $repository = app('repository');
        $repository->pushCriteria(new BelongsToNode($thread->node_id));
        $nodeThreads = $repository->model(Thread::class)->getThreadList(8);

        
		$other_nodes=DB::table('thread_nodes')->where('thread_id','=',$thread->id)->get();
		$favorites=DB::table('favorites')->where('user_id','=',Auth::user()->id)->where('thread_id','=',$thread->id)->first();
		$follows=DB::table('follows')->where('user_id','=',Auth::user()->id)->where('followable_id','=',$thread->id)->where('followable_type','=','Thread')->first();
		
		
		$later=DB::table('answer_later')->where('anserer_id','=',Auth::user()->id)->where('thread_id','=',$thread->id)->first();
		
		
//,['others'=>$other_nodes]
        return Redirect::route('threads.show',['thread'=>$thread,'replies'=>$replies,'nodeThreads'=>$nodeThreads,'favorites'=>$favorites,'follows'=>$follows,'later'=>$later]);
		
	} 
	
	public function later(Thread $thread)
	{
		
		
		$nowTimestamp  =date("Y-m-d H:i:s");
		
		$later=[
		
		'thread_id'=>$thread->id,
		'anserer_id'=>Auth::user()->id,
		
		
		];
	DB::table('answer_later')->insert(
   $later);	
		
				

       
			
			return Redirect::route('thread.show', ['thread'=>$thread->id])
		->withSuccess(sprintf('%s %s', trans('hifone.awesome'), trans('hifone.success'))); 
		
	} 
	
	

	public function RecentReplies(Thread $thread)
    {
		$view=$this->view('threads.show');
		
	if(Auth::user()!=null)	{
        $this->breadcrumb->push([
                $thread->node->name => $thread->node->url,
                $thread->title      => $thread->url,
        ]);

        $replies = $thread->replies()
                    ->orderBy('id', 'desc')
                    ->paginate(Config::get('setting.replies_per_page', 30));

        $repository = app('repository');
        $repository->pushCriteria(new BelongsToNode($thread->node_id));
        $nodeThreads = $repository->model(Thread::class)->getThreadList(8);

        event(new ThreadWasViewedEvent($thread));
		$other_nodes=DB::table('thread_nodes')->where('thread_id','=',$thread->id)->get();
		$favorites=DB::table('favorites')->where('user_id','=',Auth::user()->id)->where('thread_id','=',$thread->id)->first();
		$follows=DB::table('follows')->where('user_id','=',Auth::user()->id)->where('followable_id','=',$thread->id)->where('followable_type','=','Thread')->first();
		
		
		$later=DB::table('answer_later')->where('anserer_id','=',Auth::user()->id)->where('thread_id','=',$thread->id)->first();
		$view=$this->view('threads.show',['thread'=>$thread,'replies'=>$replies,'nodeThreads'=>$nodeThreads,'favorites'=>$favorites,'follows'=>$follows,'later'=>$later])
		->withSuccess(sprintf('%s %s', trans('hifone.awesome'), trans('hifone.success')));
		
	}
//,['others'=>$other_nodes]
        return $view;
            
    }
	
	
	
}
