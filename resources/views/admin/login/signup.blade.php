<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page</title>
    <link rel="stylesheet" href="{{url('public/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('public/bootstrap/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{url('public/bootstrap/css/nprogress.css')}}">
    <link rel="stylesheet" href="{{url('public/bootstrap/css/prettify.min.css')}}">
    <link rel="stylesheet" href="{{url('public/bootstrap/css/custom.min.css')}}">
</head>
<body class="login">
<div>
    <a class="hiddenanchor" id="signup"></a>
    <a class="hiddenanchor" id="signin"></a>

    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">


                <form method="post" action="{{route('signup')}}" enctype="multipart/form-data">

                    <h1>Sing Up Form</h1>

                    {{csrf_field()}}
                    <div>
                        <input type="text" name="name" class="form-control" placeholder="name"  />
                        {{$errors->first()}}
                    </div>
                    <div>
                        <input type="text" name="username" class="form-control" placeholder="Username"  />
                        {{$errors->first('username')}}
                    </div>
                    <div>
                        <input type="text" name="email" class="form-control" placeholder="email" />
                        {{$errors->first('email')}}
                    </div>
                    <div>
                        <input type="password" name="password" class="form-control" placeholder="Password" />
                        {{$errors->first('password')}}
                    </div>
                    <div>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Password"  />
                        {{$errors->first('password_confirmation')}}
                    </div>
                    <div>
                        <input type="file" name="upload" class="btn btn-default"/>
                        {{$errors->first('upload')}}
                    </div>
                    <div>
                     <button type="submit" class="btn btn-primary pull-left">Sign Up </button>

                    </div>

                    <div class="clearfix"></div>

                </form>
            </section>
        </div>


    </div>
</div>

</body>
</html>