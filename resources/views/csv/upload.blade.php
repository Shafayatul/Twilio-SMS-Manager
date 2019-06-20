@extends('layouts.app')


@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Upload CSV File</h2>
            </div>
            <!-- Input -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Upload CSV File
                            </h2>
                        </div>
                        <div class="body">
                            @if ($errors->any())
                                <ul class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif
                            {!! Form::open(["url"=>url('/store/csv'), "files" => true]) !!}
                                <div class="{{ $errors->has('image') ? 'has-error' : ''}}">
                                    {!! Form::label('csv', 'Upload CSV', ['class' => 'control-label']) !!}
                                    {!! Form::file('csv', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                    {!! $errors->first('csv', '<p class="help-block">:message</p>') !!}
                                    {!! Form::submit('Upload', ['class' => 'btn btn-primary form-margin']) !!}
                                </div>

                            {!! Form::close() !!}

                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Input -->
        </div>
    </section>
@endsection