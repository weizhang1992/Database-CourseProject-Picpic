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
    Welcome  <?php echo $_COOKIE['user']?>
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
  <li role="presentation" class="active"><a href="http://127.0.0.1/picpic/account/detail"> Profile</a></li>
  <li role="presentation" class="active"><a href="http://127.0.0.1/picpic/Board/detail">Myboard</a></li>
  <li role="presentation" class="active"><a href="http://127.0.0.1/picpic/follow/detail">Myfollow</a></li>
</ul>
</div>

<div id="stream1"  >
  <ul class="nav nav-pills nav-justified">
   <?php foreach ($streaminfo as $streamitem):?>

   <li role="presentation" class="active"><a href=<?php echo "http://127.0.0.1/picpic/follow/showboard/".$streamitem['streamid']?>><?php echo $streamitem['streamname'];?></a></li>

   <?php endforeach;?> 
  
   <li role="presentation" class="active"><a href="http://127.0.0.1/picpic/follow/create">Create a follow stream</a></li>
 </ul>
</div>
 <br>
 <?php foreach ($boardinfo as $boarditem):?>
 <div id="pinboard">
 
 
     <form method="post" accept-charset="utf-8" action=<?php echo "http://127.0.0.1/picpic/follow/unfollow/".$stream_id.'/'.$boarditem['boardid']?>>
      <div class="buttons" id="followbutton">
            <input type="submit" class="form-control" name="create" value=unfollow>
      </div>
     </form>
     
     
      <a href=<?php echo "http://127.0.0.1/picpic/board/showpin/".$boarditem['boardid']?>>          
      <button >
         <img src=
            <?php 
                $pic=$allinfo[$boarditem['boardid']];
                if(isset($pic[0]['picture_url'])) 
                {echo $pic[0]['picture_url'];}
                else
                {echo 'https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcR5I6z9JfrVRtOdLF_q195Nym6yAxd4Jp56IJ3EqZI-7EbQGPgH' ;}
             ?> 
         alt="h">
         
          <h1>
          <span class="label label-primary">
          <?php 
                 echo 'board: '.$boarditem['boardname'];
          ?>
          </span>
          </h1>
          
          <h1 id="user">
          <span class="label label-danger">
          <?php 
                 echo 'user: '.$boarditem['board_user'];
          ?>
          </span>
          </h1>
      
      
      </button>
       </a>
 
                
</div>
 <?php endforeach;?>     
      



<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="http://cdn.bootcss.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

</body>
</html>