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
//namespace Hifone\Http\Controllers\Auth;
use Hifone\Models\User;
use DB;
use Illuminate\Support\Facades\Session;
use Hifone\Events\User\UserWasAddedEvent;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Support\Facades\Auth;
use Socialite;

class FacebookController extends Controller
{
    /**
     * Redirect the user to the Fb authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from Fb.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('facebook')->user();
		
		 $found = User::where('facebook_id', $user->getId())->first();
		
		//echo ($found==null);
		
		 if($found==null){
			$username = str_replace(' ', '', $user->getName());
		
		   DB::table('users')->insert(
    ['username' =>$username , 'email' =>$user->getEmail(), 'is_banned' => 0,'avatar_url'=> $user->getAvatar(),'score'=>20,'somaa'=>5,'facebook_id'=> $user->getId()]
);	   
		 event(new UserWasAddedEvent($user));

       
		} 
		
$connect_data = Session::get('connect_data');
 Auth::guard($this->getGuard())->login($user);

        return redirect('/');	
     
	   //$user = $service->createOrGetUser(Socialite::driver('facebook')->user());

       // auth()->login($user->getName());

        //return redirect()->to('/home');
    }
}
?>