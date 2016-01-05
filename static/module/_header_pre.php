<div class="header">
<div class = "fixed-width-centered">
  <form action = 'app/login.php' method = 'POST' name='logInTo'>
    <div class = "logo">
      RoadBuds
    </div>
    <div class="login">
      <div class="input-group">
        <span class="input-group-addon-log"><i class="fa fa-envelope-o fa-fw"></i></span>
        <input class="form-control" type="text" name="email" placeholder="Email Address" size="13" maxlength="40" value="" />
      </div>
      <div class="input-group">
        <span class="input-group-addon-log"><i class="fa fa-key fa-fw"></i></span>
        <input class="form-control" type="password" placeholder="Password" name="password" size="13" maxlength="100" />
      </div>
      <a class="button" onclick="document.logInTo.submit()"><i class="fa fa-sign-in"></i> &nbsp; Sign In &nbsp;</a>
        <?php
		if (isset($_GET['success']) && ($_GET['success'] == 1))
		{
		  echo '<span style="color: green;">Account created successfully.</span><br/>';
		}
		else if (isset($_GET['err']) && $_GET['err'] == 2)
		{
		  echo '<span style="color: red;">Account creation failed.</span><br/>';
		}
		else if (isset($_GET['err']) && $_GET['err'] == 3)
		{
		  echo '<span style="color: red;">Email already exists. Sign up with a different email.</span><br/>';
		}
        ?>
    </div>
    <div style ="clear: both;"></div>
  </form>
</div>
</div>

<!-- Function to Check Cookie -->
<script type="text/javascript">
  function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) != -1) return c.substring(name.length,c.length);
    }
    return "";
  }

  function checkCookie()
  {
    var email=decodeURIComponent(getCookie("email"));
    var password=decodeURIComponent(getCookie("password"));
    /* Cookie is set */
    if(email!="" && password!="")
    {
      document.forms["logInTo"].email.value = email;
      document.forms["logInTo"].password.value = password;
      document.forms["logInTo"].submit();
    }
  }
  checkCookie();
</script>


