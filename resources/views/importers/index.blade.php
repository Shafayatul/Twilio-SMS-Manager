@extends('layouts.app')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>Importers</h2>
        </div>
        <div class="row">
            <div class="col-md-12">
                    @if(Session::has('flash_message'))
                    <div class="alert alert-success">
                        <strong>Success!</strong> {{ Session::get('flash_message') }}
                    </div>
                @endif

                @if(Session::has('error'))
                <div class="alert alert-danger">
                    <strong>Error!</strong> {{ Session::get('error') }}
                </div>
                @endif   

                @if(count($errors)>0)
                <div class="alert alert-danger">
                    <strong>Error!</strong> 
                    @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach
                </div>
                @endif


            </div>
        </div>
        <div class="row clearfix">
            <!-- Task Info -->
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="body">
                        <a href="{{ url('/importers/create') }}" class="btn btn-success btn-sm" title="Add New Importer">
                            Add New
                        </a>
                        <div class="table-responsive">
                            <table class="table table-hover dashboard-task-infos">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Group</th>
                                        <th>Phone Number</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($importers as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->group }}</td>
                                        <td>{{ $item->phone_number }}</td>
                                        <td>
                                            <a href="{{ url('/importers/' . $item->id) }}" title="View Importer"><button class="btn btn-info btn-sm"> View</button></a>
                                            <a href="{{ url('/importers/' . $item->id . '/edit') }}" title="Edit Importer"><button class="btn btn-primary btn-sm"> Edit</button></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/importers', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('Delete', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-sm',
                                                        'title' => 'Delete Importer',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $importers->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>                        
                    </div>
                </div>
            </div>
            <!-- #END# Task Info -->
        </div>
    </div>
</section>
@endsection
