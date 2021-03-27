<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- jQuery and JS bundle w/ Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.rtlcss.com/bootstrap/v4.5.3/js/bootstrap.bundle.min.js" integrity="sha384-40ix5a3dj6/qaC7tfz0Yr+p9fqWLzzAXiwxVLt9dw7UjQzGYw6rWRhFAnRapuQyK" crossorigin="anonymous"></script>
    <title>Itbeep Challenge </title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.1.1/css/mdb.min.css" integrity="sha512-vbHq6SaqHW/OPyfei/7ur+YG+Qa0FbcAhv8aftHV1f/97a8PsHAtQL8Ero9OcjmQ+obsWSESqi1kx1Hi/oi+Hg==" crossorigin="anonymous" />

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.1.1/js/mdb.min.js" integrity="sha512-3yGteaiMnpsxSo0LHYMpODezVs6NjMZ6vFyRoqQK4WcRhacpMCgUsQ4yfu5GtcMoWf2zjDP5ENtmx1+eCCtKXw==" crossorigin="anonymous"></script>

    <link rel="stylesheet" href={{asset("style.css")}}>
</head>
<body>

{{-- Modal  --}}

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body">
                <div class="modal-body text-center" id="service_model">
                    @foreach ($services as $service)
                        <input class="btn-check" id="{{ $service->s_id }}" autocomplete="off"  name="service" type="checkbox" value="{{ $service->s_id }}"/>
                        <label class="btn btn-primary" for="{{ $service->s_id }}">{{$service->service_name}}</label>
                    @endforeach
                </div>
                <div class="modal-body hide text-center" id="feeling_model">
                    @foreach ($feelings as $feeling)
                        <div class="myradio" >
                            <input type="radio" class="radio_input" name="feeling" value="{{ $feeling->f_id }} id={{ $feeling->f_id }}" />
                            <label class="radio_label"  for="{{ $feeling->f_id }}"> {{$feeling->feeling_name}}</label>
                        </div>
                    @endforeach
                </div>
                <div class="modal-body hide text-center" id="thanks">
                    <h5 class="modal-title" id="exampleModalLabel"> Thank you!</h5>
                    <form  dir="ltr" class="p-4">
                        @csrf
                        <div class="d-flex mb-4">
                            We have sent you an email confirmation.
                            Please check your email.
                        </div>
                    </form>
                    <button type="button" class="btn btn-secondary w-100" id="closeModal" data-dismiss="modal">Close</button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="close" data-dismiss="modal">Close</button>
                <button  name="next" onclick="changeModel()"  id="next" class="btn btn-primary">Next</button>
                <button  type="submit" onclick="message()" name="send" id="send" class="btn btn-primary hide">Send</button>
            </div>
        </div>
    </div>
</div>

{{--Form starts--}}
<div class='wrapper'>
    <div class='col-sm-4 p-4 border'>
        <h1 class="text-center display-1 mb-5 " >Logo</h1>
        <form id="form" onsubmit="event.preventDefault()" >
            @csrf
            <div class="form-group">
                <label for="exampleInputPassword1">Name</label>
                <input type="text" name='name' id="name" class="form-control" placeholder="Enter your name">
            </div>
            @if ($errors->has('name'))
                <div class="alert alert-danger error_message">{{ $errors->first('name') }}</div>
            @endif
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
            </div>
            @if ($errors->has('email'))
                <div class="alert alert-danger">{{ $errors->first('email') }}</div>
            @endif
            <div class="form-group mb-2">
                <label for="exampleInputPassword1">Mobile</label>
                <input type="tel" id="mobile" name="mobile" class="form-control"  placeholder="Enter your mobile">
            </div>
            @if ($errors->has('mobile'))
                {{alert('wrong')}}
                <div class="alert alert-danger">{{ $errors->first('mobile') }}</div>
            @endif
            <input type="hidden"  id="service_id" name="service_id"  >
            <input type="hidden" id="feeling_id" name="feeling_id"  >
            <button type="submit" name="submit" id="click" class="btn btn-default btn-rounded mb-4" data-toggle="modal" data-target="#exampleModalCenter"  >Submit</button>
        </form>
    </div>
</div>

<script>

    $(document).ready(function() {

        let username = document.getElementById('name');
        let useremail = document.getElementById('email');
        let usermobile = document.getElementById('mobile');
        let button      = document.getElementById('click');
        button.disabled = true;

        username.addEventListener('change', stateHandler);
        useremail.addEventListener('change', stateHandler);
        usermobile.addEventListener('change', stateHandler);
        function  stateHandler()
        {
            if( username.value === '' || useremail.value === '' || usermobile.value === ''){
                button.disabled = true;
            }else {
                button.disabled = false;
            }
        }
        
        $('#click').click(function(event) {

            let name    = $('#name').val();
            let email   = $('#email').val();
            let mobile  = $('#mobile').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // console.log(name, email, mobile);

            $.ajax({
                url:'store',
                type:'POST',
                data:  {
                    'name'   :name,
                    'email'  : email,
                    'mobile' : mobile,
                    '_token' : $('input[name=_token]').val()
                },
                success:function(data) {
                    // console.log(data);
                    sessionStorage.setItem('user_id', data);
                }
            });
        })

        $('#next').click(function(event) {
            let services = [];
            $.each($("input[name='service']:checked"), function(){
                services.push($(this).val());
            });

            $.ajax({
                url:'updateService',
                type:'POST',
                data:  {
                    'service':services,
                    'user_id':sessionStorage.getItem('user_id'),
                    '_token' : $('input[name=_token]').val(),
                },
                success:function(data) {
                    console.log(data);
                }
            });
        });

        $('#send').click(function(event) {
            let feeling = $("input[name='feeling']:checked").val();
 
            $.ajax({
                url:'update',
                type:'POST',
                data:  {
                    'feeling':feeling,
                    'user_id':sessionStorage.getItem('user_id'),
                    '_token' : $('input[name=_token]').val()
                },
                success:function(data) {
                    console.log(data);
                }
            });
        
        $.ajax({
            url:'mail',
            type:'get',
            data:{
                '_token' : $('input[name=_token]').val()
            },
            success:function(data) {
                    console.log(data);
                    // alert(data)
                }
        })
    });
    });
    function changeModel(){
        document.getElementById('service_model').style.display = 'none';
        document.getElementById('next').style.display = 'none';
        document.getElementById('feeling_model').style.display = 'block';
        document.getElementById('send').style.display = 'block';
    }
    function message(){
        document.getElementById('thanks').style.display = 'block';
        document.getElementById('feeling_model').style.display = 'none';
        document.getElementById('send').style.display = 'none';
        document.getElementById('next').style.display = 'none';
        document.getElementById('close').style.display = 'none';
    }


</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
