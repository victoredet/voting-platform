<?php

namespace App\Http\Controllers;
use App\Models\Polls;
use App\Models\User;
use App\Models\Contestant;

use Illuminate\Http\Request;

class PollsController extends Controller
{
    //----admin polls-----//
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
            'admin_status'=>''
        ]);
        return Polls::all();
    }

    //-----------User polls functions --------------//
    public function createPoll(Request $request, $Id){
        Polls::create([
            'user_id'=>$id,
            'title'=>$request['title'],
            'description'=>$request['description'],
            'status'=>'pending',
            'admin_status'=>$request['admin_status']            
        ]);
    }

    public function getMyPolls($id){
        return Polls::where('user_id',$id)->get()->toArray();
    }

    public function editPoll(Request $request, $id){
        Polls::where('id', $id)->update([
            'title'=>$request['title'],
            'description'=>$request['description'],
            'status'=>$request['status'],
        ]);
    }

    public function deletePoll(Request $request, $id){
        Polls::where('id', $id)->delete();
        return 'delete successful';
    }

    //contestant functions
    public function addContestant(Request $request, $id){
        Contestant::create([
            'poll_id'=>$id,
            'name'=>$request['name'],
            'vote_count'=>0,
            'status'=>'acitive'
        ]);
    }

    //vote for contestant
    public function castVote(Request $request){
        
        $voter_id = $request['user_id'];
        $poll_id = $request['poll_id'];
        $contestant_id = $request['contestant_id'];

        //check if user has voted for the particular poll
        $vote = Vote::where('voter',$voter_id)->where('poll_id', $poll_id)->get();
        if($vote!=null){
            return 'you can only vote once!';
        }

        //cast vote
        Vote::create([
            'voter' => $voter_id,
            'poll_id' => $poll_id,
            'contestant_id' => $contestant_id
        ]);
        return 'vote successful';
    }











 



}
