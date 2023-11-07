<?php

if (isset($_POST['import'])) 
{
include('../../includes/functions.php');
                     
						

//Import uploaded file to Database
$handle = fopen($_FILES['filename']['tmp_name'], "r");

while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
	
	$exams=round( $data[1]);
	    $matricule= $con->real_escape_string($data[0]);
        $name=$con->real_escape_string($data[1]);   
		$pob=$con->real_escape_string($data[3]);  
		$dob=$con->real_escape_string($data[2]);
		$sex=$con->real_escape_string($data[4]);  
		$prog=$con->real_escape_string($data[5]);  
		$level=  $con->real_escape_string($data[6]);        
		$nationality=  $con->real_escape_string($data[7]);  
		$campus=  $con->real_escape_string($data[8]);
		$upass=12345678;
		$hashed_password = password_hash($upass, PASSWORD_DEFAULT); // this function works only in PHP 5.5 or latest version
				
		
		  
		  
		  /////////////////
		    $check= $con->query("SELECT * FROM personal_details  WHERE matricule='$matricule'
			   ") or die(mysqli_error($con));
			   $exits=$check->num_rows;

			   $check_name= $con->query("SELECT * FROM personal_details  WHERE name='$name'
			   ") or die(mysqli_error($con));
			   $exits_name=$check->num_rows;
				   if($exits>0){
					  

				   }
				   else if($exits_name>0){
					  

				}
				   
				   else {
		
		
$do=$con->query("INSERT INTO personal_details SET name='$name', matricule='$matricule',
pob='$pob',dob='$dob',sex='$sex', level='$level', program='$prog',nationality='$nationality', campus='$campus'  ") or die(mysqli_error($con));
 
 		
$do=$con->query("INSERT INTO users SET user_name='$matricule',user_email='$matricule',
user_level='1',pwd='$hashed_password'  ") or die(mysqli_error($con));
    

                }
				
		  
		  
		  
		  
		  
		  
		  ////////////////	 
	
	}

fclose($handle);

//print "Import done";
echo "<script type='text/javascript'>alert('Successfully Imported a CSV File for User!');</script>";
	echo '<meta http-equiv="Refresh" content="1; url=../index.php?uploading_exams&did='.$_GET['did'].'&id='.$_GET['id'].'&ayear='.$_GET['ayear'].'&sem='.$_GET['sem'].'&level='.$_GET['level_id'].'&sch_id='.$_GET['sch_id'].'">';
//view upload form
}
?>