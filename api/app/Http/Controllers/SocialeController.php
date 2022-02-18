<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Socialite;

use App\User;

class SocialeController extends Controller
{




    public function callback (Request $request) {

        $provider = $request->provider;

        if (in_array($provider, $this->providers)) {


            $data = Socialite::driver($request->provider)->user();


            $email = $data->getEmail();
            $name = $data->getName();


            $user = User::where("email", $email)->first();


            if (isset($user)) {


                $user->name = $name;
                $user->save();


            } else {


                $user = User::create([
                    'name' => $name,
                    'email' => $email,
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
