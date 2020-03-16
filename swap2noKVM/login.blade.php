<!DOCTYPE html>
<html lang="en">
<head>
    <title>NoKvm</title>
    <!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 10]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <meta name="author" content="CodedThemes" />

    <!-- Favicon icon -->
    <link rel="icon" href="{{asset('assets/images/favicon.ico')}}" type="image/x-icon">
    <!-- fontawesome icon -->
    <link rel="stylesheet" href="{{asset('assets/fonts/fontawesome/css/fontawesome-all.min.css')}}">
    <!-- animation css -->
    <link rel="stylesheet" href="{{asset('assets/plugins/animation/css/animate.min.css')}}">
    <!-- vendor css -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/layouts/dark.css')}}">

    <!-- Notification css -->
    <link href="{{asset('assets/plugins/notification/css/notification.min.css')}}" rel="stylesheet">
</head>
<body>
<div class="auth-wrapper aut-bg-img" style="background-image: url('{{asset('assets/images/bg-images/bg3.jpg')}}');">
    <div class="auth-content">
        <div class="text-white">
            <div class="card-body text-center">
                <div class="mb-4">
                    <i class="feather icon-unlock auth-icon"></i>
                </div>
                <h3 class="mb-4 text-white">云主机管理面板</h3>
                <div class="input-group mb-3">
                    <input id="username" type="text" class="form-control" placeholder="云主机名称">
                </div>
                <div class="input-group mb-4">
                    <input id="password" type="password" class="form-control" placeholder="云主机系统密码">
                </div>
                <div class="form-group text-left">
                    <div class="checkbox checkbox-fill d-inline">
                        {{--<input type="checkbox" name="checkbox-fill-1" id="checkbox-fill-a1" checked="">--}}
                        {{--<label for="checkbox-fill-a1" class="cr"> Save credentials</label>--}}
                    </div>
                </div>
                <button id="login-btn" class="btn btn-primary shadow-2 mb-4" data-type="inverse" data-from="top" data-align="center">Login</button>
                {{--<p class="mb-2 text-muted">Forgot password? <a class="text-white" href="auth-reset-password-v3.html">Reset</a></p>--}}
                {{--<p class="mb-0 text-muted">Don’t have an account? <a class="text-white" href="auth-signup-v3.html">Signup</a></p>--}}
            </div>
        </div>
    </div>
</div>

<!-- Required Js -->
<script src="{{asset('assets/js/vendor-all.min.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/pcoded.min.js')}}"></script>

<script src="{{asset('assets/plugins/notification/js/bootstrap-growl.min.js')}}"></script>
<script>
    $('#login-btn').click(function () {
        if ($(this).hasClass('disabled')){
            return;
        }
        $(this).addClass('disabled');

        var nFrom = $(this).attr('data-from');
        var nAlign = $(this).attr('data-align');
        var nType = $(this).attr('data-type');
        var nAnimIn = $(this).attr('data-animation-in');
        var nAnimOut = $(this).attr('data-animation-out');

        var username = $('#username').val();
        var password = $('#password').val();

        if (username == '' || password == ''){
            notify(nFrom, nAlign, nType, nAnimIn, nAnimOut,'账号或密码不能为空');
            $(this).removeClass('disabled');
            return false;
        }

        $.ajax({
            type:'POST',
            url:'{{url('vpsadm/login_to')}}',
            data:{_token:'{{csrf_token()}}',vpsname:username,password:password},
            success:function (res) {
                if (res.code == 0){
                    window.location.href='{{url('vpsadm')}}';
                }else{
                    notify(nFrom, nAlign, nType, nAnimIn, nAnimOut,res.message);
                    $('#login-btn').removeClass('disabled');
                }
            }
        });
    });

    function notify(from, align, type, animIn, animOut,message) {
        $.growl({
            message: message,
        }, {
            element: 'body',
            type: type,
            allow_dismiss: true,
            placement: {
                from: from,
                align: align
            },
            offset: {
                x: 30,
                y: 30
            },
            spacing: 10,
            z_index: 999999,
            delay: 2500,
            timer: 1000,
            url_target: '_blank',
            mouse_over: false,
            animate: {
                enter: animIn,
                exit: animOut
            },
            icon_type: 'class',
            template: '<div data-growl="container" class="alert" role="alert">' +
            '<button type="button" class="close" data-growl="dismiss">' +
            '<span aria-hidden="true">&times;</span>' +
            '<span class="sr-only">Close</span>' +
            '</button>' +
            '<span data-growl="icon"></span>' +
            '<span data-growl="title"></span>' +
            '<span data-growl="message"></span>' +
            '<a href="#!" data-growl="url"></a>' +
            '</div>'
        });
    };
    function getQueryVariable(variable)
    {
       var query = window.location.search.substring(1);
       var vars = query.split("&");
       for (var i=0;i<vars.length;i++) {
               var pair = vars[i].split("=");
               if(pair[0] == variable){return pair[1];}
       }
       return '';
    }
    var username = getQueryVariable('vpsname');
    var pass = getQueryVariable('VPSpassword');
    if(username !== '' && password !==''){
        $('#username').val(username);
        $('#password').val(pass);   
        $('#login-btn').click();        
    }
</script>

</body>
</html>
