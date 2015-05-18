
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>sign up</title>

<!-- Bootstrap -->
<link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.4/css/bootstrap.min.css">
<link rel="stylesheet" href="http://127.0.0.1/picpic/static/css/login.css" type='text/css'  >
</head>
<body>

      
 <div class="container" id="su">

      <form class="form-signin" method="post" accept-charset="utf-8" action='http://127.0.0.1/Account/login'>
        <h2 class="form-signin-heading">Welcome to Picpic</h2>
        <label for="inputEmail" class="sr-only">Username</label>
        <input type="text" id="inputEmail" class="form-control" name="user-name" placeholder="Username" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" name="pass-word" placeholder="Password" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="create">Sign in</button> 
      </form>
      <div id="ss" align="center">
       <a href="http://127.0.0.1/picpic/account/signup">
          <button class="btn btn-lg btn-primary btn-block" type="submit" name="create">Sign up</button> 
      </a>
      </div>
    </div> <!-- /container -->
      
      
      
      
      


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="http://cdn.bootcss.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

</body>
</html>