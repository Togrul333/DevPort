<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\LinkKey;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        $user = User::where('number', $data['number'])->first();
        if (!$user) {
            $user = User::create([
                'username' => $data['username'],
                'number' => $data['number'],
            ]);
            $linkKey = LinkKey::create([
                'user_id' => $user->id,
                'key' => Str::uuid(),
                'expires_in' => now()->addDays(7),
            ]);
            return response()->json([
                'success' => true,
                'link' => '/page_a/' . $linkKey->key,
            ]);

        } else {
            $link_exist = LinkKey::where('user_id',$user->id)->first();
            if ($link_exist){
                $keys = $user->linkKeys()->get();
                foreach ($keys as $key) {
                    if ($key->expires_in > now()) {
                        return response()->json([
                            'success' => true,
                            'link' => '/page_a/' . $key->key,
                        ]);
                    } else {
                        throw new ModelNotFoundException('Срок вашего уникального ключа истек !!');
                    }
                }
            }else{
                $linkKey = LinkKey::create([
                    'user_id' => $user->id,
                    'key' => Str::uuid(),
                    'expires_in' => now()->addDays(7),
                ]);
                return response()->json([
                    'success' => true,
                    'link' => '/page_a/' . $linkKey->key,
                ]);
            }
        }
    }
}
