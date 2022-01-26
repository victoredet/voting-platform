<?php

namespace App\Http\Controllers;
use App\Models\Polls;
use App\Models\User;
use App\Models\Contestant;
use App\Models\PaidVote;
use App\Models\Vote;


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
        //check creator

        Contestant::create([
            'creator_id'=>$id,
            'poll_id'=>$request['poll_id'],
            'name'=>$request['name'],
            'vote_count'=>0,
            'status'=>'acitive'
        ]);
    }

    //vote for contestant
    public function castFreeVote(Request $request){
        
        $voter = $request['voter'];
        $poll_id = $request['poll_id'];
        $contestant_id = $request['contestant_id'];

        //check if user has voted for the particular poll
        $voted = Vote::where('voter',$voter)->where('poll_id', $poll_id)->get();
        if($voted!=null){
            return 'you can only vote once!';
        }

        //cast vote
        Vote::create([
            'voter' => $voter,
            'poll_id' => $poll_id,
            'contestant_id' => $contestant_id
        ]);
        return 'vote successful';
    }

    public function castPaidVote(Request $request){
        //i'm not sure if i should do this in the front end or backend
        $price_per_vote = $request['price'];
        $amount = $request['amount'];
        $numb_of_votes = $request['numb_of_votes'];
        $min_amount = $request['min_amount'];
        $voter = $request['voter'];
        $poll_id = $request['poll_id'];
        $contestant_id =  $request['$contestant_id'];
        $min_amount = $request['min_amount'];

        //flutter wave people

        //check success status

        //get contestant
        $contestant = Contestant::where('id',$contestant_id)->get(); 

        //update contestant
        Contestant::where('id', $contestant_id)->update([
            'vote_count'=>$contestant['vote_count']+$numb_of_votes
        ]);

        //get poll 
        $poll = Poll::where('id',$poll_id)->get();
        //get user
        $organiser = User::where('id',$poll['user_id'])->get();

        //fund organiser
        User::where('id',$poll['user_id'])->update([
            'account'=> $organiser['account']+$amount
        ]);

        return 'Transaction successful';
    }



}
