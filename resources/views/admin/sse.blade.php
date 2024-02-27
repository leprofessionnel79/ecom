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
                <input type="submit" class="sendNotification btn btn-success text-white" value="Send" />
            </div>
            {{-- onclick="sendNotification()" --}}
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

        $(document).ready(function (){
        $(document).on('click','.sendNotification',function(){

         
            $.ajax({
            type: "POST",
            url: "/admin/create-notification",
            data: {
                'id':$("#user_id").val(),
                'message':$("#message").val(),
            },
            success: function (data) {
                console.log(data);
            }
           });

        });

           // function sendNotification(id){

       });


    </script>

@endsection
