<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FriendController extends Controller
{
    //
    public function store(Request $request, User $user){

        $is_from = $request->user()->from()->where('to_id', $user->id)->exists();
        $is_to = $request->user()->from()->where('from_id', $user->id)->exists();

        if($is_from || $is_to){
            return back();
        }

        if($request->user()->id === $user->id){
            return back();
        }

        $request->user()->from()->attach($user);

        return back();
    }

    public function update(Request $request, User $user){
        
        //dd("Usuario: ".$user->id,"Solicitud: ".$request->user()->pendingTo);
        //$request->user()->pendingTo()->where('from_id', $user->id)->update(['accepted' => true]);
        $request->user()->pendingTo()->updateExistingPivot($user, ['accepted' => true]);

        return back();
    }
}
