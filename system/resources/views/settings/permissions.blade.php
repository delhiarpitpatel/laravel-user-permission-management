<?php 
use \App\Http\Controllers\UserGroupsController; 
use \App\Http\Controllers\ModulesController; 
?>
@extends('layouts.app', ['activePage' => 'setting-permissions', 'titlePage' => __('User Group Permissions')])

@section('content')
 <div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
				<h4 class="card-title ">User Group Permissions</h4>
				@if(Session::has('message'))
					<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
				@else
					<p class="card-category"> Here you can manage Permissions</p>
				@endif
            </div>
            <div class="card-body">			
			<form method="post" action="{{ route('settings/permissions/update') }}" class="form-horizontal">
            @csrf
			  <div class="row">
				<div class="col-12 text-right">
				  <input class="btn btn-sm btn-primary" type="submit" value="Update" />
				</div>
			  </div>
              <div class="table-responsive">
                <table class="table">	
					<thead class="text-primary">
						<tr>
							<th>Slno.</th>
							<th>Group Name</th>
							<th>Module Name</th>
							<th width="5%">View</th>
							<th width="5%">Add</th>
							<th width="5%">Edit</th>
							<th width="5%">Delete</th>
						</tr>
					</thead>	
                  <tbody>
				  <?php $i=0;?>
				  @foreach($group_permissions as $permissions)
				  <?php $id = $permissions->id;?>
                   <tr>
                        <td>{{++$i}}</td>
                        <td>{{UserGroupsController::getUserGroupName($permissions->user_group_id)}}</td>
                        <td>{{ModulesController::getModuleName($permissions->module_id)}}</td>
                        <td> 
							<input type="hidden" name="permissions[{{$id}}][view]" value="0">
							<input class="form-control" name="permissions[{{$id}}][view]" type="checkbox" <?php if($permissions->view==1)echo 'checked value="1"';?> />
						</td>	
                        <td> 
							<input type="hidden" name="permissions[{{$id}}][add]" value="0">
							<input class="form-control" name="permissions[{{$id}}][add]" type="checkbox" <?php if($permissions->add==1)echo 'checked value="1"';?> />
						</td>	
                        <td> 
							<input type="hidden" name="permissions[{{$id}}][edit]" value="0">
							<input class="form-control" name="permissions[{{$id}}][edit]" type="checkbox" <?php if($permissions->edit==1)echo 'checked value="1"';?> />
						</td>	
                        <td> 
							<input type="hidden" name="permissions[{{$id}}][delete]" value="0">
							<input class="form-control" name="permissions[{{$id}}][delete]" type="checkbox" <?php if($permissions->delete==1)echo 'checked value="1"';?> />
						</td>						
                    </tr>
				  @endforeach
                    </tbody>
                </table>
			</form>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection