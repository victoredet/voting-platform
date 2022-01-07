<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Campaigns;


use Illuminate\Http\Request;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     //admin campaign functions
    public function allCampaigns()
    {
        $campaigns = Campaigns::all();
        return $campaigns;
    }

    public function singleCampaign($id){
        $singleCampaign = Campaigns::where('id', $id)->get()->toArray();
        return $singleCampaign;
    }

    public function suspendCampaign($id){
        return Campaigns::where('id',$id)->update([
            'adminStatus'=>'suspended'
        ]);
    }

    public function unSuspendCampaign($id){
        return Campaigns::where('id',$id)->update([
            'adminStatus'=>'active'
        ]);
    }

    //user campaign functions

    public function createNewCampaign(){

    }
    
    public function editCampaign(Request $request){
        //get campaign
        $campaigns= Campaigns::where('user_id', $request['user_id'])->where('id', $request['id'])->get->toArray();
        $cam = $campaigns[0];
        //check user
        if($request['user_id']!=$cam['user_id']){
            return 'cannot proceed. invalid user or campaign';
        }

        //edit campaing details
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
