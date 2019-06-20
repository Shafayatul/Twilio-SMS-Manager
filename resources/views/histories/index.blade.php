@extends('layouts.app')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>Message History</h2>
        </div>
        <!-- Input -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <div class="row">
                            <div class="col-md-10">
                                <h2>
                                    History List
                                </h2>
                            </div>
                            <div class="col-md-2">
                            <a href="{{URL::to('/clear-history')}}" class="btn btn-danger btn-sm">Clear History</a>
                            </div>
                        </div>
                    </div>
                    @include('layouts.partials.alert')
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>#</th><th>Send By</th><th>Sms Content</th><th>Send To</th><th>Time</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($histories as $item)
                                    <tr>
                                        <td>{{ $loop->iteration or $item->id }}</td>
                                        <td>{{ $item->send_by }}</td>
                                        <td>{{ $item->sms_content }}</td>
                                        <td>{{ $item->send_to }}</td>
                                        <td>{{Carbon\carbon::parse($item->created_at)->format("d-m-Y h:i A")}}</td>
                                        <td>
                                            {{-- <a href="{{ url('/histories/' . $item->id) }}" title="View History"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a> --}}
                                            <!--<a href="{ url('/histories/edit') }}" title="Edit History"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>-->
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/histories', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-sm',
                                                        'title' => 'Delete History',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $histories->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
