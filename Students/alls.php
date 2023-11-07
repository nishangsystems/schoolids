
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
 
        $matricule='TOP UP BSC NURSING';
        $email_exists= $con->query("SELECT * FROM  personal_details WHERE program='$matricule' ") or die(mysqli_error($con));
		$i=1;	
      
  ?>
   <table class="table table-bordered">
    <thead>
      <tr>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Exists</th>
        <th>Printed</th>
        <th>Unprinted</th>
      </tr>
    </thead>
    <tbody>
        <?php
        
        while($rows=$email_exists->fetch_assoc()){
            $name=$rows['name'];
      
            
      
        ?>
      <tr>
        <td><?php echo $i++;?></td>
        <td><?php echo $rows['name']; ?></td>
        <td><?php echo $matric=$rows['matricule']; ?></td>
        <td><?php  
               $prints= $con->query("SELECT * FROM  printed_ids WHERE matricule='$matric' ") or die(mysqli_error($con));
            echo $printed=$prints->num_rows;
?></td>

<td><?php  
               $prints= $con->query("SELECT * FROM  personal_details_bk WHERE matricule='$matric' ") or die(mysqli_error($con));
            echo $not_printed=$prints->num_rows;
?></td>
    <td><?php if($printed==0 && $not_printed==0){
        echo "YES";
        
    }
    else {
    }?></td>
      </tr>

      <?php } ?>
      
    </tbody>
  </table>

</body>
</html>
