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
<div align="center" id="welcomehead1">
<h1>
<span class="label label-success">
    Welcome  <?php echo $_COOKIE['user'].', this is ' ?>
</span>
    <span class="label label-warning">
    <?php echo $boardinfo[0]['board_user']."'s " ?>
    </span>
    <span class="label label-success">
    <?php echo 'board: ' ?>
</span>
    <span class="label label-danger">
    <?php echo $boardinfo[0]['boardname']."'s" ?>
    </span>
    <span class="label label-success">
    <?php echo "picture" ?>
    </span>
</h1>


</div>

<div id="navbar">
 <ul class="nav nav-pills nav-justified">
  <li role="presentation" class="active"><a href="http://127.0.0.1/picpic/">Home</a></li>
  <li role="presentation" class="active"><a href="http://127.0.0.1/picpic/account/detail"> Profile</a></li>
  <li role="presentation" class="active"><a href="http://127.0.0.1/picpic/Board/detail">Myboard</a></li>
  <li role="presentation" class="active"><a href="http://127.0.0.1/picpic/follow/detail">Myfollow</a></li>
</ul>
</div>

<div id="navbar2">
<ul class="nav nav-pills nav-justified">
  <li role="presentation" class="active"><a href=<?php echo "http://127.0.0.1/picpic/pin/createbyweb/".$boardinfo[0]['boardid']?> >Create a Pin by web</a></li>
  <li role="presentation" class="active"><a href="http://127.0.0.1/picpic/pin/createbyupload"> Create a Pin by upload</a></li>
</ul>
</div>


<?php $pinitem=$pininfo[0] ?>

<div id="pin-image" class="col-md-7">
            <div id="like">
                <form method="post" accept-charset="utf-8" action=<?php echo "http://127.0.0.1/picpic/pin/repin/".$pinitem['pinid']?>>

                       <input type="submit" class="btn btn-danger" name="create" value='Repin it'>
                </form>
                <?php if($_COOKIE['user']==$boardinfo[0]['board_user']){?> 
                <form method="post" accept-charset="utf-8" action=<?php echo "http://127.0.0.1/picpic/pin/delete/".$pinitem['pinid']?>>

                       <input type="submit" class="btn btn-default" name="create" value='Delete'>
                </form>
                <?php }?>
                 <h1>
                <span class="label label-primary"><?php echo ':'.$likecount[0]['likenum'] ?></span>
                </h1>
                <form method="post" accept-charset="utf-8" action=<?php echo "http://127.0.0.1/picpic/pin/like/".$boardinfo[0]['boardid'].'/'.$pinitem['pinid']?> id="likelike">

                       <input type="submit" class="btn btn-danger" name="create" value='Like it'>
                </form>
                

                
            </div>
        
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
   
    
   
                
</div>




<div id="pin-comment" class="col-md-3">
         
         <div class="commenterNameCommentText" id="cr">
         
          <?php foreach ($comment as $commentitem):?>
                   <h1>
                       <span class="label label-primary"><?php echo $commentitem['username'].':'?></span>
                   </h1>
                   
                   <h1>
                       <span class="label label-warning"><?php echo '"'.$commentitem['content'].'"'?></span>
                   </h1>
                   <br>
                  
                 <?php endforeach;?>  
          
        
       </div>

         <div class="commenterNameCommentText" id="co">
                 
              
                   <h1>
                       <span class="label label-primary"><?php echo $_COOKIE['user'].':'?></span>
                   </h1>
                           
             
                <form method="post" accept-charset="utf-8" action=<?php echo "http://127.0.0.1/picpic/pin/addcomment/".$boardinfo[0]['boardid'].'/'.$pinitem['pinid']?>>
                        <textarea  class="content"  name="text" placeholder="Add a comment..."></textarea>
                   
                       <input type="submit" class="btn btn-danger" name="create" value=Comment>
                   
                </form>
        </div>
 </div>


 











<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="http://cdn.bootcss.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

</body>
</html>