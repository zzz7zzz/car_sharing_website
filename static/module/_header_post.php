<!-- Post_Header -->
<!-- 
Includes: 
Logo
Welcome Back + User Email
Logout
-->

<style type = "text/css">
	#post_header {
  		width:100%;
  		height:58px;
  		background: #4d4d4d;
	}
	#post_logo{
		float:left;
		width:50%;
		color:white;
		font-size: 24px;
		font-family: 'pt_sansregular';
		font-weight:bold;
		margin-top:12px;
	}
	#post_login {
		float:right;
		width:50%;
		padding: 20px 0 0 0;
		font-family: 'pt_sansregular';
		margin-right:-40px;

		}
	#post_login span {
		float: left;
		padding-top:2px;
		font-size:13px;
		font-family: 'pt_sansregular';
		margin-left:30px;
		color: white;
		}
	#post_login a {
		font-family: 'pt_sansregular';
	}
	.ph_button {
		display: inline-block;
		position: relative;
		font: 11px 'pt_sansregular';
		color: white;
		padding: 0;
		float: left;
		text-align: center;
		border-radius: 3px;
		cursor: pointer;
		border: 1px;
		border-radius:2px;
		background: #FFE9B2;
/* 
		background-image: -webkit-linear-gradient(top, #ff0000, #5e0114);
		background-image: -moz-linear-gradient(top, #ff0000, #5e0114);
		background-image: -ms-linear-gradient(top, #ff0000, #5e0114);
		background-image: -o-linear-gradient(top, #ff0000, #5e0114);
 */
		background-image: linear-gradient(to bottom, #red, #590d0d);
		-webkit-border-radius: 28;
		-moz-border-radius: 28;
		color:#fff;
		text-shadow:#C17C3A 0 -1px 0;
		height:15px;
		width:60px;
		padding: 2px 10px;
		margin: 0px 0px 0px 10px;
		
/* 
		-webkit-box-shadow:rgba(0,0,0,0.2) 0 1px 0 0;
		-moz-box-shadow:rgba(0,0,0,0.2) 0 1px 0 0;
		box-shadow:rgba(0,0,0,0.2) 0 1px 0 0;
		background-color:#FA2;
 */
		
		-webkit-box-shadow:rgba(0,0,0,0.2) 0 1px 0 0;
		-moz-box-shadow:rgba(0,0,0,0.2) 0 1px 0 0;
		box-shadow:rgba(0,0,0,0.2) 0 1px 0 0;
		color:#333;
		background-color:#FA2;
		text-shadow:#FE6 0 1px 0;
	}

	.ph_button:hover {
		background: #820a2a;
		text-shadow: none;
/* 
		background-image: -webkit-linear-gradient(top, #ff0000, #590d0d);
		background-image: -moz-linear-gradient(top, #ff0000, #590d0d);
		background-image: -ms-linear-gradient(top, #ff0000, #590d0d);
		background-image: -o-linear-gradient(top, #ff0000, #590d0d);

		background-image: linear-gradient(to bottom, #ff0000, #590d0d);
 */
		text-decoration: none;
		color: white;
	}



</style>
<div id="post_header">
	<div class = "fixed-width-centered">
		<div id = "post_logo">
      		RoadBuds
    	</div>
		<div id= "post_login">
			<span>Welcome back,&nbsp;<?php echo 
				$_SESSION['givenname'].' '.$_SESSION['familyname']; ?>!</span>
			<a class = "ph_button" type="button" onClick="window.location='index.php';"/><i class="fa fa-sign-in fa-fw"></i>&nbsp;Search &nbsp;</a>
			<a class = "ph_button" type="button" onClick="window.location='settings.php';"/><i class="fa fa-sign-in fa-fw"></i>&nbsp;Settings &nbsp;</a>
			<a class = "ph_button" type="button" onClick="window.location='app/logout.php';"/><i class="fa fa-sign-in fa-fw"></i>&nbsp;Log Out &nbsp;</a>
		</div>
		<div style="clear: both;"></div>
	</div>
</div>

