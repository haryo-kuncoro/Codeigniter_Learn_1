
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Login - yoyo Dashboard</title>
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/fonts/googleapis.css">
    <link rel="stylesheet" href="/assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="/assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="/assets/fonts/fontawesome5-overrides.min.css">
</head>

<body style="background-color:#d9edf7;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9 col-lg-12 col-xl-10">
                <div class="card shadow-lg o-hidden border-0 my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-flex">
                                <div class="flex-grow-1 bg-login-image" style="background-image: url(&quot;/assets/bg_login.jpg&quot;);"></div>
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h4 class="text-dark mb-4">yoyo<code>Dashboard</code></h4>
                                    </div>
                                    <hr>
                                    <form class="user" action="/home/prosesLogin" method="post">
                                        <div class="form-group"><input class="form-control form-control-user" type="user" id="InputUsername" placeholder="Username..." name="InputUsername" required></div>
                                        <div class="form-group"><input class="form-control form-control-user" type="password" id="InputPassword" placeholder="Password" name="InputPassword"></div>
                                        <div class="form-group">
                                            <!-- <div class="custom-control custom-checkbox small">
                                                <div class="form-check"><input class="form-check-input custom-control-input" type="checkbox" id="formCheck-1"><label class="form-check-label custom-control-label" for="formCheck-1">Remember Me</label></div>
                                            </div> -->
                                        </div>
                                        </br>
                                        <button class="btn btn-primary btn-block text-white btn-user" type="submit">Login</button>
                                        <!-- <hr><a class="btn btn-primary btn-block text-white btn-google btn-user" role="button"><i class="fab fa-google"></i>&nbsp; Login with Google</a><a class="btn btn-primary btn-block text-white btn-facebook btn-user" role="button"><i class="fab fa-facebook-f"></i>&nbsp; Login with Facebook</a> -->
                                        <hr>
                                    </form>
                                    <div class="text-center"><a class="small" href="#">Lupa Password?</a></div>
                                    <!-- <div class="text-center"><a class="small" href="register.html">Create an Account!</a></div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="/assets/js/bs-init.js"></script>
    <script src="/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="/assets/js/theme.js"></script>
    <script id="bs-live-reload" data-sseport="30660" data-lastchange="1655192095961" src="/js/livereload.js"></script>
</body>

</html>