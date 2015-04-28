<?php
	session_start();
	if ($_SESSION['login'] != 1) {
	header('Location: login.php');
	exit();
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
            <div class="row">
                <h3>Show Times</h3>
            </div>
            <div class="row">
			    <p>
                    <!-- <a href="create.php?id=<?php echo $loc?>" class="btn btn-success">Create a Show Time</a> -->
                </p>
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Start Time</th>
					  <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   include 'database.php';
                   $pdo = Database::connect(); 
				   $loc = $_REQUEST['id'];				   
                   $sql = 'SELECT * FROM MoviesTimes where Movies_Id = ' . $loc . ' ORDER BY Id DESC';
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'. $row['Start_Time'] . '</td>';
							echo '<td width=250>';
                            #echo '<a class="btn" href="read.php?id='.$row['id'].'">Read</a>';
                            #echo ' ';
                            echo '<a class="btn btn-success" href="update.php?id='.$loc.'&TimeId='.$row['Id'].'">Update</a>';
                            echo ' ';
                            echo '<a class="btn btn-danger" href="delete.php?id='.$loc.'&TimeId='.$row['Id'].'">Delete</a>';
                            echo '</td>';
                            echo '</tr>';
                   }
                   Database::disconnect();
				   echo '<a href="create.php?id='.$loc.'" class="btn btn-success">Create a Show Time</a>'
                  ?>
                  </tbody>
            </table>
        </div>
    </div> <!-- /container -->
  </body>
</html>