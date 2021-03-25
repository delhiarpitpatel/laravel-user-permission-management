@extends('layouts.app', ['activePage' => 'manage-user-groups', 'titlePage' => __('Add User Group')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('user/groups/_add') }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('put')
            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('User Group Form') }}</h4>
              </div>
              <div class="card-body ">				 
                <div class="row">
                  <div class="col-sm-3"></div>
                  <div class="col-sm-2 col-form-label">{{ __('Group Name') }}</div>
                  <div class="col-sm-2">
                    <div class="form-group">
                      <input class="form-control" name="group_name" type="text" required="true"/>
                    </div>
                  </div>
                </div>  
              </div>     				
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-primary">{{ __('Add') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>      
      </div>
    </div>
  </div>
@endsection