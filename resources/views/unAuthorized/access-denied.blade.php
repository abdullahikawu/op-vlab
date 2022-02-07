@extends('layouts/main')

@section('content-body')
<div class="w-80 bordered bg-danger p-5">
	<h1 class="text-white">Access Denied</h1>
	<p class="text-white font"><i>Sorry The page you tried to open is no available for mobile device</i>...</p>
	<center>
		<a href="{{url()->previous()}}" class="btn btn-warning text-white">Back <span class="fa fa-cadet-left"></span></a>
	</center>
</div>
@endsection