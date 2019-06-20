@extends('layouts.app')


@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Group</h2>
            </div>
            <!-- Input -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <div class="row">
                                <div class="col-md-4">
                                    <h2>
                                        Group List
                                    </h2>
                                </div>
                                <div class="col-md-8 text-right">
                                    <button type="submit" class="btn btn-primary send-sms">Send Selected</button>
                                    <button type="button" class="btn btn-primary sent-to-all">Send To All</button>
                                <a href="{{URL::to('/clear-database')}}" class="btn btn-danger btn-sm">Clear Database</a>
                                </div>
                            </div>

                        </div>
                        @include('layouts.partials.alert')
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <thead>
                                    <tr>
                                        <th>#</th><th>Group</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($csv_array as $item)
                                        <tr>
                                            <td>
                                                {{ Form::checkbox('$item[]', $item,  false, ['class' => 'single-item filled-in chk-col-deep-orange item', 'id' => $item]) }}
                                                {{Form::label($item, ucfirst($item)) }}</td>
                                            <td>{{ $item }}</td>
                                            <td>
                                            <a href="{{ url('/groupdata-view/' . $item) }}" title="View History"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{URL::to('/csv-group-delete/'.$item)}}" class="btn btn-danger btn-sm" onclick="return confirm('Confirm delete?')"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{--<div class="pagination-wrapper"> {!! $csvs->appends(['search' => Request::get('search')])->render() !!} </div>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Input -->

            <div id="sentToAllModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">
    
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Please write down the message for sending SMS?</h4>
                            </div>
                            <div class="modal-body">
    
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" id="send_by" placeholder="Enter Your name..." required>
                                        <br><br>
                                    </div>
                                    <br>
                                    <div class="col-md-12">
                                        <textarea class="form-control" id="allsms-body" rows="5" placeholder="Write down Your message..."></textarea>
                                        <br><br>
                                    </div>
                                    <br>
                                    <div class="col-md-12">
                                        <button type="button" class="btn btn-primary btn-block" id="sent-to-all">Send SMS</button>
                                    </div>
    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>




            <div id="sms-model" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Please write down the message for sending SMS?</h4>
                        </div>
                        <div class="modal-body">

                            <div class="row">
                                    <div class="col-md-12">
                                            <input type="text" class="form-control" id="sendgroup_by" placeholder="Enter Your name..." required>
                                            <br><br>
                                        </div>
                                <div class="col-md-12">
                                    <textarea class="form-control" id="sms-body" rows="5"></textarea>
                                    <br><br>
                                </div>
                                <br>
                                <div class="col-md-12">
                                    <button type="button" class="btn btn-primary btn-block" id="send-to-user">Send SMS</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('footer-script')
    <script>
        var groupString = '';

        $('#send-to-user').click(function(e) {
          e.preventDefault();
            $.ajax({
                type:'POST',
                url:"{{ url('/ajax/send-group-sms') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data:{
                    'groupString' : groupString,
                    'smsBody' : $('#sms-body').val(),
                    'sendgroup_by' : $("#sendgroup_by").val()
                },
                success:function(data){
                  console.log(data);
                    $('#delete-user-model').modal('toggle');
                    if(data.msg=="Success"){
                        alert("Message successfully sent.");
                        $('#sms-body').val("");
                        $('#sms-model').modal('hide');
                        $('.single-item').prop("checked", false);
                    }
                }
            });
        });


        $('.send-sms').click(function() {
            var selectStatus  = false;
            groupString = '';
            $('.single-item:checked').each(function(i){
                selectStatus  = true;
                groupString = $(this).val()+','+groupString;
            });
            console.log(groupString);
            if (selectStatus) {
                $('#sms-model').modal('show');
            }else{
                alert("Please select at least one.");
            }



        });


        $('.sent-to-all').click(function(){
            
            $('#sentToAllModal').modal('show');
        });


        $("#sent-to-all").click(function(e){
            e.preventDefault();
            var sentAll='sent-to-all';
            var sendBy= $("#send_by").val();
            var allsms=$("#allsms-body").val();
            $.ajax({
                type:'POST',
                url:"{{ url('/ajax/send-all-sms') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data:{
                    'sentAll': sentAll,
                    'allsms' : allsms,
                    'sendBy' : sendBy
                },
                success:function(data){
                    if(data.msg=="Success"){
                        alert("Message successfully sent.");
                        $("#allsms-body").val("");
                        setTimeout(function() {
                            $("#sentToAllModal").modal('hide');
                        }, 1500);
                    }
                }
            });
        });

    </script>
@endsection
