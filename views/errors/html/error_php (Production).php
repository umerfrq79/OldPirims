<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">

<title>A PHP Error was encountered</title>
<link id="favicon" rel="icon" href="<?php echo base_url(); ?>uploads/company/DRAP/logo/logo.png"/>
<style type="text/css">

::selection { background-color: #E13300; color: white; }
::-moz-selection { background-color: #E13300; color: white; }

body {
	background-color: #fff;
	margin: 0px;
	font: 13px/20px normal Helvetica, Arial, sans-serif;
	color: #4F5155;
}

a {
	color: #003399;
	background-color: transparent;
	font-weight: normal;
}

h1 {
	color: #f44336;
	background-color: transparent;
	border-bottom: 1px solid #e14236;
	font-size: 19px;
	font-weight: normal;
	margin: 0 0 14px 0;
	padding: 14px 15px 10px 15px;
}

code {
	font-family: Consolas, Monaco, Courier New, Courier, monospace;
	font-size: 12px;
	background-color: #f9f9f9;
	border: 1px solid #D0D0D0;
	color: #002166;
	display: block;
	/*margin: 14px 0 14px 0;
	padding: 12px 10px 12px 10px;*/
}

#container {
	margin: 10px;
	border: 1px solid #e14236;
	box-shadow: 0 0 8px #e14236;
}

p {
	margin: 12px 15px 12px 15px;
}
</style>
<style>
.full-screen {
  background-color: #333333;
  width: 100%;
  height: 100vh;
  color: white;
  font-family: 'Arial Black';
  text-align: center;
}

.container {
  padding-top: 4em;
  width: 50%;
  display: block;
  margin: 0 auto;
}

.error-num {
  font-size: 8em;
}

.eye {
  background: #fff;
  border-radius: 50%;
  display: inline-block;
  height: 100px;
  position: relative;
  width: 100px;
}
.eye::after {
  background: #000;
  border-radius: 50%;
  bottom: 56.1px;
  content: ' ';
  height: 33px;
  position: absolute;
  right: 33px;
  width: 33px;
}

.italic {
  font-style: italic;
}

p {
  margin-bottom: 4em;
}

a {
  color: white;
  text-decoration: none;
  text-transform: uppercase;
}
a:hover {
  color: lightgray;
}
</style>

<script>
  window.console = window.console || function(t) {};
</script>
<script>
  if (document.location.search.match(/type=embed/gi)) {
    window.parent.postMessage("resize", "*");
  }
</script>
</head>
<body>
	<!-- <div id="container">
		<h1><?php echo $heading; ?></h1>
		<?php //echo $message; ?>
		<center><img style="width: 30%; height: auto;" src="<?php echo base_url(); ?>assets/dist/gif/8.gif" class="img-circle" alt="Error"></center>
	</div> -->

	<div class="full-screen">
      <div class='container'>
        <span class="error-num">5</span>
        <div class='eye'></div>
        <div class='eye'></div>

        <p class="sub-text">Oh eyeballs! Something went wrong. We're <span class="italic">looking</span> to see what happened.</p>
        <div id="container">
			<h1>A PHP Error was encountered</h1>
			<?php //echo $message; ?>
			<center><img style="width: 30%; height: auto;" src="<?php echo base_url(); ?>assets/dist/gif/11.gif" class="img-circle" alt="Error"></center>
			<p>Please contact us here: <u><a style="color: #4caf50;" href="<?php echo base_url(); ?>helpdesk">Help Desk</a></u></p>
		</div>
        <a href="<?php echo base_url(); ?>">Go back</a>
      </div>
    </div>
    <script src="https://static.codepen.io/assets/common/stopExecutionOnTimeout-157cd5b220a5c80d4ff8e0e70ac069bffd87a61252088146915e8726e5d9f147.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  
    <script id="rendered-js">
	$(".full-screen").mousemove(function (event) {
	  var eye = $(".eye");
	  var x = eye.offset().left + eye.width() / 2;
	  var y = eye.offset().top + eye.height() / 2;
	  var rad = Math.atan2(event.pageX - x, event.pageY - y);
	  var rot = rad * (180 / Math.PI) * -1 + 180;
	  eye.css({
	    '-webkit-transform': 'rotate(' + rot + 'deg)',
	    '-moz-transform': 'rotate(' + rot + 'deg)',
	    '-ms-transform': 'rotate(' + rot + 'deg)',
	    'transform': 'rotate(' + rot + 'deg)' });

	});
    </script>
</body>
</html>