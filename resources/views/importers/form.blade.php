    {!! Form::label('name', 'Name', ['class' => 'control-label']) !!}
    {!! Form::text('name', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    <br>

    {!! Form::label('group', 'Group', ['class' => 'control-label']) !!}
    {!! Form::text('group', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('group', '<p class="help-block">:message</p>') !!}
    <br>
    {!! Form::label('phone_number', 'Phone Number', ['class' => 'control-label']) !!}
    {!! Form::text('phone_number', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('phone_number', '<p class="help-block">:message</p>') !!}
    <br>
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary btn-sm']) !!}
