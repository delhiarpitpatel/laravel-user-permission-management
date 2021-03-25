<?php
use App\Http\Controllers\PermissionsController as Permissions;
use App\Http\Controllers\UserController as User;
?>
@extends('layouts.app', ['activePage' => 'manage-modules', 'titlePage' => __('Modules Management')])

@section('content')
 <div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
				<h4 class="card-title ">Modules</h4>
				@if(Session::has('message'))
					<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
				@else
					<p class="card-category"> Here you can manage Modules</p>
				@endif
            </div>
            <div class="card-body">
                <div class="row">
					<div class="col-12 text-right">
					  <a href="{{ route('module/add') }}" class="btn btn-sm btn-primary" id="btn_add_keys"  type="button" >Add Module</a>
					</div>
				</div>
				<div class="table-responsive">
					<table class="table table-hover">
					  <thead class=" text-primary">
						<tr>
						<th>Slno.</th>
						<th>Module ID</th>
						<th>Name</th>
					  </tr></thead>
					  <tbody>
					  <?php $i=0;?>
					  @foreach($modules as $module)
					   <tr>
							<td>{{++$i}}.</td>
							<td>{{$module->id}}</td>
							<td>{{$module->name}} </td>							 
						</tr>
					  @endforeach
					  <tr>
						<td colspan="8">{{$modules->links()}}</td>
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