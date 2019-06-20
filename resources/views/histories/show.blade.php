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
                    
                    <div class="card-body">

                        <a href="{{ url('/histories') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th>
                                        <th> Send By </th>
                                        <th> Sms Content </th>
                                        <th> Send To </th>
                                    </tr>
                                    <tr>
                                        <td>{{ $history->id }}</td>
                                        <td> {{ $history->send_by }} </td>
                                        <td> {{ $history->sms_content }} </td>
                                        <td> {{ $history->send_to }} </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
