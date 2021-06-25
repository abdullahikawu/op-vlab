@component('mail::message')  	
		<h4>Reset Password</h4>    
		<p>Use the below link to Reset Your Password</p>        
		<br>      
		<center>  			
		<a href="{{$url}}" style="text-decoration: none; color: white;padding: 10px 20px;text-align: center;background: #333;border-radius: 5px; margin: 15px auto;">
			Password Reset Link			
		</a>
		</center>  
		<br>      	
		Sincerely,  
		Vlab Nigeria.	
@endcomponent
