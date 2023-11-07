
<?php include '../includes/functions.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>NISHANG SYSTEMS</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>BUIB STUDENT ID VERIFICATION PORTAL BY NISHANG SYSTEMS</h2>
  <?php
    if(isset($_POST['submit'])){
        $matricule=$con->real_escape_string($_POST['matric']);
        $email_exists= $con->query("SELECT * FROM  printed_ids WHERE matricule='$matricule' ") or die(mysqli_error($con));
		$check=$email_exists->num_rows;	
        
        //get OS
        $os= php_uname();
        if($check<1){
            echo $msg = "<div class='alert alert-danger'>
                            <span class='glyphicon glyphicon-info-sign'></span> &nbsp;  The School ID card for Matricule
                             ".$matricule." has not been Printed please Submit your Names to your Class Delegate for Subsequent Snap shots !
                        </div>";
        }
        else {
            while($rows=$email_exists->fetch_assoc()){
                $name=$rows['name'];
            }
            echo $msg = "<div class='alert alert-success'>
            <span class='glyphicon glyphicon-info-sign'></span>  Congrulation ".$name." &nbsp;  Your School ID card has been printed ,
             get it from the Student Affairs Office
        </div>";
        }


    }
  ?>
  <form action="" method="POST" >
    <div class="form-group">
      <label for="email">Matricule:</label>
      <input type="text" required class="form-control"  id="email" placeholder="Matricule" name="matric">
    </div>
   
    <button type="submit" class="btn btn-primary" name="submit">Check</button>
  </form>
</div>

</body>
</html>
