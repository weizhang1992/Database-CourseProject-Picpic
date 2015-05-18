
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
<link href='http://127.0.0.1/picpic/static/css/board.css' type='text/css' rel='stylesheet' />
</head>



<body>
<div align="center" id="welcomehead" >


<h1>
    <span class="label label-success">
    Welcome  <?php echo $_COOKIE['user'] ?> to Picpic
    </span>

</h1>
    <form method="post" accept-charset="utf-8" action=<?php echo 'http://127.0.0.1/picpic/pin/search';?>>
    <div class="input-group">
      <input type="text" name="keyword" class="form-control" placeholder="Search for pin by keyword">
      <span class="input-group-btn">
        <input type="submit" class="form-control" name="create" value="Go Picpic!">
      </span>
    </div>
    </form>
  
</div>

<div id="navbar">
 <ul class="nav nav-pills nav-justified">
  <li role="presentation" class="active"><a href="http://127.0.0.1/picpic/">Home</a></li>
  <li role="presentation" class="active"><a href="http://127.0.0.1/picpic/account/detail">Profile</a></li>
  <li role="presentation" class="active"><a href="http://127.0.0.1/picpic/Board/detail">Myboard</a></li>
  <li role="presentation" class="active"><a href="http://127.0.0.1/picpic/follow/detail">Myfollow</a></li>
</ul>
</div>
<hr>

<div id="update" align="center">
<form method="post" accept-charset="utf-8" action="http://127.0.0.1/picpic/account/update">
  <div class="form-group" align="left">
    <label for="user-name">Username</label>
    <input type="text" class="form-control" name="user-name" placeholder=<?php echo $userinfo['username']?>>
  </div>
  <div class="form-group" align="left" >
    <label for="first-name">Firstname</label>
    <input type="text" class="form-control" name="first-name" placeholder=<?php echo$userinfo['firstname']?>>
  </div>
  <div class="form-group" align="left">
    <label for="last-name">Lastname</label>
    <input type="text" class="form-control" name="last-name" placeholder=<?php echo$userinfo['lastname']?>>
  </div>
  <div class="form-group" align="left">
    <label for="e-mail">Email</label>
    <input type="text" class="form-control" name="e-mail" placeholder=<?php echo$userinfo['email']?>>
  </div>
  <div class="form-group" align="left">
    <label for="pass-word">Password</label>
    <input type="text" class="form-control" name="pass-word" placeholder=<?php echo$userinfo['password']?>>
  </div>
  <div class="buttons">
            <input type="submit" class="form-control" name="create" value=Update>
  </div>
</form>
</div>

 


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="http://cdn.bootcss.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

</body>
</html>