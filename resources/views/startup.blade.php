<?php
$url = request()->server('HTTP_HOST');
?>
<!DOCTYPE html>
<html>
<head>
	<title>terms and conditions</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	@include('layouts.head')
</head>
<body class="container">
	<center>
		<br>	
	<iframe src="#" scrolling="none" class="w-75 p-display-none" id="iframe" style="border: none;height: 100px;">
		<div class="loader"></div>
	</iframe>	
	<br>
	<br>
		<h1>Privacy Policy</h1>
	</center>
	<p>	
	This Privacy Policy describes Our policies and procedures on the collection, use and disclosure of Your information when You use the Service and tells You about Your privacy rights and how the law protects You.
	</p>
	<h3>	
		Types of Data Collected
	</h3>
	<p>	
	<b>	Metadata</b><br>
	While using Our Service, we will be automatically getting your data summary information that can be used to analysize the usage of the service
	</p>
	<h3>Contact Us</h3>
	<p>	
	If you have any questions about this Privacy Policy, You can contact us:
	By email: saidabdulsalam5@gmail.com
	</p>
	<center>		
		<a id="accept" href="#" class="btn btn-dark d-flex flex-wrap" style="justify-content: center; width: 120px;"><span class="text-center">Accept</span><span class="loader p-display-none ml-2" style="width: 30px;height: 30px;border: 6px solid #f3f3f3;  border-top:6px solid #3498db;"></span></a>										<form method="POST" id="submitform" action="/startup-completed">				
				@csrf
				<input type="hidden" name="nut">
			</form>	
	</center>
	<script>
		$('#accept').click(function(){
			$('.loader').addClass('d-inline-block');
			$('#iframe').show();
			$('#iframe').attr('src', "https://vlabnigeria.org/acceptance.php?url={{$url}}");
		});
		var loadcount = 0;
		$('#iframe').load(function(){
			if(loadcount !=0){
				$('#submitform').submit();				
			}
			loadcount++;
		});
	</script>
</body>
</html>
