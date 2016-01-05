<style type="text/css">

.slogan {
  margin-left:0%;
  height:280px;
  width:45%;
  color:white;
  float:left;
  background: rgba(0,0,0, 0.6);
  margin-right:10%;
  margin-left:6%;
  font-size: 24px;
  font-family: 'pt_sansregular';
  text-align: center;
  padding-top:80px;
  margin-top:105px;
  border-radius:50px;
  line-height:35px;
  /*background-image: url('static/img/homepage.jpg') !important; 
  background-size:100%;*/
  /*background-color:black;*/
}
.register{
  /*height:100%;*/
  display: inline-block;
  width:30%;
  float: left;
  color:#A61024;
  font-size:10px;
  font-family: arial;
  font-weight: bold;
  margin-top:80px;
  margin-left:0%;
  margin-bottom:200px;
  height:350px;
  padding-top:50px;
  padding-left: 30px;
  /*background-color:black;*/
  background: rgba(255, 255, 255, 0.1);
}
.sign_up_button {
    display: inline-block;
    position: relative;
    background: white;
    font-size: 16px;
    font-family: 'pt_sansregular';
    color: black;
    padding: 0;
    float: left;
    text-align: center;
    border-radius: 3px;
    cursor: pointer;
    border: 1px;
    color: #555;
    /*margin-top:4px;*/
    width:250px;
    height:35px;
    margin-top:10px;
    margin-right:0px;
    background: #ff0000;
    background-image: -webkit-linear-gradient(top, #ff0000, #5e0114);
    background-image: -moz-linear-gradient(top, #ff0000, #5e0114);
    background-image: -ms-linear-gradient(top, #ff0000, #5e0114);
    background-image: -o-linear-gradient(top, #ff0000, #5e0114);
    background-image: linear-gradient(to bottom, #ff0000, #5e0114);
    -webkit-border-radius: 28;
    -moz-border-radius: 28;
    color: white;
    border-radius:2px;
    /*padding: 3px 3px;
    margin: 15px 0px 0px 6px;*/
  }
  .sign_up_button:hover {
    background: #820a2a;
    background-image: -webkit-linear-gradient(top, #820a2a, #590d0d);
    background-image: -moz-linear-gradient(top, #820a2a, #590d0d);
    background-image: -ms-linear-gradient(top, #820a2a, #590d0d);
    background-image: -o-linear-gradient(top, #820a2a, #590d0d);
    background-image: linear-gradient(to bottom, #820a2a, #590d0d);
    text-decoration: none;
  }
  .type_ddl{
    display: inline-block;
    position: relative;
    background: white;
    font: 12px Arial;
    color: black;
    padding: 0;
    float: left;
    text-align: center;
    border-radius: 3px;
    cursor: pointer;
    border: 1px solid #ccc;
    background: #eee;
    color: #555;

    /*margin-top:4px;*/
    width:250px;
    height:20px;
    margin-top:5px;
    margin-left:7px;
    /*padding: 3px 3px;
    margin: 15px 0px 0px 6px;*/
  }
  .error_strings{
    width:230px;
    height:15px;
    position: relative;
    float: left;
    margin-left: 7px;
  }
  #sampleMovie {
    position: absolute;
    top: 0;
    left: 0;
    width: 120%;
    height: 120%;
    margin-left: -150px;
    z-index: -1;
  }
</style>

<video id="sampleMovie" preload autoplay loop>
  <source src="/kaj1125/static/img/global.mp4" type="video/mp4">
</video>

<div class = "home">

<div class = "fixed-width-centered">
  <div class = "slogan">
  Current <span style="color: rgb(255, 0, 0);">college student? </span><br>
  Looking for <span style="color: rgb(255, 0, 0);">transportation?</span> <br>
  Or willing to <span style="color: rgb(255, 0, 0);">offer</span> a ride? <br>
  Sign up with your college Email<br>
  And we will find you a match. 
  </div>  
  <div class="register">
    <form action="app/register.php" method = 'POST' name="myform">
      <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
        <input class="form-control-signup" type="text" name="email" placeholder="*@u.rochester.edu" size="13" maxlength="40" value="" />
      </div>
      <div id='myform_email_errorloc' class="error_strings"></div>
      <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
        <input class="form-control-signup" type="text" name="givenname" placeholder="*Given Name" size="13" maxlength="40" value="" />
      </div>
      <div id='myform_givenname_errorloc' class="error_strings"></div>
      <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
        <input class="form-control-signup" type="text" name="familyname" placeholder="*Family Name" size="13" maxlength="40" value="" />
      </div>
      <div id='myform_familyname_errorloc' class="error_strings"></div>
      <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
        <input class="form-control-signup" type="password" placeholder="*Password" name="password" size="13" maxlength="100" />
      </div>
      <div id='myform_password_errorloc' class="error_strings"></div>
      <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
        <input class="form-control-signup" type="password" placeholder="*Confirm Password" name="re-password" size="13" maxlength="100" />
      </div>
      <div id='myform_re-password_errorloc' class="error_strings"></div>
<!--       <select class = "type_ddl" name='type'><option value="1">Driver</option><option value="2">Rider</option></select> -->
      <div class="input-group">
        <input class = "sign_up_button" type = "submit" value = "Sign Up" />
      </div>
            <!-- <a class="button2 toolbar-button" onclick="document.signUpForm.submit()"><i class="fa fa-user"></i> Sign Up </a> -->
      <!-- <div><p>*Compulsory</p></div> -->
    </form>
  </div>
  <div style="clear: both;"></div>
</div>
</div>

<script language="JavaScript" type="text/javascript" xml:space="preserve">
    //You should create the validator only after the definition of the HTML form
    var frmvalidator  = new Validator("myform");
    frmvalidator.EnableOnPageErrorDisplay();
    frmvalidator.EnableMsgsTogether();

    frmvalidator.addValidation("familyname","req","Required field");
    frmvalidator.addValidation("givenname","req","Required field");

    frmvalidator.addValidation("email","maxlen=50");
    frmvalidator.addValidation("email","req","Required field");
    frmvalidator.addValidation("email","email","Enter a valid rochester.edu address");

    frmvalidator.addValidation("password","req","Required field");
    frmvalidator.addValidation("password","maxlen=50");
    frmvalidator.addValidation("re-password","req","Required field");

    frmvalidator.addValidation("re-password","eqelmnt=password",
    "The confirmed password does not match password");
</script>

</div>
