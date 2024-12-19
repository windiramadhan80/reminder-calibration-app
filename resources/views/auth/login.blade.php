<!DOCTYPE html>
<html>

<head>
   <meta charset="utf-8" />
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
   <title>Login Reminder Calibration</title>
   <meta content="Visual Graph" name="description" />
   <meta content="Windi Ramadhan" name="author" />
   <meta http-equiv="X-UA-Compatible" content="IE=edge" />

   <link rel="shortcut icon" href="/assets_login/images/logo.png">

   <link href="/assets_login/css/bootstrap.min.css" rel="stylesheet" type="text/css">
   <link href="/assets_login/css/icons.css" rel="stylesheet" type="text/css">
   <link href="/assets_login/css/style.css" rel="stylesheet" type="text/css">

   <!-- jQuery  -->
   <script src="/assets_login/js/jquery.min.js"></script>

</head>


<body class="fixed-left">

   <!-- Begin page -->
   <div class="accountbg"></div>
   <div class="wrapper-page">

      <div class="card">
         <div class="card-body">

            <h3 class="text-center mt-0 m-b-15">
               <a href="/" class="logo logo-admin"><img src="/assets_login/images/logo.png" height="100" alt="logo"></a>
            </h3>
            <h3 class="text-center">Reminder Calibration</h3>

            <div class="p-3">
               <form class="form-horizontal m-t-20" action="/authenticate" method="POST">
                  @csrf
                  <div class="form-group row">
                     <div class="col-12">
                        <input class="form-control @error('email') is-invalid @enderror" name="email" type="email"
                           placeholder="Email" value="{{ old('email') }}">
                        @error('email')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                        @enderror
                     </div>
                  </div>

                  <div class="form-group row">
                     <div class="col-12">
                        <input class="form-control @error('password') is-invalid @enderror" name="password"
                           type="password" placeholder="Password">
                        @error('password')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                        @enderror
                     </div>
                  </div>

                  <div class="form-group row">
                     <div class="col-12">
                        <div class="custom-control custom-checkbox">
                           <input type="checkbox" name="remember" class="custom-control-input" id="customCheck1">
                           <label class="custom-control-label" for="customCheck1">Remember me</label>
                        </div>
                     </div>
                  </div>

                  <div class="form-group text-center row m-t-20">
                     <div class="col-12">
                        <button class="btn btn-danger btn-block waves-effect waves-light" type="submit">Log In</button>
                     </div>
                  </div>
               </form>
            </div>

         </div>
      </div>
   </div>


   <script src="/assets_login/js/popper.min.js"></script>
   <script src="/assets_login/js/bootstrap.min.js"></script>
   <script src="/assets_login/js/modernizr.min.js"></script>
   <script src="/assets_login/js/detect.js"></script>
   <script src="/assets_login/js/fastclick.js"></script>
   <script src="/assets_login/js/jquery.slimscroll.js"></script>
   <script src="/assets_login/js/jquery.blockUI.js"></script>
   <script src="/assets_login/js/waves.js"></script>
   <script src="/assets_login/js/jquery.nicescroll.js"></script>
   <script src="/assets_login/js/jquery.scrollTo.min.js"></script>

   <!-- App js -->
   <script src="/assets_login/js/app.js"></script>

</body>

</html>