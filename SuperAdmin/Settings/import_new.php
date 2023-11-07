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
		
		  
		  
		  /////////////////
		    $check= $con->query("SELECT * FROM printed_ids  WHERE matricule='$matricule'
			   ") or die(mysqli_error($con));
			   $exits=$check->num_rows;

			   $check_name= $con->query("SELECT * FROM printed_ids  WHERE name='$name'
			   ") or die(mysqli_error($con));
			   $exits_name=$check->num_rows;
				   if($exits>0){
					  

				   }
				   else if($exits_name>0){
					  

				}
				   
				   else {
		
		
$do=$con->query("INSERT INTO printed_ids SET name='$name', matricule='$matricule'   ") or die(mysqli_error($con));
 
    

                }
				
		  
		  
		  
		  
		  
		  
		  ////////////////	 
	
	}

fclose($handle);

//print "Import done";
echo "<script type='text/javascript'>alert('Successfully Imported a CSV File for User!');</script>";
	echo '<meta http-equiv="Refresh" content="1; url=../index.php?new_upload">';
//view upload form
}
?>