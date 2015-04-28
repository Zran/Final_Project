<?php
	session_start();
	if ($_SESSION['login'] != 1) {
	header('Location: login.php');
	exit();
	}
?>


<?php
				 // session_start();
				//  $sess_id = "loggedin";
				 // if ($sess_id["id"] !=$sess_id)
					 // header("location: login.php")

    require 'database.php';
	require 'database2.php';

    #if ( !empty($_GET['movieId'])) {
        $id = $_REQUEST['id'];
		$TimeId = $_REQUEST['TimeId'];
		
    #}
     
    if ( null==$id ) {
        header("Location: readShowTime.php?id=".$id."");
    }
     
    if ( !empty($_POST)) {
        // keep track validation errors
        $nameError = null;
        #$emailError = null;
        #$mobileError = null;
		#$locationError = null;
         
        // keep track post values
        $name = $_POST['name'];
        #$email = $_POST['email'];
       # $mobile = $_POST['mobile'];
		#$location = $_POST['location'];
         
        // validate input
        $valid = true;
        if (empty($name)) {
            $nameError = 'Please enter Time';
            $valid = false;
        }
         
       /*#if (empty($email)) {
           # $emailError = 'Please enter Email Address';
           # $valid = false;
        } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
            $emailError = 'Please enter a valid Email Address';
            $valid = false;
        }
         
        if (empty($mobile)) {
            $mobileError = 'Please enter Mobile Number';
            $valid = false;
        }
       */  
       // update data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE MoviesTimes  set Start_Time = ? WHERE id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($name,$TimeId));
            Database::disconnect();
            header("Location: readShowTime.php?id=".$id."");
        }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM MoviesTimes where Movies_Id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $name = $data['Start_Time'];
        Database::disconnect();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Update a Customer</h3>
                    </div>
             
                    <form class="form-horizontal" action="update.php?id=<?php echo $id?>&TimeId=<?php echo $TimeId?>" method="post">
                      <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
                        <label class="control-label">Time</label>
                        <div class="controls">
                            <input name="name" type="text"  placeholder="Time" value="<?php echo !empty($name)?$name:'';?>">
                            <?php if (!empty($nameError)): ?>
                                <span class="help-inline"><?php echo $nameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Update</button>
                          <a class="btn" href="readShowTime.php?id=<?php echo $id?>">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>