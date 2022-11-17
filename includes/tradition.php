<?php 			
	include("includes/top.php");				
	if(isset($_POST['sub']))
	{
		$selected = mysql_select_db("dbmaheshwaries", $dbhandle) or die("Could not select database");	
	
		@$username=$_POST['username'];
		@$password=$_POST['password'];

		$sql = "select * from panel where username='".$username."' and password='".$password."'";
		$result = mysql_query($sql,$dbhandle);
		$records = mysql_num_rows($result);
		$row = mysql_fetch_array($result);
		echo $records;
		if($records){
			session_start();
			$_SESSION['info']=$row;
			print_r($_SESSION);
			header('Location:panel.php');
		}
		else
		{
			echo '<script type="text/javascript">alert("Wrong UserName or Password");window.location=\'index.php\';</script>';
		}	 							
	}			
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Maheshwaries</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="description" content="" />
<meta name="author" content="http://bootstraptaste.com" />
<!-- css -->
<link href="css/bootstrap.min.css" rel="stylesheet" />
<link href="css/fancybox/jquery.fancybox.css" rel="stylesheet">
<link href="css/jcarousel.css" rel="stylesheet" />
<link href="css/flexslider.css" rel="stylesheet" />
<link href="css/style.css" rel="stylesheet" />


<!-- Theme skin -->
<link href="skins/default.css" rel="stylesheet" />

<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    
<!-- TinyMCE -->
<script src="tiny_mce/tiny_mce.js" type="text/javascript"></script>
    <script type="text/javascript">
        tinyMCE.init({
			
			mode: "exact",
            elements: "elm1",


            content_css: "mycontent.css",
            style_formats: [
         { title: 'LineHeight' },
            { title: '100%', selector: 'p,div,h1,h2,h3,h4,h5,h6,ul,table,tr,td', styles: { lineHeight: '100%', 'marginTop': '0', 'marginBottom': '0'} },
            { title: '120%', selector: 'p,div,h1,h2,h3,h4,h5,h6,ul,table,tr,td', styles: { lineHeight: '120%', 'marginTop': '0', 'marginBottom': '0'} },
            { title: '150%', selector: 'p,div,h1,h2,h3,h4,h5,h6,ul,table,tr,td', styles: { lineHeight: '150%', 'marginTop': '0', 'marginBottom': '0'} },
            { title: '180%', selector: 'p,div,h1,h2,h3,h4,h5,h6,ul,table,tr,td', styles: { lineHeight: '180%', 'marginTop': '0', 'marginBottom': '0'} },
            { title: '200%', selector: 'p,div,h1,h2,h3,h4,h5,h6,ul,table,tr,td', styles: { lineHeight: '200%', 'marginTop': '0', 'marginBottom': '0'} },
        { title: 'Fancy Bullets' },
            { title: 'Bullets', block: 'li', classes: 'bullet1' },
            { title: 'Bullets2', block: 'li', classes: 'bullet2' },
            { title: 'Bullets3', block: 'li', classes: 'bullet3' },
            { title: 'Bullets4', block: 'li', classes: 'bullet4' },
            { title: 'Bullets5', block: 'li', classes: 'bullet5' },
            { title: 'Bullets6', block: 'li', classes: 'bullet6' },
        { title: 'Borders' },
            { title: 'Dashed', selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img,td,th,span', classes: 'borderdashed' },
            { title: 'Dotted', selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img,td,th,span', classes: 'borderdotted' },
            { title: 'Double', selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img,td,th,span', classes: 'borderdouble' },
            { title: 'Solid', selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img,td,th,span', classes: 'bordersolid' },
            { title: 'Collapse', selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img,td,th,span', classes: 'bordercollapse' },
            { title: 'Navy Border', selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img,td,th,span', classes: 'bordercolor' }
            ],


            // General options
            theme: "advanced",
            skin: "o2k7",
            plugins: "ccSimpleUploader,autolink,lists,pramukhime,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",

            // Theme options
            theme_advanced_buttons1: "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,pramukhime,fontselect,fontsizeselect",
            theme_advanced_buttons2: "cut,copy,paste,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,forecolor,backcolor",
            theme_advanced_buttons3: "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,advhr,|,ltr,rtl,|,styleselect",
            theme_advanced_toolbar_location: "top",
            theme_advanced_toolbar_align: "left",
            theme_advanced_statusbar_location: "bottom",
            theme_advanced_resizing: true,

            relative_urls: false,
            file_browser_callback: "ccSimpleUploader",
            plugin_ccSimpleUploader_upload_path: '../../../../userdata/datafiles/',
            plugin_ccSimpleUploader_upload_substitute_path: '/userdata/datafiles/',


            // Drop lists for link/image/media/template dialogs
            template_external_list_url: "lists/template_list.js",
            external_link_list_url: "lists/link_list.js",
            external_image_list_url: "lists/image_list.js",
            media_external_list_url: "lists/media_list.js",

            // Replace values for the template plugin
            template_replace_values: {
                username: "admin",
                staffid: "991234"
            }
        });
    </script>
    <!-- /TinyMCE -->  
</head>
<body>
<div id="wrapper">
	<!-- start header -->
	<header>
        <div class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php"><span>Mahesh</span>waries</a>
                </div>
                <div class="navbar-collapse collapse ">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="index.php">Home</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle " data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false">Raisinghnagar <b class=" icon-angle-down"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="samiti.php">Sewa Samiti</a></li>
                                <li><a href="ysamiti.php">Yuva Sewa Samiti</a></li>
								<li><a href="families.php">Families</a></li>
                                <li><a href="member.php">Unmarried</a></li>
                            </ul>
                        </li>
                        <li><a href="gallery.php">Gallery</a></li>
                        <li><a href="services.php">Services</a></li>
                        <li><a href="blog.php">Blog</a></li>
                        <li><a href="contact.php">Contact</a></li>
                    </ul>
                </div>
            </div>
        </div>
	</header>
	<!-- end header -->
	<section id="featured">
	<!-- start slider -->
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
	<!-- Slider -->
        <div id="main-slider" class="flexslider">
            <ul class="slides">
              <li>
                <img src="img/slides/slide1.png" alt="" />
                <div class="flex-caption">
                    <h3>Who we are</h3> 
					<p>We are called Maheshwaris taking the name from Lord Mahesh or Lord Shiva. Seventy two surnames (khaps) formed the primary Maheshwari list of surnames.</p> 
					<!--<a href="#" class="btn btn-theme">Know More</a>-->
                </div>
              </li>
              <li>      <img src="img/slides/slide2.png" alt="" />           </li>
              <li>      <img src="img/slides/slide3.png" alt="" />           </li>
              <li>      <img src="img/slides/slide4.png" alt="" />           </li>
              <li>      <img src="img/slides/slide5.png" alt="" />           </li>
            </ul>
        </div>
	<!-- end slider -->
			</div>
		</div>
	</div>
	</section>
    