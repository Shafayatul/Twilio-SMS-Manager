<div class="form-group {{ $errors->has('send_by') ? 'has-error' : ''}}">
    {!! Form::label('send_by', 'Send By', ['class' => 'control-label']) !!}
    {!! Form::text('send_by', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('send_by', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('sms_content') ? 'has-error' : ''}}">
    {!! Form::label('sms_content', 'Sms Content', ['class' => 'control-label']) !!}
    {!! Form::textarea('sms_content', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('sms_content', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('send_to') ? 'has-error' : ''}}">
    {!! Form::label('send_to', 'Send To', ['class' => 'control-label']) !!}
    {!! Form::textarea('send_to', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('send_to', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
