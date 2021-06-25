@extends('layouts/main-login')
@section('head')
<style type="text/css">
/*.blur-out{
    transform: translateX(-100%);
}*/

/* Just for CodePen styling - don't include if you copy paste */
html {
  font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif; 
  font-weight: 300;
  margin: 25px;
}

</style>
@endsection
@section('content-body')
    <div class="content row m-0 p-0">
    <!-- <v-userauth></v-userauth> -->
        
        <div class="col-lg-12 m-0 p-0">
            <div class="pull-right p-3">
                <a href="/" class="font fs2 fw3 text-white mx-1">Home</a>
                <a href="/login" class="font fs2 fw3 text-white mx-1">Login</a>
            </div>
        </div>
        <div class="col-lg-12">
         
            @if (\Session::has('login_fail'))
     <p class="text-center text-white font alert" style="background: rgba(255,255,255,.4);">{{ \Session::get('login_fail') }} </p>
            @endif

        </div>
        <div class="col-lg-6 col-md-6 mt-5" id="login-box-119">
            <h1 class="text-center text-white font2 fw6">Welcome to Virtual Laboratory</h1>
            <div class="login-left bg-light" style="">
            <img src="{{asset('vlab-nobg.png')}}" style="width: 80%;">      
            </div>
        </div>
        <div class="col-lg-6 col-md-6 mt-5 pt-5 " id="login-box-120">               

            <div class="p-5 login-right">
                @if (\Session::has('status'))
                    @if (session('status') == 200)
                        <div class="success-msg blur-pos">
                          <i class="fa fa-check"></i>
                          Reset Link has been sent to you e-mail
                        </div>               
                    @else
                    <div class="warning-msg blur-pos">
                          <i class="fa fa-warning"></i>                            
                        {{\Session::get('msg')}}
                        </div>               
                    @endif
                @endif
            <div class="d-flex">
                
                 <p class="font2 fs8 fw6 p-text-dark">Reset Password</p>
                <div  id="login-msg" class="p-0 m-0 d-flex flex-wrap position-relative" >               
                    <span id="login-msg-loader" class="p-display-none">
                        <span>Hi, this will only take a minute</span>
                        <span class="dot-flashing  ml-4"></span>                        
                    </span>
                    <span id="login-msg-success" class="p-display-none">
                        <span class='p-text-success ml-2 tenor-text forLoginMsg' >you have sucessfully logged in</span><span class='ml-5'><img width="10%" class="tenor" src="{{asset('images/tenor.gif')}}"></span>
                    </span>
                </div>
                <div id="login-err" class="mt-3 ml-2 p-display-none">
                    <span class="alert alert-danger forLoginMsg">Invalid username or password</span>
                </div>
                <div id="login-err2" class="mt-3 ml-4 p-display-none ">
                    <span class="alert alert-warning forLoginMsg" >No internet connection...</span>
                </div>
            </div>
             <form id="login-form" action="password/send_link" method="POST">
                @csrf
                <input class="form-control my-3 h2 login-input" required="" autocomplete="off" value="" type="email" name="email" placeholder="Enter email" value="{{request()->get('email')}}">
                <input hidden name="token" placeholder="token" value="{{ csrf_token() }}">                
                <button class="p-dark sys-submit-btn text-white font fs8 fw2 w-100 h2 " type="submit">Reset</button>     
                <div id="resetcont"></div>
            </form>

            </div>
            <br><br><br><br>
        </div>
    </div>
@endsection