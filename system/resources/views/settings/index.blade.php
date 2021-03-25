@extends('layouts.app', ['activePage' => 'setting-management', 'titlePage' => __('Settings Management')])

@section('content')
 <div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
				<h4 class="card-title ">Settings</h4>
				@if(Session::has('message'))
					<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
				@else
					<p class="card-category"> Here you can manage Settings</p>
				@endif
            </div>
            <div class="card-body">			
			<form method="post" action="{{ route('update_settings') }}" class="form-horizontal">
            @csrf
			  <div class="row">
				<div class="col-12 text-right">
				  <input class="btn btn-sm btn-primary" type="submit" value="Update" />
				</div>
			  </div>
              <div class="table-responsive">
                <table class="table">
				{{--
                  <thead class=" text-primary">
                    <tr>
					<th>Slno.</th>
					<th>Name</th>
					<th>Member Id</th>
                    <th>Creation date</th>
                  </tr></thead>
				--}}
                  <tbody>
				  <?php $i=0;?>
				  @foreach($settings as $setting)
                   <tr>
                        <td>{{++$i}}</td>
                        <td>{{$setting->display_name}}</td>
                        <td> 
						<input class="form-control " name="settings[{{$setting->name}}]" type="text" value="{{$setting->value}}" required="true" aria-required="true"/></td>
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
					<td colspan="8">{{$settings->links()}}</td>
				  </tr>
                    </tbody>
                </table>
			</form>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>
  <div  class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
	<div class="modal-content" style="margin-top:200px !important">
	  <div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Add Keys</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
	  </div>
	 <form action="add_keys" id="add_keys" onSubmit="add_keys()" method="post" enctype="multipart/form-data">
		@csrf
		  <div class="modal-body">       
			  <div class="form-group">				 
				<input type="text" required class="form-control" id="no_of_keys" name="no_of_keys" placeholder="Number Of Keys" value="10" minlength="1">
			  </div>			  
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			<input type="submit" name="btn_add_new_member" value="Submit" id="btn_add_new_member" class="btn btn-primary" />
		  </div>	  
	 </form>	  
	</div>
  </div>
</div>
</div>
@endsection

@push('js')
    @once
		<script>
		 
		$('#exampleModal').promise().done(function( arg1 ) {   
		   
		   $('#exampleModal').on('show.bs.modal', function (event) {
			  var button = $(event.relatedTarget) // Button that triggered the modal
			  var recipient = button.data('whatever') // Extract info from data-* attributes
			  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
			  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
			  var modal = $(this)
			  //modal.find('.modal-title').text('New message to ' + recipient)
			  //modal.find('#parent_id').val(recipient)
			  
			  //alert(' - ' + recipient);
			})

		}); 

		function add_keys(){
			
			// js validation here 
			 
		} 
		</script> 
    @endonce
@endpush