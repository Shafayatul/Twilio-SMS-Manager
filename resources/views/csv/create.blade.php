@extends('layouts.app')


@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Add csv</h2>
            </div>
            <!-- Input -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                New csv
                            </h2>
                        </div>
                        <div class="body">
                            <div class="row">
                                <div class="col-sm-12">


                                    @if(Session::has('success'))
                                        <br>
                                        <div class="alert alert-success">
                                            <strong>Success!</strong> {{ Session::get('success') }}
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
                            @if ($errors->any())
                                <ul class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif
                            {!! Form::open(["url"=>url('/csv'), "files" => true]) !!}
                            @include ('csv.form')
                            {!! Form::close() !!}

                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Input -->
        </div>
    </section>
@endsection