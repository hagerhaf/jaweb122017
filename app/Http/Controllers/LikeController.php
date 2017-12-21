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

use Hifone\Commands\Like\AddLikeCommand;
use Hifone\Models\Reply;
use Hifone\Models\Thread;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use Input;
use DB;
use Redirect;
use Auth;
class LikeController extends Controller
{
    public function store()
    {if ($data['type'] == 'Reply') {
            $target = Reply::findOrFail($data['id']);
			if($data->like_count > 4)
			{
				$user=DB::table('users')->where('id','=', $data->user_id)->first();
				User::where('id', $user->id)->update(array('somaa' => $user->somaa+2));
				
				$nowTimestamp  =date("Y-m-d H:i:s");

        $notif = [
            'author_id'     => $data->user_id,
            'user_id'       => $data->user_id,
            'body'          => null,
            'type'          => 'four_somaa',
            'created_at'    => $nowTimestamp,
            'updated_at'    => $nowTimestamp,
        ];
				
			DB::table('notifications')->insert(
   $notif);	
   
   $message=Redirect::route('thread.show', ['thread'=>$data->thread_id])
		->withSuccess(sprintf('%s %s', trans('hifone.awesome'), trans('hifone.success'))); 
				
			}
        }
        dispatch(new AddLikeCommand($target));

        //return Response::json(['status' => 1]);
		
		return $message;
    }

	
	public function store_thread(Thread $thread)
	{
		$likedby=DB::table('thread_likes')->where('liked_by','=', Auth::user()->id)->where('thread_id','=',$thread->id)->first();
		
		$nowTimestamp  =date("Y-m-d H:i:s");
		if($thread->user_id != Auth::user()->id)
		{
		if($likedby == null)
		{
	$morelike=DB::table('threads')->
	where('id','=',$thread->id)->
	update(['like_count' => $thread->like_count +1]); 
	
	 $neulike = [
            'thread_id'     => $thread->id,
            'liked_by'       =>Auth::user()->id,
            
            'like_date'    => $nowTimestamp,
        ];
				
			DB::table('thread_likes')->insert(
   $neulike);	
	
	
	
			 if($thread->like_count > 4)
			{
				$user=DB::table('users')->where('id','=', $thread->user_id)->first();
				User::where('id', $user->id)->update(array('somaa' => $user->somaa+2));
				
				

        $notif = [
            'author_id'     => $thread->user_id,
            'user_id'       => $thread->user_id,
            'body'          => null,
            'type'          => 'four_somaa',
            'created_at'    => $nowTimestamp,
            'updated_at'    => $nowTimestamp,
        ];
				
			DB::table('notifications')->insert(
   $notif);	
				
			} 
			//meeeee
		}
		}
			return Redirect::route('thread.show', ['thread'=>$thread->id])
		->withSuccess(sprintf('%s %s', trans('hifone.awesome'), trans('hifone.success'))); 
		
	} 
	
	public function destroy_thread(Thread $thread)
	{
	$likedby=DB::table('thread_likes')->where('liked_by','=', Auth::user()->id)->where('thread_id','=',$thread->id)->first();
		
		$nowTimestamp  =date("Y-m-d H:i:s");
		if($thread->user_id != Auth::user()->id)
		{
		if($likedby != null)
		{	
	$unlike = DB::delete('delete from thread_likes where id = ?', [$likedby->id]);
	
	$morelike=DB::table('threads')->
	where('id','=',$thread->id)->
	update(['like_count' => $thread->like_count -1]); 
		}
		}
			return Redirect::route('thread.show', ['thread'=>$thread->id])
		->withSuccess(sprintf('%s %s', trans('hifone.awesome'), trans('hifone.success'))); 
		
		
	} 
	
	
	
    public function destroy($id)
    {
        /* $data = Input::all();
        if ($data['type'] == 'Thread') {
            $target = Thread::findOrFail($data['id']);
        } elseif ($data['type'] == 'Reply') {
            $target = Reply::findOrFail($data['id']);
        }

        dispatch(new AddLikeCommand($target, 'unlike'));

        return Response::json(['status' => 1]); */
    }
}
