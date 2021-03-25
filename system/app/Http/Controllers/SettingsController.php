<?php

namespace App\Http\Controllers;

use Session;
use Redirect;
use Illuminate\Http\Request;
use App\Settings;
use App\GroupPermissions;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{
	public static function getSetting($field_name)
	{
		$setting_tmp = Settings::where("name",$field_name)->get();
		
		foreach($setting_tmp as $setting){
			$settings = $setting->value;			
		}
		
        return $settings;
	}
    public function index(Settings $model)
	{
		PermissionsController::checkAdmin();
		
		$settings = $model->paginate(10);
        return view('settings.index', ['settings' => $settings]);
	}	
	public function update_submitted(Settings $model,Request $request)
    {
		PermissionsController::checkAdmin();
		
		$settings = $request->post('settings');
		$success = 0;
		foreach($settings as $name => $value){
						
			if(DB::update(" UPDATE settings SET value= '".$value."' WHERE name= '".$name."'")){
				$success = 1;
			}
		}
			$msg = 'Nothing Updated!';	$msg_class = "danger";
		if($success==1){
			$msg = 'Updated!';	$msg_class = "success";
		}
		Session::flash('message', $msg); 
		Session::flash('alert-class', 'alert-'.$msg_class); 		
        return Redirect::to('settings');		
    }
	
	public function permissions(Settings $model)
	{
		PermissionsController::checkAdmin();
		$group_permissions = GroupPermissions::orderBy('user_group_id','ASC')->get(); //All();
        return view('settings.permissions', ['group_permissions' => $group_permissions]);
	}
	public function update_permissions(Request $request)
	{
		PermissionsController::checkAdmin();
		$post_data = $request->input();
		$error_occured = 0;
		
		foreach($post_data['permissions'] as $id => $data)
		{
			$group_permission = GroupPermissions::find($id);
			foreach($data as $action=>$status)
			{
				if($status=='on')
				{
					$status = 1;
				}
				$group_permission->$action = $status;
			}
			if($group_permission->save())
			{
				//Do Nothing
			}
			else
			{
				$error_occured = 1;
			}
		}
		if($error_occured==0)
		{
			$msg = 'User Permissions Updated!';	$msg_class = "success";
		}
		else
		{
			$msg = 'Some Error!';	$msg_class = "danger";
		}
		Session::flash('message', $msg); 
		Session::flash('alert-class', 'alert-'.$msg_class); 
		return redirect('settings/permissions');	
	}	
}
