<div class="col-md-12">
    {!! Form::label('group', 'Group', ['class' => 'control-label']) !!}
    {!! Form::text('group', null, array("class" => "form-control", "required" => "required", "maxlength" => "191",'size'=>10)) !!}
    
</div>

<div class="col-md-12">
    {!! Form::label('fname', 'First Name', ['class' => 'control-label']) !!}
    {!! Form::text('fname', null, array("class" => "form-control", "required" => "required", "maxlength" => "191",'size'=>10)) !!}
    
</div>

<div class="col-md-12">
    {!! Form::label('lname', 'Last Name', ['class' => 'control-label']) !!}
    {!! Form::text('lname', null, array("class" => "form-control", "required" => "required", "maxlength" => "191",'size'=>10)) !!}
    
</div>

<div class="col-md-12">
    {!! Form::label('phone', 'Phone', ['class' => 'control-label']) !!}
    {!! Form::text('phone', null, array("class" => "form-control", "required" => "required", "maxlength" => "191",'size'=>10)) !!}
    
</div>

<div class="col-md-12">
    {!! Form::label('email', 'Email', ['class' => 'control-label']) !!}
    {!! Form::email('email', null, array("class" => "form-control", "required" => "required", "maxlength" => "191",'size'=>10)) !!}
    
</div>

<div class="col-md-12">
    {!! Form::label('upload_by', 'Upload By', ['class' => 'control-label']) !!}
    {!! Form::text('upload_by', null, array("class" => "form-control", "required" => "required", "maxlength" => "191",'size'=>10)) !!}
    
</div>

<div class="form-group">
    {!! Form::submit('UPLOAD', ['class' => 'btn btn-primary']) !!}
</div>