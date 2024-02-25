@extends('layouts.admin')



@section('content')
<div class="container">
    <h1>Server-Sent Events</h1>
        <div class="row">
            <div class="col-md-4">
                <select id="user_id" class="form-control">
                    @foreach ($users as $user )
                    <option value="{{$user->id}}">{{$user->name}}</option>

                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <input type="text" id="message" class="form-control"/>
            </div>

            <div class="col-md-2">
                <input type="button" class="btn btn-success text-white" value="Send" onclick="sendNotification()"/>
            </div>

        </div>
</div>

@endsection

@section('scripts')

    <script>
         $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });

       function sendNotification(id){
        $.ajax({
            type: "post",
            url: '{{URL('create-notification')}}',
            data: {
                '_token':"{{csrf_token()}}",
                'id':$("#user_id").val(),
                'message':$("#message").val(),
            },
            success: function (data) {
                console.log(data);
            }
        });
       }
    </script>

@endsection
