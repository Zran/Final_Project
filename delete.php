<?php
	session_start();
	if ($_SESSION['login'] != 1) {
	header('Location: login.php');
	exit();
	}
?>



<?php
    require 'database.php';
    $id = 0;
     
	    $id = $_REQUEST['id'];
		$TimeId = $_REQUEST['TimeId'];
     
    if ( !empty($_POST)) {
        // keep track post values
        $id = $_POST['id'];
         
        // delete data
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM MoviesTimes  WHERE id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($TimeId));
        Database::disconnect();
		header("Location: readShowTime.php?id=".$id."");
         
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
                        <h3>Delete a Movie</h3>
                    </div>
                     
                    <form class="form-horizontal" action="delete.php?id=<?php echo $id?>&TimeId=<?php echo $TimeId?>" method="post">
                      <input type="hidden" name="id" value="<?php echo $id;?>"/>
                      <p class="alert alert-error">Are you sure to delete ?</p>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-danger">Yes</button>
                          <a class="btn" href="readShowTime.php?id=<?php echo $id?>">No</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>