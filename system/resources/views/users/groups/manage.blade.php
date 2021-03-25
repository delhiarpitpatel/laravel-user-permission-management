<?php
use App\Http\Controllers\PermissionsController as Permissions;
use App\Http\Controllers\UserController as User;
?>
@extends('layouts.app', ['activePage' => 'manage-user-groups', 'titlePage' => __('User Groups Management')])

@section('content')
 <div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
				<h4 class="card-title "> User Groups</h4>
				@if(Session::has('message'))
					<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
				@else
					<p class="card-category"> Here you can manage User Groups</p>
				@endif
            </div>
            <div class="card-body">
                <div class="row">
					<div class="col-12 text-right">
					  <a href="{{ route('user/groups/add') }}" class="btn btn-sm btn-primary" id="btn_add_keys"  type="button" >Add User Group</a>
					</div>
				</div>
				<div class="table-responsive">
					<table class="table table-hover">
					  <thead class=" text-primary">
						<tr>
						<th>Slno.</th>
						<th>User Groups ID</th>
						<th>Name</th>
					  </tr></thead>
					  <tbody>
					  <?php $i=0;?>
					  @foreach($userGroups as $group)
					   <tr>
							<td>{{++$i}}.</td>
							<td>{{$group->id}}</td>
							<td>{{$group->name}} </td>							 
						</tr>
					  @endforeach
					  <tr>
						<td colspan="8">{{$userGroups->links()}}</td>
					  </tr>
						</tbody>
					</table>
				</div>
            </div>
          </div>
      </div>
    </div>
  </div>
  
</div>
@endsection