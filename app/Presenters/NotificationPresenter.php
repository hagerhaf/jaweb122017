<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Presenters;

class NotificationPresenter extends AbstractPresenter
{
    public function template()
    {
        if (!isset($this->wrappedObject->object)) {
            return 'unknown';
        }

        if ($this->wrappedObject->object instanceof \Hifone\Models\Thread) {
            return 'thread';
        } elseif ($this->wrappedObject->object instanceof \Hifone\Models\Reply) {
            return 'reply';
        } elseif ($this->wrappedObject->object instanceof \Hifone\Models\Credit) {
            return 'credit';
        } else {
            return 'common';
        }
    }

    public function labelUp()
    {
        switch ($this->wrappedObject->type) {
            case 'thread_new_reply':
            $label ="";
                break;
            case 'followed_thread_new_reply':
                 $label ="";
                break;
            case 'thread_mention':
                 $label ="";
                break;
            case 'thread_favorite':
                 $label ="";
                break;
            case 'thread_follow':
                 $label ="";
                break;
            case 'thread_like':
                 $label ="";
                break;
            case 'reply_like':
                 $label ="";
                break;
            case 'reply_mention':
                 $label ="";
                break;
            case 'thread_mark_excellent':
                 $label ="";
                break;
            case 'thread_move':
                  $label ="";
                break;
            case 'commented_thread_new_append':
                 $label ="";
                break;
            case 'followed_thread_new_append':
                 $label ="";
                break;
            case 'user_follow':
                   $label ="";
                break;
            case 'followed_user_new_thread':
                 $label ="";
                break;
            case 'credit_register':
                 $label ="";
                break;
            case 'credit_login':
                 $label ="";
                break;
				
				case 'best_answer':
                $label = 'Yay best answer!';
                break;
				
					case '30_days':
                $label = 'لقد مضت 30 يوما على احد اسئلتك بدون اجابة';
                break;
				
            default:
                $label = 'unknow';
                break;
        }

        return $label;
    }

    /**
     * Convert the presenter instance to an array.
     *
     * @return string[]
     */
    public function toArray()
    {
        return array_merge($this->wrappedObject->toArray(), [
            'created_at' => $this->created_at(),
            'updated_at' => $this->updated_at(),
        ]);
    }
}
