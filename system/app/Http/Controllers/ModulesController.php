<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Modules;
use App\Http\Controllers\PermissionsController as Permissions;

class ModulesController extends Controller
{ 
	public static function getModules()
	{		
		$modules = Modules::All();
	
		foreach($modules as $module){
			$module_arr[$module->id] = $module;
		}
		
		return $module_arr;
	}
	public static function getModuleName($module_id)
	{
		
		$modules = Modules::where('id',$module_id)->get();
		
		$module_name = '';
		foreach($modules as $module){
			$module_name = $module->name;
		}
		
		return $module_name;
	}  
    public function manage(Modules $model)
    {			
		Permissions::checkAdmin();
		
		$modules = $model->paginate(SettingsController::getSetting('pagination_rows'));		
		
        return view('modules.manage', ['modules' => $modules]);
    }
	public function addForm()
	{			
		Permissions::checkAdmin();
		return view('modules.add');
	}
	
	public function add(Request $request)
    {			
		Permissions::checkAdmin();
			
		$modules = new Modules;		
		$modules->name = $request->input('module_name'); 
		
		if($modules->save()){
			Permissions::fix('module',$modules->id);
			
			$msg = 'Module Added!';	$msg_class = "success";
		}
		else{
			$msg = 'Some Error!';	$msg_class = "danger";
		}
		
		Session::flash('message', $msg); 
		Session::flash('alert-class', 'alert-'.$msg_class); 
		
		return redirect('module/manage');
    }
}
