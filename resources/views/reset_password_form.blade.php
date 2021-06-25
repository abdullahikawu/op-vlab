@extends('layouts/main-login')
@section('head')
    <script src="{{ asset('js/jquery-1.11.3.min.js')}}"></script>
    <script>
        $(document).ready(function(){

         $('.togglePwDisplayc').click(function(){
                    var contX = $(this).text();
                    if (contX==='show') {
                        $(this).prev().attr('type','text');
                        $(this).text('hide')
                    }else if(contX === 'hide'){
                        $(this).prev().attr('type','password');                        
                        $(this).text('show');                        
                    }
                });

         
         $('#password').keyup(function(){
            if($(this).val() == ''){
                $('#resetcont').html('<span class="text-danger fs1 font">password field cannot be empty</span>');
            }else{             
                if ($('#cpassword').val() == $(this).val()) {
                    $('#resetcont').html(`
                        <span class="w-100 p-text-success">password matched</span>
                        <button class="p-dark sys-submit-btn text-white font fs8 fw2 w-100 h2 " type="submit">Reset</button>`);
                }else{
                    $('#resetcont').html('<span class="text-danger fs1 font">password mismatch</span>');
                }                
            }
         });
         $('#cpassword').keyup(function(){
            if($(this).val() == ''){
                $('#resetcont').html('<span class="text-danger fs1 font">password field cannot be empty</span>');
            }else{
                if ($('#password').val() == $(this).val()) {
                    $('#resetcont').html(`
                        <span class="w-100 p-text-success">password matched</span>
                        <button class="p-dark sys-submit-btn text-white font fs8 fw2 w-100 h2 " type="submit">Reset</button>`);
                }else{
                    $('#resetcont').html('<span class="text-danger fs1 font">password mismatch</span>');
                }            
            }
         })
                
        })
    </script>
@endsection
@section('content-body')
    <div class="content row m-0 p-0">
    <!-- <v-userauth></v-userauth> -->
        
        <div class="col-lg-12 m-0 p-0">
            {{session('msg')}}
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
                          {{session('msg')}}
                        </div>               
                    @elseif(session('status')== 400)   
                        <div class="warning-msg blur-pos">
                          <i class="fa fa-warning"></i>                            
                          {{session('msg')}}
                        </div>               
                    @elseif(session('status')== 409)     
                    <div class="error-msg blur-pos">
                          <i class="fa fa-fa-times-circle"></i>                            
                          {{session('msg')}}
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
             <form id="login-form" action="{{route('resetPassword')}}" method="POST">
                <div class="position-relative">                    
                <input class="form-control my-3 h2 login-input" required="" min="8" max="12" id="password" autocomplete="off" type="password" name="password" placeholder="Enter new password">
                 <span  style="user-select: none;cursor: pointer;position:absolute; top: 28%;right: 6%;" class="p-text-dark togglePwDisplayc">show</span>
                </div>
                <div class="position-relative">                    
                <input class="form-control my-3 h2 login-input" required="" min="8" max="12" id="cpassword" autocomplete="off" type="password" name="password_confirmation" placeholder="Confirm new password">                 
                 <span  style="user-select: none;cursor: pointer;position:absolute; top: 28%;right: 6%;" class="p-text-dark togglePwDisplayc">show</span>
                </div>                
                <input hidden name="token" value="{{ request()->token_p }}">              
                <div id="resetcont"></div>
            </form>

            </div>
            <br><br><br><br>
        </div>
    </div>
@endsection