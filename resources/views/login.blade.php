@extends('layouts/main-login')
@section('content-body')
<div class="content row m-0 p-0" style="position: relative;z-index:100; height:100%">
	<!-- <v-userauth></v-userauth> -->

	
	@if (\Session::has('login_fail'))
	<div class="col-lg-12">
		<p class="text-center text-white font alert" style="background: rgba(255,255,255,.4);">{{ \Session::get('login_fail') }} </p>
	</div>
	@endif
	<div class="col-lg-6 col-md-6 login-box-119 justify-content-center " id="login-box-119" >
		<span class="login-left-cont">

			<h1 class='console-container text-center text-primary font2 fw6 display-flex'><span id='textAnim'></span><div class='console-underscore' id='console'>&#95;</div></h1>
		<!-- <h1 class="text-center text-white font2 fw6">Welcome to Virtual Laboratory</h1> -->
			<div class="login-left">
				<img src="{{asset('vlab-nobg.png')}}" style="width: 80%;">
			</div>
		</span>
	</div>
	<div class="col-lg-6 col-md-6 mt-5 pt-5 login-box-120 " id="login-box-120">
	<div class="col-lg-12 m-0 p-0">
		<div class="p-3">
			<a href="/" class="font fs2 fw3 text-white mx-1">Home</a>
			<!-- <a href="/login" class="font fs2 fw3 text-white mx-1">Login</a> -->
		</div>
	</div>
		<div class="p-5 login-right">

			<div class="d-flex">

				<p class="font2 fs8 fw6 text-white">Login</p>
				<div id="login-msg" class="p-0 m-0 d-flex flex-wrap position-relative">
					<span id="login-msg-loader" class="p-display-none text-white">
						<span>Hi, this will only take a minute</span>
						<span class="dot-flashing  ml-4"></span>
					</span>
					<div id="login-msg-success" class=" alert p-1 p-display-none ">
						<p style="color: white; padding: 2px 5px !important; border-radius: 4px;" class=' ml-2 tenor-text forLoginMsg'>you have sucessfully logged in</p>
						<svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
							<circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" />
							<path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" />
						</svg>
					</div>
					</span>
				</div>
				<div id="login-err" class="mt-3 ml-2 p-display-none">
					<span class="alert alert-danger forLoginMsg">Invalid username or password</span>
				</div>
				<div id="login-err2" class="mt-3 ml-4 p-display-none ">
					<span class="alert alert-warning forLoginMsg">No internet connection...</span>
				</div>
			</div>
			<form id="login-form">
				<input type="text" placeholder="Email or Matric Number" id="username" class="form-control my-3 h2 login-input" name="username">
				<div class="position-relative">
					<input type="password" placeholder="Password" id="password" class="form-control my-3 h2 login-input" name="password">
					<span id="togglePwDisplay" style="user-select: none;cursor: pointer;position:absolute; top: 28%;right: 6%;" class="p-text-dark">show</span>
				</div>
				<!-- HTML !-->
				<button class="button-36 text-white font fs8 fw2 w-100 h2" type="button" id="login-btn">Login</button>
				<div class=" text-center fs2 fw3"><a id="forgot_password" class="text-white" href="/forgot_password">Forgot Password?</a></div>
			</form>
			<form id="auto-redirect" action="/proccess-login" method="post">
				{{csrf_field()}}
				<input type="text" class="p-display-none" name="data" id="response-data">
			</form>
			<v-loginscript></v-loginscript>
		</div>
		<br><br><br><br>
	</div>
</div>
<div class="area">
	<ul class="circles">
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
	</ul>
</div>
@endsection
<style>
	.pos-expand{
		width: 100;
	}
	.pos-shift{
		position: absolute !important;
		height: 100%;
    	left: -809px !important;
	}
	#bottomElements{
		position: fixed;
		bottom: 5px;
	}
	div#app.container-fluid{
		padding: 0px;
	}
	.area {
		background: #4e54c8;
		background: -webkit-linear-gradient(to left, #8f94fb, #4e54c8);


	}

	.circles {
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		overflow: hidden;
	}

	.circles li {
		position: absolute;
		display: block;
		list-style: none;
		width: 20px;
		height: 20px;
		background: rgba(255, 255, 255, 0.2);
		animation: animate 25s linear infinite;
		bottom: -150px;

	}

	.circles li:nth-child(1) {
		left: 25%;
		width: 80px;
		height: 80px;
		animation-delay: 0s;
	}


	.circles li:nth-child(2) {
		left: 10%;
		width: 20px;
		height: 20px;
		animation-delay: 2s;
		animation-duration: 12s;
	}

	.circles li:nth-child(3) {
		left: 70%;
		width: 20px;
		height: 20px;
		animation-delay: 4s;
	}

	.circles li:nth-child(4) {
		left: 40%;
		width: 60px;
		height: 60px;
		animation-delay: 0s;
		animation-duration: 18s;
	}

	.circles li:nth-child(5) {
		left: 65%;
		width: 20px;
		height: 20px;
		animation-delay: 0s;
	}

	.circles li:nth-child(6) {
		left: 75%;
		width: 110px;
		height: 110px;
		animation-delay: 3s;
	}

	.circles li:nth-child(7) {
		left: 35%;
		width: 150px;
		height: 150px;
		animation-delay: 7s;
	}

	.circles li:nth-child(8) {
		left: 50%;
		width: 25px;
		height: 25px;
		animation-delay: 15s;
		animation-duration: 45s;
	}

	.circles li:nth-child(9) {
		left: 20%;
		width: 15px;
		height: 15px;
		animation-delay: 2s;
		animation-duration: 35s;
	}

	.circles li:nth-child(10) {
		left: 85%;
		width: 150px;
		height: 150px;
		animation-delay: 0s;
		animation-duration: 11s;
	}



	@keyframes animate {

		0% {
			transform: translateY(0) rotate(0deg);
			opacity: 1;
			border-radius: 0;
		}

		100% {
			transform: translateY(-1000px) rotate(720deg);
			opacity: 0;
			border-radius: 50%;
		}

	}

	/* success anim */
	.checkmark__circle {
		stroke-dasharray: 166;
		stroke-dashoffset: 166;
		stroke-width: 2;
		stroke-miterlimit: 10;
		stroke: #8ada4b;
		fill: none;
		animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards infinite
	}

	.checkmark {
		width: 56px;
		height: 56px;
		border-radius: 50%;
		display: block;
		stroke-width: 2;
		stroke: #fff;
		stroke-miterlimit: 10;
		margin: 10% auto;
		box-shadow: inset 0px 0px 0px #8ada4b;
		position: relative;
		left: 214px !important;
		z-index: 10;
		background-color: white !important;
		animation: fill .4s ease-in-out .4s forwards, scale .3s ease-in-out .9s both
	}

	.checkmark__check {
		transform-origin: 50% 50%;
		stroke-dasharray: 48;
		stroke-dashoffset: 48;
		animation: stroke 0.9s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards infinite
	}

	@keyframes stroke {
		100% {
			stroke-dashoffset: 0
		}
	}

	@keyframes scale {

		0%,
		100% {
			transform: none
		}

		50% {
			transform: scale3d(1.1, 1.1, 1)
		}
	}

	@keyframes fill {
		100% {
			box-shadow: inset 0px 0px 0px 30px #8ada4b
		}
	}

	/* CSS */
	.button-36 {
		background-image: linear-gradient(92.88deg, #455EB5 9.16%, #5643CC 43.89%, #673FD7 64.72%);
		border-radius: 8px;
		border-style: none;
		box-sizing: border-box;
		color: #FFFFFF;
		cursor: pointer;
		flex-shrink: 0;
		font-family: "Inter UI", "SF Pro Display", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
		font-size: 16px;
		font-weight: 500;
		height: 4rem;
		padding: 0 1.6rem;
		text-align: center;
		text-shadow: rgba(0, 0, 0, 0.25) 0 3px 8px;
		transition: all .5s;
		user-select: none;
		-webkit-user-select: none;
		touch-action: manipulation;
	}

	.button-36:hover {
		box-shadow: rgba(80, 63, 205, 0.5) 0 1px 30px;
		transition-duration: .1s;
	}

	@media (min-width: 768px) {
		.button-36 {
			padding: 0 2.6rem;
		}
	}

	a#forgot_password {
		text-decoration: none;
	}

	a#forgot_password:hover {
		color: white !important;
		text-decoration: underline;
	}

	console-container {

		/* font-family: Khula;
		font-size: 4em;
		text-align: center;
		height: 200px;
		width: 600px;
		display: block;
		position: absolute;
		color: white;
		top: 0;
		bottom: 0;
		left: 0;
		right: 0;
		margin: auto; */
	}

	.console-underscore {
		display: inline-block;
		position: relative;
		top: -0.14em;
		left: 10px; 
	}
</style>