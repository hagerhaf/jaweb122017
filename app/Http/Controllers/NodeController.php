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
use Hifone\Models\Node;
use Hifone\Models\Thread;
use Hifone\Repositories\Criteria\Thread\BelongsToNode;
use Hifone\Repositories\Criteria\Thread\Filter;
use Hifone\Repositories\Criteria\Thread\Search;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Hifone\Models\Section;
use Auth;
use DB;
use Redirect;

class NodeController extends Controller
{
    public function index()
    {
        $sections = Section::orderBy('order')->get();

        return $this->view('nodes.index')
            ->withSections($sections);
    }

    public function show(Node $node)
    {
        $this->breadcrumb->push($node->name, $node->url);

        $repository = app('repository');
        $repository->pushCriteria(new Search(Input::query('q')));
        $repository->pushCriteria(new BelongsToNode($node->id));
        $repository->pushCriteria(new Filter('node'));

        $threads = $repository->model(Thread::class)->getThreadList(Config::get('setting.per_page'));

        return $this->view('threads.index')
            ->withThreads($threads)
            ->withNode($node);
    }

	
	public function node_show (Node $node) {
		
		$n_id=$node->id;
		
		 Node::where('id', $node->id)->update(array('visits' => $node->visits+1));
		 $subs=DB::table('node_subscription')->where('node_id','=', $n_id)->count();
		 $is_sub=DB::table('node_subscription')->where('node_id','=', $n_id)->where('subscriber','=',Auth::user()->id)->count();
		
			$threads=DB::table('threads')->where('node_id','=', $n_id)->get();
			
			$users = DB::table('users as u')
	->join ('node_subscription as b',  'b.subscriber', '=' ,'u.id')->where('b.node_id','=',$n_id)
    ->select('u.username','u.id','u.avatar_url')
	->get();
		
		
		return view('nodes.node',['node' => $node,'subs'=>$subs,'is_sub'=>$is_sub,'threads'=>$threads,'users'=>$users]);
		
		//echo 'hello';
		
	}
	
	
	
/* 	public function create_node_user(Request $request)	{
		
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

$message=view('users.nodes',['user'=>Auth::user()->id]);
	}
		
		else
		{
			
			
			$message=view('users.nodes',['user'=>Auth::user()->id])->withSuccess(sprintf('%s %s', "Error !", "لقد تجاوزت عدد التصنيفات المتاحة"));
		}
		
		 return $message;
		
	}
	
 */	
	
	
    public function showBySlug($slug)
    {
        return $this->show(Node::where('slug', $slug)->firstOrFail());
    }
	
	
	
	public function subsnode(Node $node) {
		
	$n_id=$node->id;
			$today = date("Y-m-d H:i:s");
		
		 $subs=DB::table('node_subscription')->where('node_id','=', $n_id)->count();
		 
		 $subsc=[
		'subscriber'=> Auth::user()->id,
		'node_id'=>$n_id,
		'date'=> $today,
		
		];
		
		 DB::table('node_subscription')->insert(
   $subsc);
   
		//  $is_sub=DB::table('node_subscription')->where('node_id','=', $n_id)->where('subscriber','=',Auth::user()->id)->count();
		  $subs=DB::table('node_subscription')->where('node_id','=', $n_id)->count();
		 $is_sub=DB::table('node_subscription')->where('node_id','=', $n_id)->where('subscriber','=',Auth::user()->id)->count();
		 $threads=DB::table('threads')->where('node_id','=', $n_id)->get();
			
			$users = DB::table('users as u')
	->join ('node_subscription as b',  'b.subscriber', '=' ,'u.id')->where('b.node_id','=',$n_id)
    ->select('u.username','u.id','u.avatar_url')
	->get();
		
		//return Redirect::route('nodes.node',['node' => $node,'subs'=>$subs,'is_sub'=>$is_sub]);
		
		//return Redirect::route('nodes.node',['node' => $node->id]);
		
		return $this->view('nodes.node',['node' => $node,'subs'=>$subs,'is_sub'=>$is_sub,'threads'=>$threads,'users'=>$users]);
		
	}
	
	
	
	public function unsubsnode(Node $node) {
		
		$n_id=$node->id;
		
		 DB::delete("delete from node_subscription where node_id = '".$n_id."' AND subscriber='".Auth::user()->id."'");
		$subs=DB::table('node_subscription')->where('node_id','=', $n_id)->count();
		 $is_sub=DB::table('node_subscription')->where('node_id','=', $n_id)->where('subscriber','=',Auth::user()->id)->count();
		 $threads=DB::table('threads')->where('node_id','=', $n_id)->get();
			
			$users = DB::table('users as u')
	->join ('node_subscription as b',  'b.subscriber', '=' ,'u.id')->where('b.node_id','=',$n_id)
    ->select('u.username','u.id','u.avatar_url')
	->get();
		
		//return Redirect::route('nodes.node',['node' => $node,'subs'=>$subs,'is_sub'=>$is_sub]);
		
		//return Redirect::route('nodes.node',['node' => $node]);
		return $this->view('nodes.node',['node' => $node,'subs'=>$subs,'is_sub'=>$is_sub,'threads'=>$threads,'users'=>$users]);
		
	}
	
	
	
	
	
	
}
