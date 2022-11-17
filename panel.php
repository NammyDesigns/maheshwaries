<?php
	session_start();
	if(!$_SESSION['info']['id'])
	{
		session_destroy();
		header('Location:index.php');								
		exit();
	}	
?>
<body>
<div class="main">
   <?php	
   		include("includes/header.php");
   		include("includes/top.php");
   ?>
	<div class="content">
     <div class="content_resize">
      <div class="mainbar">
        <div class="article">
          <h2><span>Admin</span> Panel</h2>
		  <h4 style="float:right"><a href="index.php">Logout</a></h4>
          <div class="clr"></div>
		  <div class="post_content">	
		  	<center>
				  <form method="post" action="" id="panel">
					<label id="pagename"> Select Page Name </label><br>
						<select name="name" id="name" onChange="if(this.value) window.location.href='panel.php?id='+this.value;">
						<option >Select Page</option>				  					
						<?php			
							//select a database to work with
							$selected = mysql_select_db("dbmaheshwaries",$dbhandle) or die("Could not select Maheshwaries Database");
							
							echo"Welcome ".$_SESSION['info'][1];			
							$qry="select name,matter,title from config";
							$ros=mysql_query($qry,$dbhandle) or die(mysql_error());
							while($row = mysql_fetch_assoc($ros))
							{
								$selected="";
								if($_GET['id']==$row['name'])
								{
									$selected="selected";
								}
						?>
						<option value="<?=$row['name']?>" <?=$selected?>><?=$row['title']?></option>
						<?php
								$rows[]=$row;
							}
							
							if(isset($_GET['id']))
							{	
								$qry="select matter from config where name='".$_GET['id']."'";
								$ros=mysql_query($qry,$dbhandle) or die(mysql_error());
								$row = mysql_fetch_array($ros);
								//print_r($row);
								$pagedata =$row[0];							
							}
						?>	
						</select>  	<br>
						<textarea runat="server" id="elm1" name="elm1" rows="20" cols="20" style="width: 20%;" class="tinymce"><?=$pagedata?> </textarea><br>
						<input type="submit" name="submi"  />
					<?php						
						if(isset($_POST['submi']))
						{						
							mysql_query("update config set matter='".$_POST['elm1']."' where name='".$_POST['name']."'");
							echo '<script type="text/javascript">alert("Data Updated Successfully");</script>';
						}
					?>					
				</form>
				</center></div>
			</div>
		</div> 
		<div class="clr"></div>        
    </div>
  </div>
  <?php include("includes/footer.php");	?>
</body>
</html>