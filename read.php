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
                <h3>Movies</h3>
            </div>
            <div class="row">
			    <p>
                    <!--<a href="create.php" class="btn btn-success">Create</a>-->
                </p>
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Title</th>
                      <th>Genre</th>
					  <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   include 'database.php';
                   $pdo = Database::connect(); 
				   $loc = $_REQUEST['id'];
                   $sql = 'SELECT * FROM Movies where Location_Id = ' . $loc . ' ORDER BY Id DESC';
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'. $row['Title'] . '</td>';
                            echo '<td>'. $row['Genre'] . '</td>';
							echo '<td width=250>';
                            echo '<a class="btn" href="readShowTime.php?id='.$row['Id'].'">Read</a>';
                            #echo ' ';
                            #echo '<a class="btn btn-success" href="update.php?id='.$row['id'].'">Update</a>';
                           # echo ' ';
                           # echo '<a class="btn btn-danger" href="delete.php?id='.$row['id'].'">Delete</a>';
                            echo '</td>';
                            echo '</tr>';
                   }
                   Database::disconnect();
                  ?>
                  </tbody>
            </table>
        </div>
    </div> <!-- /container -->
  </body>
</html>