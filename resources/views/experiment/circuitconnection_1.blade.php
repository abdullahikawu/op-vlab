<?php
$tools = 5;
$time_default = true;
if(Session::has('time_left')){
    $time_left = session('time_left');
    $time_default = false;
}

if ($time_default) {
   $time_left = [
      'hour'=>1,
      'minute'=>30
   ];
}
$access_code = session('access_code');
$user_type = session('user_type');
?>
@extends('layouts/main')

@section('head')
<script src="{{ asset('js/jquery-1.11.3.min.js')}}"></script>

    <script src="{{ asset('js/jsplumb.js')}}"></script>
    <script src="{{ asset('js/jsplumb_list.js')}}"></script>
    <script src="{{ asset('js/plotly-latest.min.js')}}"></script>
    <script src="{{ asset('js/gauge.min.js')}}"></script>
    <script src="{{ asset('js/jquery.ui.js')}}"></script>

@endsection
@section('content-body')
<div class="d-flex">   
  <!-- <v-userauth></v-userauth> -->
   <v-msidebar class='vh-100' home="{{route('home')}}" explore="{{route('explore')}}" settings="{{route('home')}}" mycourse="{{route('my-course-review')}}" courses="{{route('courses')}}" incourse="1" active="courses"  ></v-msidebar>   
  	 
   <!-- end main side bar -->

   <div class="w-100 vh-100 position-relative">
         <!-- top nav bar -->
         <v-topnave equipmentname="Photovoltaic Experiment 1" experimentnum='Series & Parallel Connection'></v-topnave>
         <!-- end to nav bar -->

         <!-- content -->
         <div class="exp-cont-view">

            <!-- experiment left side bar -->
             <v-guide aim="<h2>This is Aim</h2>" aparatus="<h2>This is aparatus</h2>" theory="<h2>This is theory</h2>" requirment="" exercise="<h2>exercises comes here</h2>" resources="<h2>No resources Available for this experiment</h2>" ></v-guide>    
               <!--<guide :control="control"></guide>    -->
            <!-- end experiment side bar -->

       			<!-- experiment  -->
   			    <div id="mainExp">
               <v-ribbon></v-ribbon>
               <v-circuitconnection1 style="display: none;" id="experimentSheet"></v-circuitconnection1>
               <v-start access_code="{{$access_code}}" user_type="{{$user_type}}" hourdata="{{$time_left[0]}}" munitedata="{{$time_left[1]}}"></v-start>
   			    </div>
   			    <!-- end experiment -->

            <div  class="zero-space exprightNav" id="rightNav">       
               <v-rightnav class="vh-2" :toolsizes=false :vicelab=true   url="{{route('circuitconnection1')}}" ></v-rightnav>
            </div>

       			<!-- experiment footer -->
       			<div class="position-absolute bottom-0 w-100" style="">
       		   <v-expfooter></v-expfooter>
       			</div>
       			<!-- end experiment footer -->

   		</div>
   </div>


</div>

@endsection