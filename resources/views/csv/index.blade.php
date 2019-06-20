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
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-primary send-sms">Send SMS</button>
                                </div>
                            </div>
                        </div>
                        @include('layouts.partials.alert')
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <thead>
                                    <tr>
                                        <th>#</th><th>Group</th><th>Fname</th><th>Lname</th><th>Phone</th><th>Email</th><th>Upload By</th><th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($csvs as $item)
                                        <tr>
                                            <td>
                                                {{ Form::checkbox('$item[]', $item->id,  false, ['class' => 'single-item filled-in chk-col-deep-orange', 'id' => $item->id]) }}
                                                {{Form::label($item->id, ucfirst($item->id)) }}</td>
                                            <td>{{ $item->group }}</td><td>{{ $item->fname }}</td>
                                            <td>{{ $item->lname }}</td>
                                            <td>{{ $item->phone }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->upload_by }}</td>
                                            <td>
   {{--                                              <a href="{{ url('/csv/' . $item->id) }}" title="View CSV"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                                <a href="{{ url('/csv/' . $item->id . '/edit') }}" title="Edit CSV"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a> --}}
                                                {!! Form::open([
                                                    'method'=>'DELETE',
                                                    'url' => ['/csv', $item->id],
                                                    'style' => 'display:inline'
                                                ]) !!}
                                                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-sm',
                                                        'title' => 'Delete CSV',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                                {!! Form::close() !!}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="pagination-wrapper"> {!! $csvs->appends(['search' => Request::get('search')])->render() !!} </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Input -->

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
                                    <label>Send By:</label>
                                    <input type="text" id="send_by" class="form-control" >
                                    <br><br>
                                </div>
                                <br>
                                <div class="col-md-12">
                                    <label>SMS:</label>
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
        var ids = '';
        
        $('#send-to-user').click(function(e) {
            e.preventDefault();
            console.log(ids);
            $.ajax({
                type:'POST',
                url:"{{ url('/ajax/send-individual-sms') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                
                data:{
                    'ids' : ids,
                    'send_by' : $('#send_by').val(),
                    'smsBody' : $('#sms-body').val()
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
            ids='';
            $('.single-item:checked').each(function(i){
                selectStatus  = true;
                ids = $(this).val()+','+ids;
            });
            console.log(ids);
            if (selectStatus) {
                $('#sms-model').modal('show');
            }else{
                alert("Please select at least one.");
            }



        });
    </script>
@endsection
