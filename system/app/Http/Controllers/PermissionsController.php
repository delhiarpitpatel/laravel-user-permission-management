<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\Modules;
use App\UserGroups;
use App\GroupPermissions;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\User  $model
     * @return \Illuminate\View\View
     */
    public static function fix($module_userGroup_added,$added_id)
	{
		// $MODULE_USERGROUP_ADDED MEANS WHAT ADDED MODULE OR USER GROUP
		
		switch ($module_userGroup_added) {
			case 'module':
			
				$user_groups = UserGroups::All();
				
				foreach($user_groups as $group){
					$permissions = new GroupPermissions;
					$permissions->user_group_id = $group->id;
					$permissions->module_id = $added_id;
					$permissions->view = 0;
					$permissions->add = 0;
					$permissions->edit = 0;
					$permissions->delete = 0;
					$permissions->save();				   
				}				
				break;
			case 'userGroup':
			
				$modules = Modules::All();
				
				foreach($modules as $module){
					$permissions = new GroupPermissions;
					$permissions->user_group_id = $added_id;
					$permissions->module_id = $module->id;
					$permissions->view = 0;
					$permissions->add = 0;
					$permissions->edit = 0;
					$permissions->delete = 0;
					$permissions->save();	
				}				
				break;
		}	
	}
    public static function checkAdmin($deny = true)
	{
		if(Auth::user()->user_group_id == 1)
		{
			return true;
		}
		else
		{
			if($deny == true){				
				PermissionsController::deny();
			}
			return false;
		}
	}
    public static function check($action,$module_name)
    {
		$group_id = Auth::user()->user_group_id;
		
		$module_details = Modules::where('name',$module_name)->get();
		foreach($module_details as $module){}
		
		$permissions = GroupPermissions::where('user_group_id',$group_id)->where('module_id',$module->id)->get();
		
		$allowed = 0;	
		foreach($permissions as $row){
			$allowed	=	$row->$action;		
		}
        if($allowed == 0){
			PermissionsController::deny();
		}
    }
	public static function deny(){
		Session::flash('status-type','danger');
		Session::flash('status','Access Denied.');
		PermissionsController::redirect(route('profile.edit'));		
	}
	public static function redirect($location){
		?>
			<script>
				location.replace("<?php echo $location;?>");
			</script>
		<?php
	}		
}
