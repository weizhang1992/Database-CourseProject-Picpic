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
  <li role="presentation" class="active"><a href="http://127.0.0.1/picpic/account/update"> Edit Profile</a></li>
  <li role="presentation" class="active"><a href="http://127.0.0.1/picpic/Board/detail">Myboard</a></li>
  <li role="presentation" class="active"><a href="http://127.0.0.1/picpic/follow/detail">Myfollow</a></li>
</ul>
</div>

<br>
 

<div id="sort">
<form method="post" name="myform" action=<?php echo "http://127.0.0.1/picpic/pin/sort/".$keyw ?> >

<div align="left" id="sortbutton">


<select name="sortby">
<option value="relevance">relevance</option>
<option value="likes">likes</option>
<option value="time">time</option>
</select>

<input type="submit" class="btn btn-default" name="sort" value=sort>


</div>

</form>

</div>
  
  <br>
 <?php foreach ($pininfo as $pinitem):?>
<div id="pin-item">
      <a href=<?php echo "http://127.0.0.1/picpic/pin/show/".$pinitem['boardid']."/".$pinitem['pinid']?> >    
      <button ><img src=<?php echo $pinitem['picture_url']?> alt="h">
      
            <h1>
            <span class="label label-primary">tag:</span>
            </h1>
            
            <?php foreach ($taginfo[$pinitem['pinid']] as $tagitem):?>
            <h1>
                 <span class="label label-default"><?php echo $tagitem['tagname']?></span>
            </h1>
            <?php endforeach;?>
      </button>
      </a>   
                
</div>
 <?php endforeach;?>     
      

 
      
      
      


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="http://cdn.bootcss.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

</body>
</html>