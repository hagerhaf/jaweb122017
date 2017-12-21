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
use Hifone\Commands\Reply\AddReplyCommand;
use Hifone\Commands\Reply\RemoveReplyCommand;
use Hifone\Models\Reply;
use Hifone\Models\User;
use Hifone\Models\Thread;
use Input;
use Redirect;
use DB;

class ReplyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Creates a new node.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $replyData = Input::get('reply');
		$user_score=Auth::user()->score;
		$thread=DB::table('threads')->where('id','=', $replyData['thread_id'])->first();
        try {
            /* $reply = dispatch(new AddReplyCommand(
                $replyData['body'],
				$replyData['credentials'],
                Auth::user()->id,
                $replyData['thread_id']
				
            )); */
			 $link = new Reply;
    $link->body = $replyData['body'];
    $link->credentials = $replyData['credentials'];
    $link->user_id = Auth::user()->id;
    $link->thread_id = $replyData['thread_id'];
    $link->save();
			
			
			$user_score = $user_score +1 ;
			
			 $nowTimestamp  =date("Y-m-d H:i:s");
			 
			 $user=DB::table('users')->where('id','=', $thread->user_id)->first();

        $data = [
            'author_id'     => Auth::user()->id,
            'user_id'       => $thread->user_id,
            'body'          => "'".$thread->title."'   قام بالاجابة على سوالك  ".Auth::user()->username,
            'type'          => 'someone_reply',
            'created_at'    => $nowTimestamp,
            'updated_at'    => $nowTimestamp,
        ];

        //$user->increment('notification_count', 1);
		
		User::where('id', $user->id)->update(array('notification_count' => $user->notification_count+1));
		User::where('id', Auth::user()->id)->update(array('score' => $user_score));
		
		Thread::where('id', $thread->id)->update(array('reply_count' => $thread->reply_count +1));
		
    DB::table('notifications')->insert(
   $data);
   
   
        } catch (ValidationException $e) {
            return Redirect::route('thread.show', $replyData['thread_id'])
                ->withInput(Input::all())
                ->withErrors($e->getMessageBag());
        }

        return Redirect::route('thread.show', [$link->thread_id])
            ->withSuccess(sprintf('%s %s', trans('hifone.awesome'), trans('hifone.success')));
    }

    public function destroy(Reply $reply)
    {
        //$this->needAuthorOrAdminPermission($reply->user_id);

        //dispatch(new RemoveReplyCommand($reply));
		/* DB::table('replies')->delete(
    ['reporter' => Auth::user()->id, 'reported' => $reply->id, 'url' => 'thread/'.$reply->thread_id,'date' => $report_date]
);	 */

		$threadid=$reply->thread_id;
		$user_score=Auth::user()->score;
		$thread=DB::table('threads')->where('id','=', $reply->thread_id)->first();
		
		if ($thread->best_answer != $reply->id )
		{
			$user_score = $user_score-2 ;
	DB::table('replies')->where('id', $reply->id)->delete();
	User::where('id', Auth::user()->id)->update(array('score' => $user_score));
			
		}
		
		 
       
        return Redirect::route('thread.show', ['thread'=>$threadid])
            ->withSuccess(sprintf('%s %s', trans('hifone.awesome'), trans('hifone.success')));
    }
	
	public function report_r(Reply $reply)
	{
		
	$report_date=date("Y-m-d H:i:s");	
	DB::table('reports')->insert(
    ['reporter' => Auth::user()->id, 'reported' => $reply->id, 'url' => 'reply/'.$reply->thread_id,'date' => $report_date]
);	
	
return Redirect::route('thread.show', ['thread'=>$reply->thread_id])
		->withSuccess(sprintf('%s %s', trans('hifone.awesome'), trans('hifone.success'))); 
		
		//echo "REPORTED";
		
	
	}
	
	public function best_answer(Reply $reply){
		
		$thread=DB::table('threads')->where('id','=', $reply->thread_id)->first();
		$user=DB::table('users')->where('id','=', $reply->user_id)->first();
		
		if($thread->best_answer == 0 && $reply->user_id != Auth::user()->id  ){
			
			Thread::where('id', $reply->thread_id)->update(array('best_answer' => $reply->id));
			User::where('id', $reply->user_id)->update(array('score' => $user->score+$thread->points));
			User::where('id', $reply->user_id)->update(array('somaa' => $user->somaa+2));
			
			
			 $nowTimestamp  =date("Y-m-d H:i:s");

        $data = [
            'author_id'     => $thread->user_id,
            'user_id'       => $reply->user_id,
			//'object_id'     =>  16,
			//'object_type'  =>   'Hifone\Models\Reply',
            'body'          => "  نقطة  ".$thread->points." تحصلت علي '".$thread->title."'  تهانيا لقد تم اختيلر جوابك الافضل للسوال ",
            'type'          => 'best_answer',
            'created_at'    => $nowTimestamp,
            'updated_at'    => $nowTimestamp,
        ];

       User::where('id', $user->id)->update(array('notification_count' => $user->notification_count+1));
    DB::table('notifications')->insert(
   $data);
			
		}
		
		
		
		
		
		return Redirect::route('thread.show', ['thread'=>$reply->thread_id])
		->withSuccess(sprintf('%s %s', trans('hifone.awesome'), trans('hifone.success'))); 
		
		
	}
	
	
		
	public function reply_like(Reply $reply){
		
		 $dnow=date("Y-m-d H:i:s");
		 $data = [
            'user_id'     => Auth::user()->id,
            'reply_id'       => $reply->id,
			'date' =>$dnow,
			
        ];
		
		$isliked=DB::table('likes')->where('reply_id','=',$reply->id)->where('user_id','=',Auth::user()->id)->first();
		
		if($isliked != true){Reply::where('id', $reply->id)->update(array('like_count' => $reply->like_count+1));   
    DB::table('likes')->insert(
   $data);	
   
   $user=DB::table('users')->where('id','=',$reply->user_id)->first();
   
    $notif = [
            'author_id'     => Auth::user()->id,
            'user_id'       => $user->id,
			//'object_id'     =>  17,
			//'object_type'  =>   'Hifone\Models\Follow',
            'body'          => "'".$reply->body." ' اعجب باجابتك".Auth::user()->username,
            'type'          => 'like',
            'created_at'    => $dnow,
            'updated_at'    => $dnow,
        ];

    DB::table('notifications')->insert(
   $notif);	
    User::where('id', $user->id)->update(array('notification_count' => $user->notification_count+1));
    User::where('id', Auth::user()->id)->update(array('score' => Auth::user()->score+1));}
   
		return Redirect::route('thread.show', ['thread'=>$reply->thread_id]);
		 
		
	}
	
	
	
	
	 public function edit(Reply $thread)
    {
        $this->needAuthorOrAdminPermission($thread->user_id);

        $content = Input::get('content') ?: '';

        try {
            /* $append = dispatch(new AddAppendCommand(
                $thread->id,
                $content
            )); */
			Reply::where('id', $thread->id)->update(array('body' => $thread->body."\n اضافة".$content));	
        } catch (ValidationException $e) {
            return Redirect::route('thread.show', $thread->thread_id)
                ->withInput(Input::all())
                ->withErrors($e->getMessageBag());
        }

        return Redirect::route('thread.show', $thread->thread_id)
            ->withSuccess(sprintf('%s %s', trans('hifone.awesome'), trans('hifone.success')));
    }
	
	
}
