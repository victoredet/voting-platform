<?php

namespace App\Http\Controllers;
use App\Models\Polls;
use App\Models\User;

use Illuminate\Http\Request;

class PollsController extends Controller
{
    //admin polls
    public function getAllPolls($id)
    {
        //check user
        $user = User::where('id',$id)->get();
        if($user['role']!='admin'){
            return 'invalid request';
        }
        //get polls
        return Polls::all();
    }

    public function suspendPoll(Request $request, $id){
        //check user
        $user = User::where('id',$id)->get();
        if($user['role']!='admin'){
            return 'invalid request';
        }
        //suspend poll
        $poll = Polls::where('id', $request['poll_id'])->update([
            'admin_status'=>'suspeded'
        ]);
        return Polls::all();
    }

    public function unSuspendPoll(Request $request, $id){
        //check user
        $user = User::where('id',$id)->get();
        if($user['role']!='admin'){
            return 'invalid request';
        }
        //reactivate poll
        $poll = Polls::where('id', $request['poll_id'])->update([
            'admin_status'=>'actives'
        ]);
        return Polls::all();
    }


















 
}
