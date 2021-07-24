<!DOCTYPE html>
<html lang="en">
  <head>    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/1.1.9/p5.js"></script>    
    
    <script src="{{ asset('js/jquery-1.11.3.min.js')}}"></script>
    
    <link rel="stylesheet" type="text/css" href="{{ asset('experiments/equilibrium/style.css')}}">
    <meta charset="utf-8" />

  </head>
  <body>    
    <span style="width: 100%;" id="forLoader">    
    <!-- <div class="cover"></div>
    <div class="lds-ripple" id="exploader"><div></div><div></div></div>
      <script src="{{ asset('experiments/pendulum/sketch.js')}}"></script> -->
  </span>
    <script src="{{ asset('experiments/equilibrium/sketch.js')}}"></script>
    <script src="{{ asset('experiments/equilibrium/Ruler.js')}}"></script>
    <script src="{{ asset('experiments/equilibrium/pivot.js')}}"></script>
    <script type="text/javascript">
      $(document).ready(function () {
        $('#forLoader').hide();
      })
    </script>
  </body>
</html>
