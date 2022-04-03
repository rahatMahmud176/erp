@extends('back-end.master')
@section('title')
    Login
@endsection
@section('mainContent')
<div class="home-btn d-none d-sm-block">
    <a href="index.html" class="text-dark"><i class="fas fa-home h2"></i></a>
</div>
<div class="account-pages my-5 pt-sm-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card overflow-hidden">
                    <div class="bg-soft-primary">
                        <div class="row">
                            <div class="col-7">
                                <div class="text-primary p-4">
                                    <h5 class="text-primary">Welcome Back !</h5>
                                    <p>Sign in to continue to Skote.</p>
                                </div>
                            </div>
                            <div class="col-5 align-self-end">
                                <img src="assets/images/profile-img.png" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0"> 
                        <div>
                            <a href="index.html">
                                <div class="avatar-md profile-user-wid mb-4">
                                    <span class="avatar-title rounded-circle bg-light">
                                        <img src="assets/images/logo.svg" alt="" class="rounded-circle" height="34">
                                    </span>
                                </div>
                            </a>
                        </div>
                        <div class="p-2">
                            {{ Form::open(['class'=>'form-horizontal','method'=>'POST','route'=>'login-info-submit']) }}
                            <div class="form-group">
                                <label for="username">Email</label>
                                <input type="text" name="email" class="form-control" id="username" placeholder="Enter Email">
                            </div>
            
                            <div class="form-group">
                                <label for="userpassword">Password</label>
                                <input type="password" name="password" class="form-control" id="userpassword" placeholder="Enter password">
                            </div>
            
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" required id="customControlInline">
                                <label class="custom-control-label" for="customControlInline">Remember me</label>
                            </div>
                            
                            <div class="mt-3">
                                <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">Log In</button>
                            </div>
             
                             
            
                            <div class="mt-4 text-center">
                                <a href="auth-recoverpw.html" class="text-muted"><i class="mdi mdi-lock mr-1"></i> Forgot your password?</a>
                            </div>
                        {{ Form::close() }}
                        </div>
    
                    </div>
                </div>
                <div class="mt-5 text-center">
                    
                    <div>
                        <p>Don't have an account ? <a href="auth-register.html" class="font-weight-medium text-primary"> Signup now </a> </p>
                        <p>© 2020 Skote. Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection