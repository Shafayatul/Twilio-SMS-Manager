@extends('layouts.app')

@section('content')
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>User</h2>
            </div>
            <!-- Input -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <div class="row">
                                <div class="col-md-10">
                                    <h2>
                                        User List
                                    </h2>
                                </div>
                            </div>
                        </div>
                        @include('layouts.partials.alert')
                        <div class="body">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th>
                                        <th> Group </th>
                                        <th> Fname </th>
                                        <th> Lname </th>
                                        
                                    </tr>
                                    @foreach($usData as $csv)
                                    <tr>
                                        <td>{{ $csv->id }}</td>
                                        <td> {{ $csv->group }} </td>
                                        <td> {{ $csv->fname }} </td>
                                        <td> {{ $csv->lname }} </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
