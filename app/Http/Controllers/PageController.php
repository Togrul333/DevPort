<?php

namespace App\Http\Controllers;

use App\Models\Imfeelinglucky;
use App\Models\LinkKey;
use App\Models\User;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function pageA($key)
    {
        $if_the_key_is_valid = LinkKey::where([
            ['key', '=', $key],
            ['expires_in', '>', now()],
        ])->first();
        if ($if_the_key_is_valid) {
            $user = User::where('id', $if_the_key_is_valid->user_id)->first();
            $key = $if_the_key_is_valid->key;
            return view('page_a', compact('user', 'key'));
        }
        return redirect()->route('home')->with('error', 'Ваш линк недействительный !!');
    }

    public function deleteKey($key)
    {
        $this_key = LinkKey::where('key', $key)->first();
        $this_key->delete();
        return redirect()->route('home')->with('error', 'Ваш линк Деактивирован');
    }

    public function createKey(User $user)
    {
        $user->linkKeys()->create([
            'key' => Str::uuid(),
            'expires_in' => now()->addDays(7),
        ]);
        return redirect()->back()->with('success', 'Ваш новый линк создан !!');
    }

    public function Imfeelinglucky(User $user)
    {
        $random_number = rand(1, 1000);
        if ($random_number % 2 !== 0) {
            $winning_amount = 0;
            $this->createImfeelinglucky($user, $random_number, $winning_amount);
            return redirect()->back()->with('error', 'Проигрыш число : ' . $random_number . '  Сумма выигрыша  :  ' . $winning_amount);
        } else {
            if ($random_number > 900) {
                $winning_amount = $random_number / 100 * 70;
                $this->createImfeelinglucky($user, $random_number, $winning_amount);
                return redirect()->back()->with('success', 'Число : ' . $random_number . '  Сумма выигрыша  :  ' . $winning_amount);
            } elseif ($random_number > 600) {
                $winning_amount = $random_number / 100 * 50;
                $this->createImfeelinglucky($user, $random_number, $winning_amount);
                return redirect()->back()->with('warning', 'Число : ' . $random_number . '  Сумма выигрыша  :  ' . $winning_amount);
            } elseif ($random_number > 300) {
                $winning_amount = $random_number / 100 * 30;
                $this->createImfeelinglucky($user, $random_number, $winning_amount);

                return redirect()->back()->with('info', 'Число : ' . $random_number . '  Сумма выигрыша  :  ' . $winning_amount);
            } elseif ($random_number <= 300) {
                $winning_amount = $random_number / 100 * 10;
                $this->createImfeelinglucky($user, $random_number, $winning_amount);
                return redirect()->back()->with('error', 'Число : ' . $random_number . '  Сумма выигрыша  :  ' . $winning_amount);
            }
        }
    }

    public function createImfeelinglucky($user, $random_number, $winning_amount)
    {
        $user->Imfeelingluckys()->create([
            'random_number' => $random_number,
            'winning_amount' => round($winning_amount),
        ]);
    }

    public function ImfeelingluckyInfo(User $user)
    {
        $Imfeelingluckys = Imfeelinglucky::where('user_id',$user->id)->orderBy('created_at', 'desc')->take(3)->get();

        $info = '</br>';
        foreach ($Imfeelingluckys as $Imfeelinglucky){
            $info .=  'Число : ' .$Imfeelinglucky->random_number.'  Сумма выигрыша  :  '.$Imfeelinglucky->winning_amount.'</br>';
        }

        return redirect()->back()->with('success', 'Информацыя о трех последних попыток'.$info);
    }
}
