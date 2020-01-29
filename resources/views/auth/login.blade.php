<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
    <style>
        body{
            background-color: #cccccc;
        }
    </style>
</head>
<body>
    <div class="position-fixed d-flex justify-content-center align-items-center h-100 w-100 body">
        <div class="col-xl-4 col-lg-5 col-md-7 col-sm-8">
            <div class="card content rounded-0">
                <div class="card-body">
                  <div class="row justify-content-center">
                        <div class="col-5">
                            <img src="{{URL::to('/')}}/img/logo.png" class="img-fluid">
                        </div>
                  </div>
                </div>
                <div class="card-body bg-secondary">
                    <h4 class="text-white text-center font-weight-bold">Oriental Mindoro Database System (PPDO)</h4>
                </div>
                <div class="card-body">
                   <form method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="control-label">Username</label>
                            <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                            @if ($errors->has('email'))
                                <span class="help-block text-danger">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="control-label">Password</label>
                            <input id="password" type="password" class="form-control" name="password" required>
                            @if ($errors->has('password'))
                                <span class="help-block text-danger">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                </label>
                            </div>
                        </div>
                       <div class="row justify-content-end">
                           <div class="col-auto">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        Login
                                    </button>
                                </div>
                           </div>
                       </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>