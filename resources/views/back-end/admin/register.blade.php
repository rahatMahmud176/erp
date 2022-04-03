@extends('back-end.master')

@section('title')
    Register    
@endsection

@section('mainContent')
<div class="home-btn d-none d-sm-block">
    <a href="index.html" class="text-dark"><i class="fas fa-home h2"></i></a>
</div>
<div class="account-pages my-5 pt-sm-5 ">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card overflow-hidden">
                    <div class="bg-soft-primary">
                        <div class="row">
                            <div class="col-7">
                                <div class="text-primary p-4">
                                    <h5 class="text-primary">Free Register</h5>
                                    <p>Get your free Skote account now.</p>
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
                            {{ Form::open([ 'route'=>'admin-register-info','class'=>'form-horizontal', 'method'=>'POST']) }}
                            <div class="form-group">
                                <label for="useremail">Email</label>
                                <input type="email" name="email" class="form-control" id="useremail" placeholder="Enter email">        
                            </div>
            
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="userName" class="form-control" id="username" placeholder="Enter username">
                            </div>
            
                            <div class="form-group">
                                <label for="userpassword">Password</label>
                                <input type="password" name="password" class="form-control" id="userpassword" placeholder="Enter password">        
                            </div>
                            <div class="form-group">
                                <label for="userpassword">Re-Password</label>
                                <input type="password" name="re-password" class="form-control" id="userpassword" placeholder="Enter password">        
                            </div>
            
                            <div class="mt-4">
                                <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">Register</button>
                            </div>
            
                            
            
                            <div class="mt-4 text-center">
                                <p class="mb-0">By registering you agree to the Skote <a href="#" class="text-primary">Terms of Use</a></p>
                            </div>
                        {{ Form::close() }}
                        </div>
    
                    </div>
                </div>
                <div class="mt-5 text-center">
                    
                    <div>
                        <p>Already have an account ? <a href="auth-login.html" class="font-weight-medium text-primary"> Login</a> </p>
                        <p>© 2020 Skote. Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection