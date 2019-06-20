<div class="row">
	<div class="col-sm-12">
		

		@if(Session::has('success'))
			<br>
		    <div class="alert alert-success" role="alert">
			<strong>Success!</strong> {{ Session::get('success') }}
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			</div>
		@endif

		@if(Session::has('error'))
			<br>
			<div class="alert alert-danger">
			    <strong>Error!</strong> {{ Session::get('error') }}
			</div>
		@endif   

		@if ($errors->any())
			<br>
		    <ul class="alert alert-danger">
		        @foreach ($errors->all() as $error)
		            <li>{{ $error }}</li>
		        @endforeach
		    </ul>
		@endif	
	</div>
</div>
