<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Socialite;

use App\User;

class SocialeController extends Controller
{

    protected $providers = [ "google", "github", "facebook" ];


    public function loginRegister () {
    	return view("socialite.login-register");
    }


    public function redirect (Request $request) {

        $provider = $request->provider;


        if (in_array($provider, $this->providers)) {
            return Socialite::driver($provider)->redirect();
        }
        abort(404);
    }

    public function callback (Request $request) {

        $provider = $request->provider;

        if (in_array($provider, $this->providers)) {


            $data = Socialite::driver($request->provider)->user();


            $email = $data->getEmail();
            $name = $data->getName();


            $user = User::where('sociale_id', $user->id)->first();


            if (isset($user)) {


                $user->name = $name;
                $user->save();


            } else {


                $user = User::create([
                    'name' => $name,
                    'email' => $email,
                    'sociale_id'=> $user->id,
                    'password' => bcrypt("emilie")
                ]);
            }

            # 4. On connecte l'utilisateur
            auth()->login($user);

            # 5. On redirige l'utilisateur vers /home
            if (auth()->check()) return redirect(route('home'));

         }
         abort(404);
    }
