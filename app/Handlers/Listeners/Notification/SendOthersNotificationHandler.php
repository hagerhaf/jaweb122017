<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Handlers\Listeners\Notification;

use Auth;
use Hifone\Events\Credit\CreditWasAddedEvent;
use Hifone\Events\EventInterface;
use Hifone\Events\Favorite\FavoriteEventInterface;
use Hifone\Events\Follow\FollowEventInterface;
use Hifone\Events\Like\LikeEventInterface;
use Hifone\Events\Thread\ThreadWasMarkedExcellentEvent;
use Hifone\Events\Thread\ThreadWasMovedEvent;
use Hifone\Events\User\UserWasAddedEvent;
use Hifone\Events\User\UserWasLoggedinEvent;
use Hifone\Models\Thread;
use Hifone\Models\Reply;
use Hifone\Models\User;

class SendSingleNotificationHandler
{
    /**
     * Handle the favorite.
     */
   /*  public function handle(EventInterface $event)
    {
        // follow
     /*    if ($event instanceof FollowEventInterface) {
            $this->follow($event->target);
        } elseif ($event instanceof LikeEventInterface) {
            $this->like($event->target);
        } elseif ($event instanceof FavoriteEventInterface) {
            $this->favorite($event->target);
        } elseif ($event instanceof ThreadWasMarkedExcellentEvent) {
            $this->markedExcellent($event->target);
        } elseif ($event instanceof ThreadWasMovedEvent) {
            $this->movedThread($event->target);
        } elseif ($event instanceof CreditWasAddedEvent) {
            if ($event->upstream_event instanceof UserWasAddedEvent) {
                $this->notifyCredit('credit_register', $event->upstream_event->user, $event->credit);
            } elseif ($event->upstream_event instanceof UserWasLoggedinEvent) {
                $this->notifyCredit('credit_login', $event->upstream_event->user, $event->credit);
            }  */
			
			/* if ($event instanceof BestAnswerInterface) {
            $this->Banswer($event->target);
        }
			
			else {
                return;
            } */
       // }
     

 
	
	//30 10 2017
	
	protected function Banswer( User $toUser, Thread $thread, Reply $reply)
    {
        $nowTimestamp = Carbon::now()->toDateTimeString();

        $data = [
            'author_id'     => $thread->user_id,
            'user_id'       => $reply->user_id,
            'body'          => $reply->body,
            'type'          => 'best_answer',
            'created_at'    => $nowTimestamp,
            'updated_at'    => $nowTimestamp,
        ];

        $toUser->increment('notification_count', 1);

        //$object->notifications()->create($data);
		$data->save();
    }
	
	//30 10 2017
	
	
	
	
	
	
	
}
