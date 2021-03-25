<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\User  $model
     * @return \Illuminate\View\View
     */
    public static function addedBy($user_id)
	{
		if(PermissionsController::checkAdmin(false))
		{
			$user_details = array();
			$user_mouse_over = "";
			
			$user_details = UserController::get_user_details($user_id);
			if(!empty($user_details)){
				$user_mouse_over .= " Id : ".$user_details->id." \n";
				$user_mouse_over .= " Name : ".$user_details->name." \n";
				$user_mouse_over .= " Email : ".$user_details->email." \n ";
				$user_mouse_over .= " Mobile : ".$user_details->mobile." \n ";
				?>
					<span title="<?=$user_mouse_over?>" onclick="javascript:return alert(this.title);"><?=$user_details->name?></span>
				<?php
			}
			else{
				echo $user_id;
			}
		}
	}
    public function index()
    {
		PermissionsController::check('view','manage_users');
		
		$users = User::paginate(SettingsController::getSetting('pagination_rows'));//->where('active_status','1')
        return view('pages.manage_users', ['users' => $users]);
    } 
	public function registerForm()
    {
		PermissionsController::check('view','manage_users');
		
        return view('users.register');
    }
	public function inactive()
    {		
		if(Auth::user()->user_group_id != 1){
			return redirect('profile');
			die('Permission Denied.');
		}
		
		$users = User::paginate(10);//   ->where('active_status','0') 
        return view('pages.manage_users', ['users' => $users]);
    } 
    public function update_users_group(Request $request)
	{
		$post_data = $request->input();
		$error_occured = 0;
		foreach($post_data['group_ids'] as $user_id => $user_group_id)
		{
			$user = User::find($user_id);
			$user->user_group_id = $user_group_id;
			
			if($user->save()){
				//Do Nothing
			}
			else{
				$error_occured = 1;
			}
		}
		if($error_occured==0){
			$msg = 'Users Updated!';	$msg_class = "success";
		}
		else{
			$msg = 'Some Error!';	$msg_class = "danger";
		}
		Session::flash('message', $msg); 
		Session::flash('alert-class', 'alert-'.$msg_class); 
		return redirect('user');	
	}	
    public static function get_user_details($user_id)
	{
		$user_details = array();
		$user_object = User::where('id',$user_id)->get();
		foreach($user_object as $user_details){}
		return $user_details;
	}
}
