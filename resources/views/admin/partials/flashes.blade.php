@if(Session::has('flash_message'))
	<div id="flash_message" class="alert alert-{{ Session::get('flash_type', 'danger') }} alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		{{ Session::get('flash_message') }}
	</div>
@endif