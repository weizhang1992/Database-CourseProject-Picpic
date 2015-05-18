
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
    Welcome  <?php echo $_COOKIE['user'] ?>
    </span>
     <span class="label label-danger">
    Please choose a board to repin
    </span>
</h1>

</div>



 <?php foreach ($boardinfo as $boarditem):?>
 <form method="post" accept-charset="utf-8" action="<?php echo "http://127.0.0.1/picpic/pin/create_repin/".$boarditem['boardid']."/".$pinid?>">
<div id="board-item">
        <div class="buttons" id="followbutton">
            <input type="submit" class="form-control" name="create" value=<?php echo $boarditem['boardname'];?>>
        </div>
 </div>
 </form>
 <?php endforeach;?>
     
       



<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="http://cdn.bootcss.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

</body>
</html>