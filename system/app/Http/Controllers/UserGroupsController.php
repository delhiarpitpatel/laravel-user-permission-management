<?php

namespace App\Http\Controllers;

use App\UserGroups;
use App\Http\Controllers\PermissionsController as Permissions;
use Illuminate\Http\Request;
use Session;

class UserGroupsController extends Controller
{
    public static function getUserGroups()
	{		
		$user_group_data = UserGroups::All();
	
		foreach($user_group_data as $group_data){
			$data[$group_data->id] = $group_data;
		}
		
		return $data;
	}
	public static function getUserGroupArray()
	{		
		$user_group_data = UserGroups::All();
	
		foreach($user_group_data as $group_data){
			$data[$group_data->id] = $group_data->name;
		}
		
		return $data;
	}
	public static function getUserGroupName($user_group_id)
	{
		
		$user_group_data = UserGroups::where('id',$user_group_id)->get();
		
		$user_group_name = '';
		foreach($user_group_data as $data){
			$user_group_name = $data->name;
		}
		
		return $user_group_name;
	}  
	public function manage(UserGroups $model)
    {			
		Permissions::checkAdmin();
		
		$userGroups = $model->paginate(SettingsController::getSetting('pagination_rows'));		
		
        return view('users.groups.manage', ['userGroups' => $userGroups]);
    }
	public function addForm()
	{			
		Permissions::checkAdmin();
		return view('users.groups.add');
	}
	
	public function add(Request $request)
    {			
		Permissions::checkAdmin();
			
		$groups = new UserGroups;		
		$groups->name = $request->input('group_name'); 
		
		if($groups->save()){
			Permissions::fix('userGroup',$groups->id);
			
			$msg = 'User Group Added!';	$msg_class = "success";
		}
		else{
			$msg = 'Some Error!';	$msg_class = "danger";
		}
		
		Session::flash('message', $msg); 
		Session::flash('alert-class', 'alert-'.$msg_class); 
		
		return redirect('user/groups/manage');
    }
}
