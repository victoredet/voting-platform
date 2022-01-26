<?php
namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Campaigns;


use Illuminate\Http\Request;

class CampaignController extends Controller
{
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
    public function createNewCampaign(Request $request, $id){
        Campaign::create([
            'user_id'=>$id,
            'title'=>$request['title'],
            'description'=>$request['description'],
            'status'=>$request['status'],
            'admin_status'=>$request['admin_status'],
            'title'=>$request['title']
        ]);
        return Campaign::where('user_id',$id);
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
    
    public function destroy($id)
    {
        //
    }
}
