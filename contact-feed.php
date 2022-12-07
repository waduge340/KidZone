<?php 
if(isset($_POST["feed-submit"])) {
		$errorMessage = "";
		if (empty ($_POST["Fname"])) {
			$errorMessage = "Please Enter Your Name";
		}
		if (empty ($_POST["Email"])) {
			$errorMessage = "Please Enter Your Email";
		}
		if (empty ($_POST["message"])) {
			$errorMessage = "Please Enter the Message";
		}
		
		if (!empty ($errorMessage)) {
			echo "<script type='text/javascript'>alert('There was a problem with your form. $errorMessage')</script>";
		}
if(isset($_FILES['files'])){
	$errors= array();
	foreach($_FILES['files']['tmp_name'] as $key => $tmp_name ){
		$file_name = $key.$_FILES['files']['name'][$key];
		$file_size =$_FILES['files']['size'][$key];
		$file_tmp =$_FILES['files']['tmp_name'][$key];
		$file_type=$_FILES['files']['type'][$key];	
        if($file_size > 2097152){
			$errors[]='File size must be less than 2 MB';
        }
		$query="INSERT into upload_data ('FILE_NAME','FILE_SIZE','FILE_TYPE') VALUES('$file_name','$file_size','$file_type'); ";
        $desired_dir="F".$_POST["Fname"];
        if(empty($errors)==true){
            if(is_dir($desired_dir)==false){
                mkdir("$desired_dir", 0755);		// Create directory if it does not exist
            }
            if(is_dir("$desired_dir/".$file_name)==false){
                move_uploaded_file($file_tmp,"$desired_dir/".$file_name);
            }else{									// rename the file if another one exist
                $new_dir="$desired_dir/".$file_name.time();
                 rename($file_tmp,$new_dir) ;				
            }
		 mysql_query($query);			
        }
		else
		{
                print_r($errors);
        }	
	}
}
		if((empty($errorMessage)==true) && (empty($errors)==true)){
			$name="F".$_POST['Fname'];
			$my_file = "$name.txt";
			$handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file);
			$data = 'User Name: '.$_POST['Fname']." ".'Email :'.$_POST['Email']." ".'Message: '.$_POST['message'];
			fwrite($handle, $data);
			fclose($handle);
			echo "<script type='text/javascript'>alert('Your Message was submitted successfully! Thank you For Contacting us!')</script>";
		}
			}

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
<link rel="stylesheet" href="css/style.css" type="text/css" />
<link rel="stylesheet" href="css/style2.css" type="text/css" />
<link rel="stylesheet" href="css/formstyle.css" type="text/css" />
<script src="js/modernizr-2.6.2.min.js"></script><!--cir-nav-->
<script src="css/modernizer.cutom.js"></script>
<title>KidZone::Contact</title>
</head>

<body>

<div id="container">
<header>
	<ul  class="head-cont">
    <marquee scrolldelay="360">Hey there! Welcome to KidZone Contact Page!</marquee>
    </ul>

</header>
	<!-- Main Nav Bar Starts--->
	<div class="nav1-container">
    	<div style="position: relative; left: 40%; width: 43%;">
       	<ul class="nav1">
         <li class="nav1"><a href="index.html">&nbsp; Home &nbsp;</a></li>
         <li class="nav1"><a href="news.html">&nbsp;News&nbsp;</a></li>
         <li class="nav1"><a href="gallery.html">Gallery</a></li>
         <li class="nav1"><a href="contact-news.php">Contact</a></li>
         <li class="nav1"><a href="about.html">&nbsp;About&nbsp;</a></li>
		</ul>
        </div>
    </div>
    <!-- Main NAv Bar Ends--->
    
<!-- Share Icons--->
<section class="bb">
<div class='row'>
    <i><a href="https://www.facebook.com/sharer/sharer.php?u="><img src="images/facebook.png"></a></i>
    <i><a href="https://twitter.com/home?status="><img src="images/twitter.png"></a></i>
    <i><a href="https://plus.google.com/share?url="><img src="images/google_plus.png"></a></i>
    <i><a href="https://pinterest.com/pin/create/button/?url=&media=&description="><img src="images/pinterest.png"></a></i>
    <i><a href="https://dribbble.com/"><img src="images/dribbble.png"></a></i>
</div>
</section>
<!-- Share Icons Ends--->
<!-- Side Nav Bar Starts-->    
<aside id="aa">
<div id='row1'>
    	<i><a href="games.html">Games</a></i>
    	<i><a href="activity.html">Activities</a></i>
    	<i><a href="music.html">Music</a></i>
    	<i><a href="story.html">Stories</a></i>
</div>
</aside>
<!-- Side Nan Bar Ends--->

<section class="sec">
<img src="images/contact.png">
</section>

<aside class="new" style="top: 8%; right: 3%; z-index: 1;">
<img src="images/kid-in-blue-circle.png">
</aside>

<div class="wrap col2">
<!------------Image------------>
<aside class="wxy">
<img src="images/share_your_story.png">
</aside>
<aside class="xyz">
<img src="images/Thank-you-pinned-note.png">
</aside>
<aside class="srt">
<img src="images/happykid.png">
</aside>
<aside class="pqr">
<img src="images/KidZone.png" height="249" width="450">
</aside>
<!----------/image------------->
<div class="psst">
<section class="color-1">
<p class="text note-touch">Note that on mobile devices the effects might not all work as intended.</p>
<p>
<button class="btn btn-1 btn-1e" onClick="window.location.href='contact-news.php'" />News</a></button>
<button class="btn btn-1 btn-1e" onClick="window.location.href='contact-feed.php'" />Feedback</a></button>
</p>
</section>
</div>

<div class="container1">
<section class="main">
<form action="" method="POST" enctype="multipart/form-data" class="form-2" style="height: 80%">
<h1><span class="log-in">Give Us Feedback</span></h1>
<p class="float">
<Label>Full Name*</Label>
<input type="text" name="Fname" maxlength="50"></p><br>
<p class="float">
<label>E-mail*</label>
<input type="text" name="Email"></p><br>
<p class="float">
<label>Message*</label>
<textarea rows="10" cols="50" name="message"></textarea></p><br>
<div style="position:static;">
	<input type="submit" name="feed-submit" value="Submit"/>
<input type="reset" name="reset" value="Reset" />
</div>
</form>
</section>
</div>
</div>

<footer>
    <ul  class="mq">
    	<li><a href="index.html">Home</a></li>
        <li><a href="news.html">News</a></li>
        <li><a href="gallery.html">Gallery</a></li>
        <li><a href="contact.html">Contact</a></li>
        <li><a href="about.html">About</a></li>
    </ul>
</footer>   
</div>
</body>
</html>
