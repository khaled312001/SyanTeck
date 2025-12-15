<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use App\User;

class SocialLoginController extends Controller
{
    public function facebook_redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function facebook_callback()
    {
        try {
            $user_fb_details = Socialite::driver('facebook')->user();
            $user_details = User::where('email', $user_fb_details->getEmail())->first();

            if ($user_details) {
                Auth::login($user_details);
                return redirect()->to('buyer/dashboard/#');
            } else {
                $new_user = User::create([
                    'username' => 'fb_' . explode('@', $user_fb_details->getEmail())[0],
                    'name' => $user_fb_details->getName(),
                    'email' => $user_fb_details->getEmail(),
                    'facebook_id' => $user_fb_details->getId(),
                    'user_type' => 1,
                    'email_verified' => 1,
                    'password' => Hash::make(\Illuminate\Support\Str::random(8))
                ]);

                Auth::login($new_user);
                return redirect()->to('buyer/dashboard/#');
            }
        } catch (\Exception $e) {
            return redirect()->to('login/#')->with(['msg' => $e->getMessage(), 'type' => 'danger']);
        }
    }

    public function google_redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function google_callback()
    {
        try {
            $user_fb_details = Socialite::driver('google')->user();
            $user_details = User::where('email', $user_fb_details->getEmail())->first();

            if ($user_details) {
                Auth::login($user_details);
                return redirect()->to('buyer/dashboard/#');
            } else {
                $new_user = User::create([
                    'username' => 'gl_' . explode('@', $user_fb_details->getEmail())[0],
                    'name' => $user_fb_details->getName(),
                    'email' => $user_fb_details->getEmail(),
                    'google_id' => $user_fb_details->getId(),
                    'user_type' => 1,
                    'email_verified' => 1,
                    'password' => Hash::make(\Illuminate\Support\Str::random(8))
                ]);

                Auth::login($new_user);
                return redirect()->to('buyer/dashboard/#');
            }
        } catch (\Exception $e) {
            return redirect()->to('login/#')->with(['msg' => $e->getMessage(), 'type' => 'danger']);
        }
    }

    public function google_register_redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function google_register_callback()
    {
        try {
            $user_google_details = Socialite::driver('google')->user();
            $user_details = User::where('email', $user_google_details->getEmail())->first();

            if ($user_details) {
                // User already exists, login them
                Auth::login($user_details);
                if($user_details->user_type==0){
                    return redirect()->route('seller.dashboard');
                }else{
                    return redirect()->route('buyer.dashboard');
                }
            } else {
                // Store Google data in session and redirect to register page to complete profile
                session([
                    'google_register_data' => [
                        'name' => $user_google_details->getName(),
                        'email' => $user_google_details->getEmail(),
                        'google_id' => $user_google_details->getId(),
                        'avatar' => $user_google_details->getAvatar()
                    ]
                ]);
                return redirect()->route('user.register')->with(['msg' => __('تم تسجيل الدخول بجوجل. يرجى إكمال بياناتك'), 'type' => 'success']);
            }
        } catch (\Exception $e) {
            return redirect()->route('user.register')->with(['msg' => $e->getMessage(), 'type' => 'danger']);
        }
    }
}
