<div class="sidebar" data-color="orange" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <div class="logo">
    <a href="{{ route('home')}}" class="simple-text logo-normal">
      {{ __('Admin Panel') }}
    </a>
  </div>  
  <div class="sidebar-wrapper">
    <ul class="nav">
	
	<li class="nav-item">        
		<a class="nav-link" href="{{ route('home')}}" >
		<i><img style="width:25px" src="{{ asset('material') }}/img/laravel.svg"></i>
		{{ __('Dashboard') }}</a>
	</li>
	  		
	<?php $group_id = Auth::user()->user_group_id ?>
	@if($group_id == 1)
		<li class="nav-item {{ ($activePage == 'user-management') ? ' active' : '' }}">
			<a class="nav-link" data-toggle="collapse" href="#Administrator" aria-expanded="{{ ($activePage == 'user-management' || $activePage == 'setting-management' || $activePage == 'setting-permissions'|| $activePage == 'manage-user-groups'|| $activePage == 'manage-modules') ? 'true' : 'false' }}">
			  <i><img style="width:25px" src="{{ asset('material') }}/img/people-24px.svg"></i>
			  <p>{{ __('Administrator') }}
				<b class="caret"></b>
			  </p>
			</a>
			<div class="collapse {{ ($activePage == 'user-management' || $activePage == 'setting-management'  || $activePage == 'setting-permissions'|| $activePage == 'manage-user-groups' || $activePage == 'manage-modules' ) ? 'show' : '' }}" id="Administrator">
			  <ul class="nav">
				<li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
				  <a class="nav-link" href="{{ route('user.index') }}">
					<span class="sidebar-mini"> MU </span>
					<span class="sidebar-normal">{{ __('Manage Users') }} </span>
				  </a>
				</li>
				<li class="nav-item{{ $activePage == 'manage-user-groups' ? ' active' : '' }}">
				  <a class="nav-link" href="{{ route('user/groups/manage') }}">
					<span class="sidebar-mini"> UG </span>
					<span class="sidebar-normal">{{ __('User Groups') }} </span>
				  </a>
				</li> 
				<li class="nav-item{{ $activePage == 'setting-permissions' ? ' active' : '' }}">
				  <a class="nav-link" href="{{ route('settings/permissions') }}">
					<span class="sidebar-mini"> GP </span>
					<span class="sidebar-normal">{{ __('Group Permissions') }} </span>
				  </a>
				</li> 
				<li class="nav-item{{ $activePage == 'manage-modules' ? ' active' : '' }}">
				  <a class="nav-link" href="{{ route('module/manage') }}">
					<span class="sidebar-mini"> MM </span>
					<span class="sidebar-normal">{{ __('Manage Modules') }} </span>
				  </a>
				</li> 
				<li class="nav-item{{ $activePage == 'setting-management' ? ' active' : '' }}">
					<a class="nav-link" href="{{ route('settings.index') }}">
					  <i class="material-icons">content_paste</i>
						<p>{{ __('Settings') }}</p>
					</a>
				</li>
			  </ul>
			</div>
		</li>
	@endif
      <li class="nav-item {{ ($activePage == 'profile' || $activePage == 'key-management') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#laravelExample" aria-expanded="{{ ($activePage == 'profile' || $activePage == 'key-management') ? 'true' : 'false' }}">
          <i><img style="width:25px" src="{{ asset('material') }}/img/people-24px.svg"></i>
          <p>{{ __('Profile') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ ($activePage == 'profile') ? 'show' : '' }}" id="laravelExample">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('profile.edit') }}">
                <span class="sidebar-mini"> M </span>
                <span class="sidebar-normal">{{ __('Manage') }} </span>
              </a>
            </li>
			 
          </ul>
        </div>
      </li>
	   
	  <li class="nav-item">
        
		<a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
		<i><img style="width:25px" src="{{ asset('material') }}/img/login-24px.svg"></i>
		{{ __('Log out') }}</a>
      </li>
	  
    </ul>
  </div>
</div>