@extends('layouts.app')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>Importer {{ $importer->id }}</h2>
        </div>
        <!-- Input -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ url('/importers') }}" title="Back"><button class="btn btn-warning btn-sm"> Back</button></a>
                        <a href="{{ url('/importers/' . $importer->id . '/edit') }}" title="Edit Importer"><button class="btn btn-primary btn-sm"> Edit</button></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['importers', $importer->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('Delete', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-sm',
                                    'title' => 'Delete Importer',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th>
                                        <td>{{ $importer->id }}</td>
                                    </tr>
                                    <tr>
                                        <th> Name </th>
                                        <td> {{ $importer->name }} </td>
                                    </tr>
                                    <tr>
                                        <th> Group </th>
                                        <td> {{ $importer->group }} </td>
                                    </tr>
                                    <tr>
                                        <th> Phone Number </th>
                                        <td> {{ $importer->phone_number }} </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
