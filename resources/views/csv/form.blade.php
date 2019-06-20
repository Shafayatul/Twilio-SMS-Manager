<div class="row">
	<div class="col-md-6">
	    {!! Form::label('upload_by', 'Upload By', ['class' => 'control-label']) !!}
	    {!! Form::text('upload_by', null, array("class" => "form-control", "required" => "required", "maxlength" => "191",'size'=>10)) !!}	
	</div>
	<div class="col-md-6">
	    {!! Form::label('csv', 'Upload Your CSV File Here:', ['class' => 'control-label']) !!}
	    {!! Form::file('csv', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
	    {!! $errors->first('csv', '<p class="help-block">:message</p>') !!}
	</div>
</div>
<div class="row">
	<div class="col-md-6">
    {!! Form::submit('UPLOAD', ['class' => 'btn btn-primary']) !!}
    </div>
</div>