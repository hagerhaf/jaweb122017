<?php
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

class ReportsController extends Controller
{
public function __construct()
    {
        parent::__construct();

        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
	
	
public function shomw(){
	
	
	//$reports=DB::table('reports')->get();
	//$view=$this->view('threads.show');
	
	//return view('reports.index');
	//return Redirect::to('http://www.google.com');
	dd("I received");
	
	
	
}



}

?>