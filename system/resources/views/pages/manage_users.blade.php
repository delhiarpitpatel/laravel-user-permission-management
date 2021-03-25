<?php use App\Http\Controllers\UserGroupsController; ?>

@extends('layouts.app', ['activePage' => 'user-management', 'titlePage' => __('Users Management')])

@section('content')
 <div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">Users</h4>
				@if(Session::has('message'))
					<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
				@else
					<p class="card-category"> Here you can manage users</p>
				@endif
            </div>
            <div class="card-body">				
				<form method="post" action="{{ route('user/groups/update') }}" autocomplete="off" class="form-horizontal">
					@csrf
					@method('put')
					<div class="row">
						<div class="col-3 text-right">
						  <button type="submit" class="btn btn-sm btn-primary">{{ __('Update All') }}</button>
						</div>
						<div class="col-9 text-right">
							<a href="{{ route('user/register') }}" class="btn btn-primary"  type="button" >Add User</a>
						</div>
					</div>
					<div class="table-responsive">
						<table class="table">
							<thead class=" text-primary">
								<tr>
									<th>Slno.</th>
									<th>Id</th>
									<th>User Group</th>
									<th>Name</th>
									<th>Email</th>
									<th>Mobile</th>
									<th>Creation date</th>
									{{--
									<th class="text-right">
									  Actions
									</th>
									--}}
								</tr>
							</thead>
							<tbody>
							  <?php $i=0;?>
								@foreach($users as $user)
									<tr>
										<td>{{++$i}}</td>
										<td>{{$user->id}}</td>
										<td>
                                        <select name="group_ids[{{$user->id}}]" class="form-control">
                                        	<option value="0">Select</option>
                                            @foreach(UserGroupsController::getUserGroupArray() as $group_id => $group_name)
                                        		<option value="{{$group_id}}" <?php if($group_id==$user->user_group_id){echo 'selected="selected"';}?>>{{$group_name}}</option>
                                            @endforeach
                                        </select>
										</td>
										<td>{{$user->name}}</td>
										<td>{{$user->email}}</td>
										<td>{{$user->mobile}}</td>
										<td>{{$user->created_at}}</td>
										{{--
										<td class="td-actions text-right">
											<a rel="tooltip" class="btn btn-success btn-link" href="#" title="">
												<i class="material-icons">
													edit
												</i>
												<div class="ripple-container"></div>
											</a>
										</td>
										--}}
									</tr>
								@endforeach
								<tr>
									<td colspan="6">{{$users->links()}}</td>
								</tr>
							</tbody>
						</table>
					</div>
				</form>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection