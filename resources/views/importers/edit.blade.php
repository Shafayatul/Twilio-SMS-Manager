@extends('layouts.app')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>Edit Importer #{{ $importer->id }}</h2>
        </div>
        <!-- Input -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Edit #{{ $importer->id }}
                        </h2>
                    </div>
                    <div class="body">
                        <a href="{{ url('/importers') }}" title="Back"><button class="btn btn-warning btn-sm"> Back</button></a>
                        <br />
                        <br />
                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::model($importer, [
                            'method' => 'PATCH',
                            'url' => ['/importers', $importer->id],
                            'files' => true
                        ]) !!}

                        @include ('importers.form', ['formMode' => 'edit'])

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Input -->
    </div>
</section>
@endsection
