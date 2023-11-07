<?php
    //include sms gateway 
   
    // Turn off all error reporting
     error_reporting(1); 

    $con = mysqli_connect('localhost','nishang','google1234','2022_idcards');
    //$con = mysqli_connect('localhost','u182156984_stlouisapp','Cpadmin@123','u182156984_stlouisapp');;        
    // Check connection
    if (mysqli_connect_errno())
    {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    
		  
    function dbcon(){
	  static $conn;
    if ($conn===NULL){ 
		$conn = mysqli_connect ('localhost','nishang','google1234','2022_idcards');;
       // $conn = mysqli_connect ('localhost','u182156984_stlouisapp','Cpadmin@123','u182156984_stlouisapp');;
    }
    return $conn;
    }
	date_default_timezone_set('Africa/Douala');
	$query = $con->query("SELECT * FROM ayear WHERE status='1'  " ) or die(mysqli_error($con));

    while ($userRow = $query->fetch_array()) {

        $year_id = $userRow['id'];
        
    }
	function Login($year_id){
		$con= dbcon();
	
			if (isset($_POST['doLogin'])) {
				
				$email = strip_tags($_POST['usr_email']);
				$password = strip_tags($_POST['password']);
				
				$email = $con->real_escape_string($email);
				$password = $con->real_escape_string($password);
				$query1 = $con->query("SELECT matricule FROM personal_details WHERE matricule='$email'
				   ") or die(mysqli_error($con));
				$matric_exits=$query1->num_rows;
				
				$query = $con->query("SELECT id, user_email,tel, pwd,year_id FROM users WHERE user_email='$email'
				OR tel='$email'   ") or die(mysqli_error($con));
				$row=$query->fetch_array();
				
				 $count = $query->num_rows; // if email/password are correct returns must be 1 row

				 if($matric_exits<1) {
					echo $msg = "<div class='alert alert-danger'>
								<span class='glyphicon glyphicon-info-sign'></span> &nbsp; Sorry Matricule 
								".$email." is not found in 
								the system make sure you are either Bsc Nursing or HND Nursing Student!
							</div>";
				}
				
				else if (password_verify($password, $row['pwd']) && $count==1)
				 {
					 
					 
				$_SESSION['userSession'] = $row['id'];
					
				
				
				////get the email of the user using the session_id  
					
			$query =$con->query("SELECT * FROM users WHERE id=".$_SESSION['userSession']."  ") or die(mysqli_error($con));
			
			 while($userRow=$query->fetch_array()){
			 
			echo $email=$userRow['user_email'];
			 $status=$userRow['user_level'];
			 
			 }
			
			 
			 ////////////////
			 $query =$con->query("SELECT * FROM sectors WHERE area='$status'  ") or die(mysqli_error($con));
			 
			 while($userRow=$query->fetch_array()){
			 
			 $link=$userRow['link'];
			 
					echo '<meta http-equiv="Refresh" content="0; url='.$link.'">';
			  
			 
			 }
			 
			 /////////////////
			
				  
					echo '<meta http-equiv="Refresh" content="0; url='.$link.'">';
			  
			  
				} 
				else {
					echo $msg = "<div class='alert alert-danger'>
								<span class='glyphicon glyphicon-info-sign'></span> &nbsp; Invalid Username or Password !
							</div>";
				}
				$con->close();
			}
	}

	function LoginAdmin($year_id){
		$con= dbcon();
	
			if (isset($_POST['doLogin'])) {
				
				$email = strip_tags($_POST['usr_email']);
				$password = strip_tags($_POST['password']);
				
				$email = $con->real_escape_string($email);
				$password = $con->real_escape_string($password);
				
				
				$query = $con->query("SELECT id, user_email,tel, pwd,year_id FROM users WHERE user_email='$email'
				OR tel='$email'   ") or die(mysqli_error($con));
				$row=$query->fetch_array();
				
				 $count = $query->num_rows; // if email/password are correct returns must be 1 row

				 if (password_verify($password, $row['pwd']) && $count==1)
				 {
					 
					 
				$_SESSION['userSession'] = $row['id'];
					
				
				
				////get the email of the user using the session_id  
					
			$query =$con->query("SELECT * FROM users WHERE id=".$_SESSION['userSession']."  ") or die(mysqli_error($con));
			
			 while($userRow=$query->fetch_array()){
			 
			echo $email=$userRow['user_email'];
			 $status=$userRow['user_level'];
			 
			 }
			
			 
			 ////////////////
			 $query =$con->query("SELECT * FROM sectors WHERE area='$status'  ") or die(mysqli_error($con));
			 
			 while($userRow=$query->fetch_array()){
			 
			 $link=$userRow['link'];
			 
					echo '<meta http-equiv="Refresh" content="0; url='.$link.'">';
			  
			 
			 }
			 
			 /////////////////
			
				  
					echo '<meta http-equiv="Refresh" content="0; url='.$link.'">';
			  
			  
				} 
				else {
					echo $msg = "<div class='alert alert-danger'>
								<span class='glyphicon glyphicon-info-sign'></span> &nbsp; Invalid Username or Password !
							</div>";
				}
				$con->close();
			}
	}



	function AddProg(){
		
		$con= dbcon();
			if(isset($_POST['save'])){
				$prog=strtoupper($_POST['program']);
				$abb=strtoupper($_POST['abb']);
				$deg_id=$_GET['id'];
				$duration=$_POST['duration'];
				$camp_id="";
				echo $hm=strlen($abb);
			$select =$con->query("SELECT * FROM  programs WHERE  prog_name='$prog' AND degree_id='$deg_id' ") or die(mysqli_error($con));	
			echo $counts=$select->num_rows;	
			if ($hm!=3){
				echo "<script>alert('ERROR. Abbreviation must be at most 3 characters long')</script>";
				echo '<meta http-equiv="Refresh" content="0; url=?adding_prog&id='.$deg_id.'&camp_id='.$camp_id.'">';
			}
			
			else if($counts>0){
				echo "<script>alert('ERROR. Name already Exist in the System')</script>";
				echo '<meta http-equiv="Refresh" content="0; url=?adding_prog&id='.$deg_id.'&camp_id='.$camp_id.'">';
			}
			else {
			$query =$con->query("INSERT INTO programs set prog_name='$prog',degree_id='$deg_id',serial='0',dept_code='$abb' ") or die(mysqli_error($con));
			echo '<meta http-equiv="Refresh" content="0; url=?adding_prog&id='.$deg_id.' ">';
			}
			}
	}
	
	function MomoProof($year_id,$user_id){
		$con= dbcon();
			if(isset($_POST['save'])) {
				$errors= array();
	$f_name = $_FILES['image']['name'];
	if(empty($f_name)){
		$file_name="";
	}
	else {
		$file_name = rand(1,10000).$_FILES['image']['name'];
	}
      $file_size = $_FILES['image']['size'];
      $file_tmp = $_FILES['image']['tmp_name'];
      $file_type = $_FILES['image']['type'];
	  $supported_image = array('gif','jpg','jpeg','png');
	  $folder = "./img/" . $file_name;

  

   $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

      //echo $ext; 
	// Using strtolower to overcome case sensitive


	  $num=$_POST['number'];
	 $trans_id=$_POST['trans_id'];
	  $tid_exist = $con->query("SELECT * FROM  transactions WHERE reference='$trans_id'  
	  AND year_id='$year_id' AND  reference!='' ") or die(mysqli_error($con));
	 $count=$tid_exist->num_rows;

      
      /*if(in_array($ext, $supported_image)=== false && !empty($file_name)){
		 
         echo "<script>alert('ERROR. ONLY images are allowed')</script>";
		 echo '<meta http-equiv="Refresh" content="0; url=?step_one>';

      }
	  */ if($count>0){
		echo "<script>alert('Error. Transaction ID already exists')</script>";
		echo '<meta http-equiv="Refresh" content="0; url=?verify_payments&id='.$_GET['id'].'&campus_id='.$_GET['campus_id'].'&g='.$_GET['g'].'&your_id='.$_GET['your_id'].'&submit&hdgfg**8idid">';

	  }

	  else if(strlen($num)>9){
		echo "<script>alert('Number Cannot be More than 9 digits. Remember not to include country Code')</script>";
		echo '<meta http-equiv="Refresh" content="0; url=?verify_payments&id='.$_GET['id'].'&campus_id='.$_GET['campus_id'].'&g='.$_GET['g'].'&your_id='.$_GET['your_id'].'&submit&hdgfg**8idid">';

	  }
	  else if(strlen($num)<9){
		echo "<script>alert('Number Cannot be Less than 9 digits.')</script>";
		echo '<meta http-equiv="Refresh" content="0; url=?verify_payments&id='.$_GET['id'].'&campus_id='.$_GET['campus_id'].'&g='.$_GET['g'].'&your_id='.$_GET['your_id'].'&submit&hdgfg**8idid">';

	  }
	  else if(empty($trans_id)){
		echo "<script>alert('Transaction ID Cannot be Empty')</script>";
		echo '<meta http-equiv="Refresh" content="0; url=?verify_payments&id='.$_GET['id'].'&campus_id='.$_GET['campus_id'].'&g='.$_GET['g'].'&your_id='.$_GET['your_id'].'&submit&hdgfg**8idid">';

	  }
	  else if(strlen($trans_id)!=10){
		 
		echo "<script>alert('Invalid Transaction ID ')</script>";
		echo '<meta http-equiv="Refresh" content="0; url=?verify_payments&id='.$_GET['id'].'&campus_id='.$_GET['campus_id'].'&g='.$_GET['g'].'&your_id='.$_GET['your_id'].'&submit&hdgfg**8idid">';

	  }
	  else if(empty($trans_id)){
		echo "<script>alert('Transaction ID has already been Used Already')</script>";
		echo '<meta http-equiv="Refresh" content="0; url=?verify_payments&id='.$_GET['id'].'&campus_id='.$_GET['campus_id'].'&g='.$_GET['g'].'&your_id='.$_GET['your_id'].'&submit&hdgfg**8idid">';

	  }
      
      else if($file_size > 5097152) {
		echo "<script>alert('File size must be excately 5 MB')</script>";
		echo '<meta http-equiv="Refresh" content="0; url=?verify_payments&id='.$_GET['id'].'&campus_id='.$_GET['campus_id'].'&g='.$_GET['g'].'&your_id='.$_GET['your_id'].'&submit&hdgfg**8idid">';

        
      }
	  else if($count>0){
		$query = $con->query("UPDATE transactions set  reference='$trans_id',
		image='$file_name',tel='$num' WHERE user_id='$user_id' AND year_id='$year_id' ") or die(mysqli_error($con));

		move_uploaded_file( $file_tmp, $folder);
		echo "<script>alert('Transaction is successfullyy Updated')</script>";
		echo '<meta http-equiv="Refresh" content="0; url=?verify_payments&id='.$_GET['id'].'&campus_id='.$_GET['campus_id'].'&g='.$_GET['g'].'&your_id='.$_GET['your_id'].'&submit&hdgfg**8idid">';
	  }
	  
	  else {
		$query = $con->query("INSERT INTO transactions set user_id='$user_id',year_id='$year_id', reference='$trans_id',
		image='$file_name',tel='$num' ") or die(mysqli_error($con));

		move_uploaded_file( $file_tmp, $folder);
		echo "<script>alert('Transaction is successfull')</script>";
		echo '<meta http-equiv="Refresh" content="0; url=?verify_payments&id='.$_GET['id'].'&campus_id='.$_GET['campus_id'].'&g='.$_GET['g'].'&your_id='.$_GET['your_id'].'&submit&hdgfg**8idid">';
	  }
      
      
			}
		}
	
		function UpdateMomoProof($matric,$user_id){
			$con= dbcon();
				if(isset($_POST['save'])) {
					$errors= array();
					$f_name = $_FILES['image']['name'];
					if(empty($f_name)){
						$file_name="";
					}
					else {
						$file_name = rand(1,10000).$_FILES['image']['name'];
					}
		  $file_size = $_FILES['image']['size'];
		  $file_tmp = $_FILES['image']['tmp_name'];
		  $name=$con->real_escape_string($_POST['name']);   
		  $pob=$con->real_escape_string($_POST['pob']); 
		   
		  $dob=$con->real_escape_string($_POST['dob']);
		  $sex=$con->real_escape_string($_POST['sex']);  
		  //$prog=$con->real_escape_string($data[5]);  
		 // $level=  $con->real_escape_string($data[6]);        
		  $nationality=  $con->real_escape_string($_POST['nation']);  
		  $campus=  $con->real_escape_string($data[8]);
		  $file_type = $_FILES['image']['type'];
		  $supported_image = array('jpg','jpeg','png');

		                                      //Year in YYYY format.
			$year = date("Y");

			//Month in mm format, with leading zeros.
			$month = date("m");

			//Day in dd format, with leading zeros.
			$day = date("d");

			//The folder path for our file should be YYYY/MM/DD
			$directory = "images/$year/$month/$day/";

//If the directory doesn't already exists.
if(!is_dir($directory)){
    //Create our directory.
    mkdir($directory, 755, true);
}



		  $folder = $directory . $file_name;
	
	  
	
	   $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
	
		 
		  if($file_size > 5097152) {
			echo "<script>alert('That Image is too Large please Resize')</script>";
			echo '<meta http-equiv="Refresh" content="0; url=?view_pmts>';
	
			
		  }
		  else {
			 
		
			$do=$con->query("UPDATE personal_details SET name='$name',  
			pob='$pob',dob='$dob',sex='$sex',photo='$file_name',
			nationality='$nationality', campus='$campus',img_path='$directory'  WHERE matricule='$matric'  ") or die(mysqli_error($con));
			
			move_uploaded_file( $file_tmp, $folder);
			echo "<script>alert('Your profile has been successfully updated')</script>";
			echo '<meta http-equiv="Refresh" content="0; url=?view_pmts">';
		  }
		  
		  
				}
			}
		
		
	
	function CreateUsers($year){
		
			$con= dbcon();
			if(isset($_POST['btn-signup'])) {
				
				
				$uname = ucwords($_POST['name']);
				
				$email = strip_tags($_POST['email']);
				$upass = strip_tags($_POST['password']);
			    $upass2 = strip_tags($_POST['password1']);
				$uname = $con->real_escape_string($uname);
				$email = $con->real_escape_string($email);
				$upass = $con->real_escape_string($upass);
				$tel=strip_tags($_POST['tel']);
				$tel = $con->real_escape_string($tel);
				$ip=$_SERVER['REMOTE_ADDR'];	
				$words = explode(" ", $uname);
				$your_email=$_POST['email'];
				$firstname = $words[0];
				$lastname = strtolower($words[1]);
				$third_word = strtolower($words[2]);
				$name=gethostname();
				$email=$lastname.$third_word."@stlouis-group.org";
				$user_level=1;
				
				$tel_exist = $con->query("SELECT * FROM  users WHERE tel='$tel'   ") or die(mysqli_error($con));
			
			
			    $email_exists= $con->query("SELECT * FROM  users WHERE user_email='$your_email' ") or die(mysqli_error($con));
				
				//get OS
				$os= php_uname();
				if($upass!=$upass2){
					echo $msg = "<div class='alert alert-danger'>
									<span class='glyphicon glyphicon-info-sign'></span> &nbsp; ERROR.PASSWORD DOES NOT MATCH !
								</div>";
				}

				elseif ($tel_exist->num_rows>0){
					echo $msg = "<div class='alert alert-danger'>
									<span class='glyphicon glyphicon-info-sign'></span> &nbsp; ERROR. ".$tel." has been used already
								</div>";
				}
				
				
				elseif ($email_exists->num_rows>0){
					echo $msg = "<div class='alert alert-danger'>
									<span class='glyphicon glyphicon-info-sign'></span> &nbsp; ERROR. ".$your_email." has been used already
								</div>";
				}
				elseif (strlen($upass)<6){
					echo $msg = "<div class='alert alert-danger'>
									<span class='glyphicon glyphicon-info-sign'></span> &nbsp; ERROR.Your Password must be at least 7 characters long!
								</div>";
				}
				else if($tel<9 && $tel>9){
					echo $msg = "<div class='alert alert-danger'>
									<span class='glyphicon glyphicon-info-sign'></span> &nbsp; ERROR.Telephone Number must be exactly 9 characters Long
								</div>";
				}
				
				
				else {
				
				$hashed_password = password_hash($upass, PASSWORD_DEFAULT); // this function works only in PHP 5.5 or latest version
				
				$check_email = $con->query("SELECT user_name FROM users WHERE user_name='$your_email'");
				$count=$check_email->num_rows;
				
				if ($count==0) {
					
					$query = $con->query("INSERT INTO users set full_name='$uname',user_name='$your_email',user_email='$your_email',
					pwd='$hashed_password',user_level='$user_level',banned='$user_level',ctime='$upass',date=now(),users_ip='$ip'
					,md5_id='$os',year_id='$year',campus_id='$campus',tel='$tel' ,institutional_email='$email'") or die(mysqli_error($con));
			
						$msg = "<div class='alert alert-success'>
									<span class='glyphicon glyphicon-info-sign'></span> &nbsp; successfully registered !
								</div>";
								echo "<script>alert('User Successfully Created')</script>";		
								
				 echo '<meta http-equiv="Refresh" content="0; url=login.php?create_users&link=Create%20Users%20Accounts">';
					
				}
				 else {
					
					
					echo $msg = "<div class='alert alert-danger'>
								<span class='glyphicon glyphicon-info-sign'></span> &nbsp; Sorry User Name already taken !
							</div>";
							echo '<meta http-equiv="Refresh" content="0; url=?create_users&link=Create%20Users%20Accounts">';
						
				}
					
				$con->close();
			}
			}
	       }







		   function ResetPwd($year){
		
			$con= dbcon();
			if(isset($_POST['btn-signup'])) {
				
				
				$uname = ucwords($_POST['name']);
				
				$email = strip_tags($_POST['email']);
				$email = $con->real_escape_string($email);
				$tel=strip_tags($_POST['tel']);
				$tel = $con->real_escape_string($tel);
				
				
				
				$tel_exist = $con->query("SELECT * FROM  users WHERE tel='$tel'  AND year_id='$year' AND user_email='$email' ") or die(mysqli_error($con));
			    $yes_it_does=$tel_exist->num_rows;
			
				if($yes_it_does<1){
					echo $msg = "<div class='alert alert-danger'>
									<span class='glyphicon glyphicon-info-sign'></span> &nbsp; ERROR.Email or Telephone Number does not Exist  !
								</div>";
				}

				
				
				
				else {
				
				$hashed_password = password_hash(12345678, PASSWORD_DEFAULT); // this function works only in PHP 5.5 or latest version
				
					$query = $con->query("UPDATE users set 	pwd='$hashed_password' where 
					user_email='$email' AND tel='$tel' AND year_id='$year' ") or die(mysqli_error($con));
			
						echo $msg = "<div class='alert alert-success'>
									<span class='glyphicon glyphicon-info-sign'></span> &nbsp; Your Password is successfully Resetted to <strong>12345678</strong> !
								</div>";
								echo "<script>alert('Your Password is successfully Resetted to 12345678')</script>";		
								
				 echo '<meta http-equiv="Refresh" content="5; url=login.php?create_users&link=Create%20Users%20Accounts">';
					
				}
				
					
				$con->close();
			}
			}
	      



		   function CreateUsersAdmin($year){
		
			$con= dbcon();
			if(isset($_POST['btn-signup'])) {
				
				
				$uname = ucwords($_POST['name']);
				
				$email = strip_tags($_POST['email']);
				$upass = strip_tags($_POST['password']);
			    $upass2 = strip_tags($_POST['password2']);
				$uname = $con->real_escape_string($uname);
				$email = $con->real_escape_string($email);
				$upass = $con->real_escape_string($upass);
				$campus=$_POST['campus'];
				
				$ip=$_SERVER['REMOTE_ADDR'];	
				$words = explode(" ", $uname);
				$your_email=$_POST['email'];
			
				$name=gethostname();
				$user_level=$_POST['level'];
				
			    $email_exists= $con->query("SELECT * FROM  users WHERE user_email='$your_email' ") or die(mysqli_error($con));
				
				//get OS
				$os= php_uname();
				if($upass!=$upass2){
					echo $msg = "<div class='alert alert-danger'>
									<span class='glyphicon glyphicon-info-sign'></span> &nbsp; ERROR.PASSWORD DOES NOT MATCH !
								</div>";
				}

				
				elseif ($email_exists->num_rows>0){
					echo $msg = "<div class='alert alert-danger'>
									<span class='glyphicon glyphicon-info-sign'></span> &nbsp; ERROR. ".$email." has been used already
								</div>";
				}
				elseif (strlen($upass)<6){
					echo $msg = "<div class='alert alert-danger'>
									<span class='glyphicon glyphicon-info-sign'></span> &nbsp; ERROR.Your Password must be at least 7 characters long!
								</div>";
				}
				
				
				
				else {
				
				$hashed_password = password_hash($upass, PASSWORD_DEFAULT); // this function works only in PHP 5.5 or latest version
				
				$check_email = $con->query("SELECT user_name FROM users WHERE user_name='$your_email'");
				$count=$check_email->num_rows;
				
				if ($count==0) {
					
					$query = $con->query("INSERT INTO users set full_name='$uname',user_name='$email',user_email='$email',
					pwd='$hashed_password',user_level='$user_level',banned='$user_level',ctime='$upass',date=now(),users_ip='$ip'
					,md5_id='$os',year_id='$year',campus_id='$campus' ") or die(mysqli_error($con));
			
						$msg = "<div class='alert alert-success'>
									<span class='glyphicon glyphicon-info-sign'></span> &nbsp; successfully registered !
								</div>";
								echo "<script>alert('User Successfully Created')</script>";		
								
				 echo '<meta http-equiv="Refresh" content="0; url=?create_users&link=Create%20Users%20Accounts">';
					
				}
				 else {
					
					
					echo $msg = "<div class='alert alert-danger'>
								<span class='glyphicon glyphicon-info-sign'></span> &nbsp; Sorry User Name already taken !
							</div>";
							echo '<meta http-equiv="Refresh" content="0; url=?create_users&link=Create%20Users%20Accounts">';
						
				}
					
				$con->close();
			}
			}
	       }
		   
		   
		   
		   function CreateStudent(){
		
			$con= dbcon();
			if(isset($_POST['save'])) {
				
				$uname = ucwords($_POST['name']);
				$campus = $con->real_escape_string(ucwords($_POST['campus']));
				$tel = strip_tags($_POST['tel']);
				$uname = $con->real_escape_string($uname);			
				$tel = $con->real_escape_string($tel);
				$ref= $con->real_escape_string(ucwords($_POST['ref']));
				$paymt_option=$con->real_escape_string(ucwords($_POST['paymt_option']));
				$id=base64_encode($campus);
				$year_id=$_POST['year_id'];
				$user_id=$_POST['user_id'];
				$words = explode(" ", $uname);
			//	$your_email=$_POST['email'];
				$firstname = $words[0];
				$lastname = strtolower($words[1]);
				$third_word = strtolower($words[2]);
				$name=gethostname();
				$email=$lastname.$third_word."@stlouis-group.org";
				
			    $duplicate_email= $con->query("SELECT * FROM  users WHERE institutional_email='$email' ") or die(mysqli_error($con));
				$count_email=$duplicate_email->num_rows;
				if($count_email>0){
					echo $email=$lastname.$third_word.$count_email."@stlouis-group.org";
				}
				else {
					echo $email=$lastname.$third_word."@stlouis-group.org";
				}
				
			    $email_exists= $con->query("SELECT * FROM  users WHERE full_name='$uname' ") or die(mysqli_error($con));
				$ref_exists= $con->query("SELECT * FROM  users WHERE receipt_ref='$ref' ") or die(mysqli_error($con));
				//get OS
				$os= php_uname();
				if ($email_exists->num_rows>0){
					echo "<script>alert(' ERROR. ".$uname." has been used already')</script>";
					echo $msg = "<div class='alert alert-danger'>
									<span class='glyphicon glyphicon-info-sign'></span> &nbsp; ERROR. ".$uname." has been used already
								</div>";
				}
				else if($ref_exists->num_rows>0){
					echo "<script>alert('Error. Receipt Reference ".$ref." already Exists in the system')</script>";		

				}
				
				else if($tel<9 && $tel>9){
					echo "<script>alert('RROR.Telephone Number must be exactly 9 characters Long')</script>";	
					echo $msg = "<div class='alert alert-danger'>
									<span class='glyphicon glyphicon-info-sign'></span> &nbsp; ERROR.Telephone Number must be exactly 9 characters Long
								</div>";
				}
				
				
				else {
				
			
					$query = $con->query("INSERT INTO users set full_name='$uname',user_name='$your_email',user_email='$your_email',
					user_level='1',banned='1',date=now(),receipt_ref='$ref',payment_option_id='$paymt_option',md5_id='$os'
					,year_id='$year_id',campus_id='$campus' ,tel='$tel',user_id='$user_id',institutional_email='$email' ") or die(mysqli_error($con));
			
								echo "<script>alert('User Successfully Created')</script>";		
								
				 echo '<meta http-equiv="Refresh" content="0; url=index.php?create_student&id='.$id.'&&ndndbdb">';
				
					
				$con->close();
			}
			}
	       }


		   function UpdateStudent(){
		
			$con= dbcon();
			if(isset($_POST['save'])) {
				
				$uname = ucwords($_POST['name']);
				echo $campus = $_POST['campus'];
				
				$user_id=$_GET['your_id'];
				
					$query = $con->query("UPDATE users set full_name='$uname',campus_id='$campus' WHERE id='$user_id' ") or die(mysqli_error($con));
			
								echo "<script>alert('Update Successfull')</script>";		
								
				 echo '<meta http-equiv="Refresh" content="0; url=?changing_campus&your_id='.$user_id.'&id='.$id.'&&ndndbdb">';
				
					
				$con->close();
			
	       }
		}


		function Renew($id){
		
			$con= dbcon();
			if(isset($_POST['submit'])) {
				
			$ayear = $_POST['ayear'];
				
					$query = $con->query("UPDATE users set year_id='$ayear' WHERE id='$id' ") or die(mysqli_error($con));
			
								echo "<script>alert('Update Successfull')</script>";		
								
				 echo '<meta http-equiv="Refresh" content="0; url=?create_users&link=Create%20Users%20Accounts&&ndndbdb">';
				
					
				$con->close();
			
	       }
		}


		function ChangePwd(){
				
			$con= dbcon();									 
			if(isset($_POST['submit'] ) )
			{ 
			
			$pass1=$_POST['pwd'];
			$pass2=$_POST['pwd2'];
			$upass =$_POST['pwd'];
			if($pass1!=$pass2){
				echo "<script>alert('ERROR. Paaswords does not Match')</script>";
			}
			else {
			
			 $sha1pass = password_hash($upass, PASSWORD_DEFAULT); // this function works only in PHP 5.5 or latest version
			
			
			
			if(empty($err)) {
			
			 $sql_insert =$con->query( "UPDATE users set  pwd='$sha1pass',address='$pass1' where id='".$_GET['xxc']."'") or die(mysqli_error($con));
			
			echo "<script>alert('Thank you very much')
							</script>";
				echo '<meta http-equiv="Refresh" content="0; url=?reset_password&link=Change Password">';
			}
			
			}
			}
		}
		   
		function CreateProg(){
			
		
		$con= dbcon();
			if(isset($_POST['save'])){
				
				$prog_id=$_POST['prog_id'];				
				$camp_id=$_GET['id'];
				
			$select =$con->query("SELECT * FROM campus_programs WHERE  prog_id='$prog_id' AND campus_id='$camp_id' ") or die(mysqli_error($con));	
			echo $counts=$select->num_rows;	
			if($counts>0){
				echo "<script>alert('ERROR. Program Already Exists')</script>";
				echo '<meta http-equiv="Refresh" content="0; url=?camp_prog&id='.$camp_id.'">';
			}
			else {
			$query =$con->query("INSERT INTO campus_programs  set prog_id='$prog_id',campus_id='$camp_id' ") or die(mysqli_error($con));
			echo '<meta http-equiv="Refresh" content="0; url=?camp_prog&id='.$camp_id.'">';
			}
			}
	}

	function CreateProgDeg(){
			
		
		$con= dbcon();
			if(isset($_POST['save'])){
				
				$prog_id=$_POST['prog_id'];				
				$deg_id=$_GET['id'];
				
			$select =$con->query("SELECT * FROM certificate_prog WHERE  prog_id='$prog_id' AND deg_id='$deg_id' ") or die(mysqli_error($con));	
			echo $counts=$select->num_rows;	
			if($counts>0){
				echo "<script>alert('ERROR. Program Already Exists')</script>";
				echo '<meta http-equiv="Refresh" content="0; url=?deg_prog1&id='.$deg_id.'&jjkkl">';
			}
			else {
			$query =$con->query("INSERT INTO certificate_prog  set prog_id='$prog_id',deg_id='$deg_id' ") or die(mysqli_error($con));
			
			echo '<meta http-equiv="Refresh" content="0; url=?deg_prog1&id='.$deg_id.'&ghhhh">';
			}
			}
	}


	       function CreatePayOption(){
		
		    $con= dbcon();
			if(isset($_POST['save'])){
				$option=strtoupper($_POST['mode']);
				$camp_id=$_GET['id'];
				
			$select =$con->query("SELECT * FROM  payment_options WHERE  option_name='$option' AND campus_id='$camp_id' ") or die(mysqli_error($con));	
			echo $counts=$select->num_rows;	
			if($counts>0){
				echo "<script>alert('ERROR. Name already Exist in the System')</script>";
				echo '<meta http-equiv="Refresh" content="0; url=?camp_pmt_mode&id='.$camp_id.'">';
			}
			else {
			$query =$con->query("INSERT INTO payment_options set option_name='$option' , campus_id='$camp_id'") or die(mysqli_error($con));
			echo '<meta http-equiv="Refresh" content="0; url=?camp_pmt_mode&id='.$camp_id.'">';
			}
			}
	        }
	
       function SaveSet(){
		
		$con= dbcon();
			if(isset($_POST['save'])){
				$ayear= ($_POST['ayear']);
				$starts=$_POST['starts'];
				$ends=$_POST['ends'];
			$select =$con->query("UPDATE ayear set start_date='$starts',cur_ayear='$ayear',end_date='$ends' ") or die(mysqli_error($con));				
				echo "<script>alert('UPDATE SUCCESSFUL')</script>";
			echo '<meta http-equiv="Refresh" content="0; url=?set_deadline">';
			
			}
          }
	
	    function SaveProgUp(){
		
		$con= dbcon();
			if(isset($_POST['save_update'])){
				$prog=strtoupper($_POST['program']);
				$deg_id=$_POST['deg_id'];
				$duration=$_POST['duration'];
			
			$query =$con->query("update programs set prog_name='$prog',degree_id='$deg_id',duration='$duration' WHERE id='".$_GET['edit']."' ") or die(mysqli_error($con));
			echo "<script>alert('Update Successful')</script>";
			echo '<meta http-equiv="Refresh" content="0; url=?edit_prog&edit='.$_GET['edit'].'">';
			
			}
	          }
			
			 	function PersonalDetails($user_id){
		
		        $con= dbcon();
			     if(isset($_POST['save'])){
				
				$dob=date('d-m-Y', strtotime($_POST['dob']));
				$sex=$_POST['sex'];
				$pob=strtoupper($_POST['pob']);
				$nationality=strtoupper($_POST['nation']);
				$region=strtoupper($_POST['country']);
				$division=strtoupper($_POST['state']);
				$residence=strtoupper($_POST['residence']);
				$tel=$_POST['tel'];
				$date=date('Y-m-d');
				$your_id=$_POST['your_id'];
				$cur_ayear=$_POST['cur_ayear'];
				$market_source=$_POST['market'];
				$entry_id=$con->real_escape_string($_POST['entry']);
				$select =$con->query("SELECT * FROM  certificates where id='$entry_id'   ") or die(mysqli_error($con));
															
				while($rows=$select->fetch_assoc()){
					$entry=$rows['certi'];
				}

				$select_stage=$con->query("SELECT * FROM  stage_two where your_id='$your_id'    ") or die(mysqli_error($con));
				$counts=$select_stage->num_rows;
				if($counts>0){
			
			$query =$con->query("UPDATE stage_two set entry='$entry',user_id='$user_id',choice_one='$entry_id' WHERE your_id='$your_id' ") or die(mysqli_error($con));
				}
			else {			
			
			
			$query =$con->query("INSERT INTO stage_two  set entry='$entry', your_id='$your_id',choice_one='$entry_id' ") or die(mysqli_error($con));
			
			}

			
				 $select =$con->query("SELECT * FROM  regions where id='$region' or region='$region'  ") or die(mysqli_error($con));
															
									while($rows=$select->fetch_assoc()){
										$region_name=$rows['region'];
									}
				$select =$con->query("SELECT * FROM  divisions where id='$division' OR division_name='$division'   ") or die(mysqli_error($con));
										
				while($rows=$select->fetch_assoc()){
					$division_name=$rows['division_name'];
				}
				$select_stage=$con->query("SELECT * FROM  person_stage where your_id='$your_id' AND stage='1'  ") or die(mysqli_error($con));
			
			$query =$con->query("UPDATE personal_details set sex='$sex',dob='$dob',pob='$pob',nationality='$nationality',tel='$tel',
			region='$region_name',division='$division_name',residence='$residence',date='$date',user_id='$user_id',year_id='$cur_ayear',market_source='$market_source'   WHERE your_id='$your_id' ") or die(mysqli_error($con));
			
				$query =$con->query("UPDATE users set  tel='$tel'    WHERE id='$user_id' ") or die(mysqli_error($con));
			
			
			if($select_stage->num_rows>0){
			}
			else {			
			
			
			$query =$con->query("INSERT INTO person_stage set date='$date',stage='1', your_id='$your_id' ") or die(mysqli_error($con));
			
			}
			echo "<script>alert('Data Successfully Saved')</script>";
			echo '<meta http-equiv="Refresh" content="0; url=?start_app&campus_id='.$_GET['campus_id'].'&id='.$_GET['id'].'&your_id='.$_GET['your_id'].'&g='.$_GET['g'].'">';
			
			}
	        }


			/////////////////personal details for admission office
			function PersonalDetailsAdmission(){
		
		        $con= dbcon();
			     if(isset($_POST['save'])){
				
				$dob=date('d-m-Y', strtotime($_POST['dob']));;
				$sex=$_POST['sex'];
				$name=$con->real_escape_string(strtoupper($_POST['name']));
				$email=$con->real_escape_string(strtoupper($_POST['email']));
				$tel=$con->real_escape_string(strtoupper($_POST['tel']));
				$campus=$con->real_escape_string(strtoupper($_POST['campus']));
				$pob=strtoupper($_POST['pob']);
				$nationality=strtoupper($_POST['nation']);
				$region=strtoupper($_POST['country']);
				echo $division=strtoupper($_POST['state']);
				$residence=strtoupper($_POST['residence']);
				$tel=$_POST['tel'];
				$date=date('Y-m-d');
				$your_id=$_POST['your_id'];
				$cur_ayear=$_POST['cur_ayear'];
				$market_source=$_POST['market'];
				@session_start();
				$user_id=$_GET['your_id'];
				
				 $select =$con->query("SELECT * FROM  regions where id='$region' or region='$region'  ") or die(mysqli_error($con));
															
									while($rows=$select->fetch_assoc()){
										$region_name=$rows['region'];
									}
				$select =$con->query("SELECT * FROM  divisions where id='$division'    ") or die(mysqli_error($con));
										
				while($rows=$select->fetch_assoc()){
					$division_name=$rows['division_name'];
				}
				$query=$con->query("SELECT * FROM  person_stage where your_id='$your_id' AND stage='1'  ") or die(mysqli_error($con));
			
				$update_users =$con->query("UPDATE users set full_name='$name', campus_id='$campus',user_email='$email',tel='$tel'
				WHERE id='$user_id'  ") or die(mysqli_error($con));

				$select_stage=$con->query("SELECT * FROM  person_stage where your_id='$your_id' AND stage='1'  ") or die(mysqli_error($con));
			
				$query =$con->query("UPDATE personal_details set sex='$sex',dob='$dob',pob='$pob',nationality='$nationality',tel='$tel',
				region='$region_name',division='$division_name',residence='$residence',date='$date',user_id='$user_id',year_id='$cur_ayear',market_source='$market_source'   WHERE your_id='$your_id' ") or die(mysqli_error($con));
				if($select_stage->num_rows>0){
			}
			else {			
			
				
			$query =$con->query("INSERT INTO person_stage set date='$date',stage='1', your_id='$your_id' ") or die(mysqli_error($con));
			
			}
			echo "<script>alert('Data Successfully Saved')</script>";
			echo '<meta http-equiv="Refresh" content="0; url=?start_app&id='.$_GET['id'].'&your_id='.$_GET['your_id'].'&g='.$_GET['g'].'">';
			
			}
	        }


			function PersonalDetailsUpdate(){
		
		        $con= dbcon();
			     if(isset($_POST['save'])){
				
				$dob=strtoupper($_POST['dob']);
				$sex=$_POST['sex'];
				$name=$con->real_escape_string(strtoupper($_POST['name']));
				$email=$con->real_escape_string(strtoupper($_POST['email']));
				$tel=$con->real_escape_string(strtoupper($_POST['tel']));
				$campus=$con->real_escape_string(strtoupper($_POST['campus']));
				$pob=strtoupper($_POST['pob']);
				$nationality=strtoupper($_POST['nation']);
				$region=strtoupper($_POST['country']);
				$division=strtoupper($_POST['state']);
				$residence=strtoupper($_POST['residence']);
				$tel=$_POST['tel'];
				$date=date('Y-m-d');
				$your_id=$_POST['your_id'];
				$cur_ayear=$_POST['cur_ayear'];
				$market_source=$_POST['market'];
				@session_start();
				$user_id=$_GET['your_id'];
				$entry=$con->real_escape_string($_POST['entry']);

				$select_stage=$con->query("SELECT * FROM  stage_two where your_id='$your_id'    ") or die(mysqli_error($con));
				$counts=$select_stage->num_rows;
				if($counts>0){
			
			$query =$con->query("UPDATE stage_two set entry='$entry',user_id='$user_id' WHERE your_id='$your_id' ") or die(mysqli_error($con));
				}
			else {			
			
			
			$query =$con->query("INSERT INTO stage_two  set entry='$entry', your_id='$your_id' ") or die(mysqli_error($con));
			
			}


				 $select =$con->query("SELECT * FROM  regions where id='$region' or region='$region'  ") or die(mysqli_error($con));
															
									while($rows=$select->fetch_assoc()){
										$region_name=$rows['region'];
									}
				$select =$con->query("SELECT * FROM  divisions where id='$division' OR division_name='$division'   ") or die(mysqli_error($con));
										
				while($rows=$select->fetch_assoc()){
					$division_name=$rows['division_name'];
				}
				
			
				$query =$con->query("UPDATE personal_details set sex='$sex',dob='$dob',pob='$pob',nationality='$nationality',tel='$tel',
				region='$region_name',division='$division_name',residence='$residence',date='$date',user_id='$user_id',year_id='$cur_ayear',market_source='$market_source'   WHERE your_id='$your_id' ") or die(mysqli_error($con));
			  $query =$con->query("UPDATE users SET full_name='$name'   WHERE id='$your_id' ") or die(mysqli_error($con));
		
			echo "<script>alert('Data Successfully Updated')</script>";
			echo '<meta http-equiv="Refresh" content="0; url=?update_bio&your_id='.$_GET['your_id'].'&campus_id='.$_GET['campus_id'].'&id='.$_GET['id'].'&g='.$_GET['g'].'">';
			
			}
	        }
	
	
		function StageTwo($user_id){
		
		        $con= dbcon();
			if(isset($_POST['save'])){
				
				$first_choice=$con->real_escape_string($_POST['first_choice']);
				$second_choice=$con->real_escape_string($_POST['second_choice']);
				$first_writtem=strtoupper($con->real_escape_string($_POST['first_written']));
				$second_written=strtoupper($con->real_escape_string($_POST['second_written']));
				$first_spoken=strtoupper($con->real_escape_string($_POST['first_spoken']));
				$second_spoken=strtoupper($con->real_escape_string($_POST['second_spoken']));
				$health=$_POST['health'];
				$healt_reason=$con->real_escape_string($_POST['health_reason']);
				$allergy=$_POST['allergy'];
				$allergy_reason=$con->real_escape_string($_POST['allergy_reason']);
				$disablity=$_POST['disablity'];
				$disability_reason=$con->real_escape_string($_POST['disablity_reason']);
				$entry=$con->real_escape_string($_POST['entry']);
				$awaiting=$_POST['awaiting'];
				$date=date('Y-m-d');
				$your_id=$_POST['your_id'];
				$level=$_POST['level'];
				
				@session_start();
				$user_id=$_SESSION['userSession'];;
				
				$select_stage=$con->query("SELECT * FROM  stage_two where your_id='$your_id'    ") or die(mysqli_error($con));
				if($select_stage->num_rows>0){
			
			$query =$con->query("UPDATE stage_two set first_choice='$first_choice',second_choice='$second_choice',first_written='$first_writtem'
			,second_written='$second_written',first_spoken='$first_spoken',second_spoken='$second_spoken', health='$health',
			health_reason='$healt_reason',allergy='$allergy',allergy_reason='$allergy_reason',disability='$disablity',
			disability_reason='$disability_reason',entry='$entry',awaiting='$awaiting',level='$level',user_id='$user_id' WHERE your_id='$your_id' ") or die(mysqli_error($con));
				}
			
			else {			
			
			
			$query =$con->query("INSERT INTO stage_two  set first_choice='$first_choice',second_choice='$second_choice',first_written='$first_writtem'
			,second_written='$second_written',first_spoken='$first_spoken',second_spoken='$second_spoken', health='$health',
			health_reason='$healt_reason',allergy='$allergy',allergy_reason='$allergy_reason',disability='$disablity',
			disability_reason='$disability_reason',entry='$entry',awaiting='$awaiting' ,your_id='$your_id' ") or die(mysqli_error($con));
			$query =$con->query("INSERT INTO person_stage set date='$date',stage='2', your_id='$your_id',user_id='$user_id' ") or die(mysqli_error($con));
			
			}
			
			$select_stage=$con->query("SELECT * FROM  person_stage where your_id='$your_id' AND stage='2'  ") or die(mysqli_error($con));
			
			if($select_stage->num_rows>0){
			}
			else {			
			
			
			$query =$con->query("INSERT INTO person_stage set date='$date',stage='2', your_id='$your_id' ") or die(mysqli_error($con));
			
			}
			echo "<script>alert('Data Successfully Saved')</script>";
			echo '<meta http-equiv="Refresh" content="0; url=?stage_two&id='.$_GET['id'].'&campus_id='.$_GET['campus_id'].'&g='.$_GET['g'].'">';
			
			}
	}

	///////////Stage 2 for admission officerr account use ONLY
	function StageTwoAdmision(){
						
						$con= dbcon();
					if(isset($_POST['save'])){
						
						$first_choice=$con->real_escape_string($_POST['first_choice']);
						$second_choice=$con->real_escape_string($_POST['second_choice']);
						$first_writtem=strtoupper($con->real_escape_string($_POST['first_written']));
						$second_written=strtoupper($con->real_escape_string($_POST['second_written']));
						$first_spoken=strtoupper($con->real_escape_string($_POST['first_spoken']));
						$second_spoken=strtoupper($con->real_escape_string($_POST['second_spoken']));
						$health=$_POST['health'];
						$healt_reason=$con->real_escape_string($_POST['health_reason']);
						$allergy=$_POST['allergy'];
						$allergy_reason=$con->real_escape_string($_POST['allergy_reason']);
						$disablity=$_POST['disablity'];
						$disability_reason=$con->real_escape_string($_POST['disablity_reason']);
						$entry=$con->real_escape_string($_POST['entry']);
						$awaiting=$_POST['awaiting'];
						$level=$_POST['level'];
						$date=date('Y-m-d');
						$your_id=$_POST['your_id'];
						
						@session_start();
						$user_id=$_SESSION['userSession'];;
						
						$select_stage=$con->query("SELECT * FROM  stage_two where your_id='$your_id'    ") or die(mysqli_error($con));
						if($select_stage->num_rows>0){
					
					$query =$con->query("UPDATE stage_two set first_choice='$first_choice',second_choice='$second_choice',first_written='$first_writtem'
					,second_written='$second_written',first_spoken='$first_spoken',second_spoken='$second_spoken', health='$health',
					health_reason='$healt_reason',allergy='$allergy',allergy_reason='$allergy_reason',disability='$disablity',
					disability_reason='$disability_reason',entry='$entry',awaiting='$awaiting',level='$level' WHERE your_id='$your_id' ") or die(mysqli_error($con));
						}
					else {			
					
					
					$query =$con->query("INSERT INTO stage_two  set first_choice='$first_choice',second_choice='$second_choice',first_written='$first_writtem'
					,second_written='$second_written',first_spoken='$first_spoken',second_spoken='$second_spoken', health='$health',
					health_reason='$healt_reason',allergy='$allergy',allergy_reason='$allergy_reason',disability='$disablity',
					disability_reason='$disability_reason',entry='$entry',awaiting='$awaiting' ,your_id='$your_id' ,level='$level'") or die(mysqli_error($con));
					$query =$con->query("INSERT INTO person_stage set date='$date',stage='2', your_id='$your_id' ") or die(mysqli_error($con));
					
					}
					
					$select_stage=$con->query("SELECT * FROM  person_stage where your_id='$your_id' AND stage='2'  ") or die(mysqli_error($con));
					
					if($select_stage->num_rows>0){
					}
					else {			
					
					
					$query =$con->query("INSERT INTO person_stage set date='$date',stage='2', your_id='$your_id' ") or die(mysqli_error($con));
					
					}
					echo "<script>alert('Data Successfully Saved')</script>";
					echo '<meta http-equiv="Refresh" content="0; url=?stage_two&id='.$_GET['id'].'&campus_id='.$_GET['campus_id'].'&your_id='.$_GET['your_id'].'&g='.$_GET['g'].'">';
					
					}
					}	

	
	function StageThree($user_id){
		
		        $con= dbcon();
			if(isset($_POST['save_educate'])){
				
				$school=strtoupper($con->real_escape_string($_POST['school']));
				$year=$con->real_escape_string($_POST['year']);
				$course=strtoupper($con->real_escape_string($_POST['course']));
				$diploma=strtoupper($con->real_escape_string($_POST['diploma']));
				
				$date=date('Y-m-d');
				$your_id=$_POST['your_id'];
				@session_start();
				$user_id=$_SESSION['userSession'];;
				
				$select_stage=$con->query("SELECT * FROM  stage_three where your_id='$your_id'  AND school='$school'
				AND year='$year' AND certificate='$diploma' AND course='$course'") or die(mysqli_error($con));
				if($select_stage->num_rows>0){
			
			$query =$con->query("UPDATE stage_three set school='$school',year='$year',course='$course',certificate='$diploma'  WHERE your_id='$your_id' ") or die(mysqli_error($con));
				}
			else {			
			
			
			$query =$con->query("INSERT INTO stage_three set school='$school',year='$year',course='$course',certificate='$diploma'
			,your_id='$your_id',user_id='$user_id' ") or die(mysqli_error($con));
			$query =$con->query("INSERT INTO person_stage set date='$date',stage='3', your_id='$your_id' ") or die(mysqli_error($con));
			
			}
			$select_stage=$con->query("SELECT * FROM  person_stage where your_id='$your_id' AND stage='3'  ") or die(mysqli_error($con));
			
			if($select_stage->num_rows>0){
			}
			else {			
			
			
			$query =$con->query("INSERT INTO person_stage set date='$date',stage='3', your_id='$your_id' ") or die(mysqli_error($con));
			
			}
			echo "<script>alert('Data Successfully Saved')</script>";
			echo '<meta http-equiv="Refresh" content="0; url=?stage_three&id='.$_GET['id'].'&campus_id='.$_GET['campus_id'].'&g='.$_GET['g'].'">';
			
			}
	       }



	  function StageThreeAdmission(){
		
			$con= dbcon();
		if(isset($_POST['save_educate'])){
			
			$school=strtoupper($con->real_escape_string($_POST['school']));
			$year=$con->real_escape_string($_POST['year']);
			$course=strtoupper($con->real_escape_string($_POST['course']));
			$diploma=strtoupper($con->real_escape_string($_POST['diploma']));
			
			$date=date('Y-m-d');
			$your_id=$_POST['your_id'];
			@session_start();
			$user_id=$_SESSION['userSession'];;
			
			$select_stage=$con->query("SELECT * FROM  stage_three where your_id='$your_id'  AND school='$school'
			AND year='$year' AND certificate='$diploma' AND course='$course'") or die(mysqli_error($con));
			if($select_stage->num_rows>0){
		
		$query =$con->query("UPDATE stage_three set school='$school',year='$year',course='$course',certificate='$diploma'  WHERE your_id='$your_id' ") or die(mysqli_error($con));
			}
		else {			
		
		
		$query =$con->query("INSERT INTO stage_three set school='$school',year='$year',course='$course',certificate='$diploma'
		,your_id='$your_id' ") or die(mysqli_error($con));
		$query =$con->query("INSERT INTO person_stage set date='$date',stage='3', your_id='$your_id' ") or die(mysqli_error($con));
		
		}
		$select_stage=$con->query("SELECT * FROM  person_stage where your_id='$your_id' AND stage='3'  ") or die(mysqli_error($con));
		
		if($select_stage->num_rows>0){
		}
		else {			
		
		
		$query =$con->query("INSERT INTO person_stage set date='$date',stage='3', your_id='$your_id' ") or die(mysqli_error($con));
		
		}
		echo "<script>alert('Data Successfully Saved')</script>";
		echo '<meta http-equiv="Refresh" content="0; url=?stage_three&id='.$_GET['id'].'&your_id='.$_GET['your_id'].'&campus_id='.$_GET['campus_id'].'&g='.$_GET['g'].'">';
		
		}
	   }
	
				function StageThreeB($user_ids){
		
		        $con= dbcon();
			if(isset($_POST['save_emp'])){
				
				$employer=strtoupper($con->real_escape_string($_POST['employer']));
				$posts=$con->real_escape_string($_POST['posts']);
				$from=strtoupper($con->real_escape_string($_POST['from']));
				$to=strtoupper($con->real_escape_string($_POST['to']));
				$professional=strtoupper($con->real_escape_string($_POST['professional']));
				
				
				$date=date('Y-m-d');
				$your_id=$_POST['your_id'];
				@session_start();
				$user_id=$_SESSION['userSession'];;
				
				$select_stage=$con->query("SELECT * FROM  stage_three where your_id='$your_id' and employer='$employer'    ") or die(mysqli_error($con));
				if($select_stage->num_rows>0){
			
			$query =$con->query("UPDATE stage_three set employer='$employer',post_held='$posts',froms='$from',tos='$to',
			type='$professional'  WHERE your_id='$your_id' ") or die(mysqli_error($con));
				}
			else {			
			
			
			$query =$con->query("INSERT INTO stage_three set  employer='$employer',post_held='$posts',froms='$from',tos='$to',
			type='$professional',your_id='$your_id',user_id='$user_id' ") or die(mysqli_error($con));
			$query =$con->query("INSERT INTO person_stage set date='$date',stage='3', your_id='$your_id' ") or die(mysqli_error($con));
			
			}
			$select_stage=$con->query("SELECT * FROM  person_stage where your_id='$your_id' AND stage='3'  ") or die(mysqli_error($con));
			
			if($select_stage->num_rows>0){
			}
			else {			
			
			
			$query =$con->query("INSERT INTO person_stage set date='$date',stage='3', your_id='$your_id' ") or die(mysqli_error($con));
			
			}
			echo "<script>alert('Data Successfully Saved')</script>";
			echo '<meta http-equiv="Refresh" content="0; url=?stage_three&id='.$_GET['id'].'&your_id='.$_GET['your_id'].'&campus_id='.$_GET['campus_id'].'&g='.$_GET['g'].'">';
			
			}
	}
	
	
		function StageFour($user_id){
		
		        $con= dbcon();
			if(isset($_POST['save_emp'])){
				
				$related=strtoupper($con->real_escape_string($_POST['related']));
				$s_name=$con->real_escape_string($_POST['s_name']);
				$s_adress=strtoupper($con->real_escape_string($_POST['s_address']));
				$s_tel=strtoupper($con->real_escape_string($_POST['s_tel']));
				$s_work=strtoupper($con->real_escape_string($_POST['occupation']));
				
				$date=date('Y-m-d');
				$your_id=$_POST['your_id'];
				 
				$select_stage=$con->query("SELECT * FROM  stage_four where your_id='$user_id'     ") or die(mysqli_error($con));
				if($select_stage->num_rows>0){
			
			$query =$con->query("UPDATE stage_four set relate='$related',sponsor_name='$s_name',sponsor_address='$s_adress',
				sponsor_tel='$s_tel',sponsor_work='$s_work' WHERE your_id='$user_id' ") or die(mysqli_error($con));
				$query =$con->query("INSERT INTO person_stage set date='$date',stage='4', your_id='$your_id' ") or die(mysqli_error($con));
			
				}
			else {			
			
			
			$query =$con->query("INSERT INTO stage_four set relate='$related',sponsor_name='$s_name',sponsor_address='$s_adress',
				sponsor_tel='$s_tel',sponsor_work='$s_work',your_id='$user_id',user_id='$user_id' ") or die(mysqli_error($con));
							$query =$con->query("INSERT INTO person_stage set date='$date',stage='4', your_id='$your_id' ") or die(mysqli_error($con));

			
			}
			
			echo "<script>alert('Data Successfully Saved')</script>";
			echo '<meta http-equiv="Refresh" content="0; url=?stage_four&id='.$_GET['id'].'&&campus_id='.$_GET['campus_id'].'&g='.$_GET['g'].'">';
			
			}
	}

	function StageFourAdmission(){
		
		$con= dbcon();
	if(isset($_POST['save_emp'])){
		
		$related=strtoupper($con->real_escape_string($_POST['related']));
		$s_name=$con->real_escape_string($_POST['s_name']);
		$s_adress=strtoupper($con->real_escape_string($_POST['s_address']));
		$s_tel=strtoupper($con->real_escape_string($_POST['s_tel']));
		$s_work=strtoupper($con->real_escape_string($_POST['occupation']));
		
		$date=date('Y-m-d');
		$your_id=$_POST['your_id'];
		@session_start();
		$user_id=$_SESSION['userSession'];
		
		$select_stage=$con->query("SELECT * FROM  stage_four where your_id='$your_id'     ") or die(mysqli_error($con));
		if($select_stage->num_rows>0){
	
	$query =$con->query("UPDATE stage_four set relate='$related',sponsor_name='$s_name',sponsor_address='$s_adress',
		sponsor_tel='$s_tel',sponsor_work='$s_work' WHERE your_id='$your_id' ") or die(mysqli_error($con));
		}
	else {			
	
	
	$query =$con->query("INSERT INTO stage_four set relate='$related',sponsor_name='$s_name',sponsor_address='$s_adress',
		sponsor_tel='$s_tel',sponsor_work='$s_work',your_id='$your_id'") or die(mysqli_error($con));
	
	
	}
	
	echo "<script>alert('Data Successfully Saved')</script>";
	echo '<meta http-equiv="Refresh" content="0; url=?stage_four&id='.$_GET['id'].'&your_id='.$_GET['your_id'].'&campus_id='.$_GET['campus_id'].'&g='.$_GET['g'].'">';
	
	}
}
	function DeleteThree(){
		
		        $con= dbcon();
			if(isset($_GET['del'])){
				
				
				$del=$_GET['del'];
				
			
			$query =$con->query("DELETE FROM stage_three WHERE id='$del' ") or die(mysqli_error($con));
			
			echo "<script>alert('Data Successfully Saved')</script>";
			echo '<meta http-equiv="Refresh" content="0; url=?stage_three&id='.$_GET['id'].'&your_id='.$_GET['your_id'].'&campus_id='.$_GET['campus_id'].'&g='.$_GET['g'].'">';
			
			}
	}
	
	function SubmitForm(){
		
		    $con= dbcon();
			if(isset($_GET['submitnow'])){
				
				
		   $your_id=$_GET['your_id']; 
				
			$select_stage=$con->query("SELECT * FROM  person_stage where your_id='$your_id' AND stage='5'  ") or die(mysqli_error($con));
			
			if($select_stage->num_rows>0){
				
			echo "<script>alert('Your Form had already been Submitted . Thank you')</script>";
			echo '<meta http-equiv="Refresh" content="0; url=?stage_five&id='.$_GET['id'].'&g='.$_GET['g'].'">';
			}
			else {	

			@session_start();
			$userTel = $_SESSION['user']['tel'];
			$date=date('Y-m-d'); 
			$query =$con->query("INSERT INTO person_stage set date='$date',stage='5', your_id='$your_id' ") or die(mysqli_error($con));
			if($query===TRUE){
               
				$applicantNumber = "237".$userTel;
				$message = "Congrats!. We are happy to inform you that we have received your application form . Thank you";
               // Helpers::sendSMS($message,$applicantNumber);
			}

			}
			echo "<script>alert('Your Form has successfully been Submitted . Thank you')</script>";
			echo '<meta http-equiv="Refresh" content="3;  url=../Admission/Apply/print.php?your_id='.$your_id.'" target="new">';
			
			}
	}


	function SubmitFormAdmission(){
		
		$con= dbcon();
		if(isset($_GET['submit'])){
			
			
	   $your_id=$_GET['your_id']; 
	   $select =$con->query("SELECT * FROM  users where users.id='".$your_id."'  ") or die(mysqli_error($con)); 	
                while($rows=$select->fetch_assoc()){
                  $full_name=$rows['full_name'];
                 
                 $your_tel=$rows['tel'];
                  $email=$rows['user_email'];
                 
                }
			
		$select_stage=$con->query("SELECT * FROM  person_stage where your_id='$your_id' AND stage='4'  ") or die(mysqli_error($con));
		
		if($select_stage->num_rows>0){
			
		echo "<script>alert('Your Form had already been Submitted . Thank you')</script>";
		echo '<meta http-equiv="Refresh" content="0; url=?stage_five&id='.$_GET['id'].'&g='.$_GET['g'].'">';
		}
		else {	

		@session_start();
		$userTel = $your_tel;
		$date=date('Y-m-d'); 
		$query =$con->query("INSERT INTO person_stage set date='$date',stage='4', your_id='$your_id' ") or die(mysqli_error($con));
		if($query===TRUE){
		   
			$applicantNumber = "237".$userTel;
			$message = "Congrats!. We are happy to inform you that we have received your application form . Thank you";
			Helpers::sendSMS($message,$applicantNumber);
		}

		}
		echo "<script>alert('Your Form has successfully been Submitted . Thank you')</script>";
		echo '<meta http-equiv="Refresh" content="0; url=?stage_five&id='.$_GET['id'].'&your_id='.$_GET['your_id'].'&campus_id='.$_GET['campus_id'].'&g='.$_GET['g'].'">';
		
		}
}
		function SaveMatricule($user){
			if(isset($_POST['save'])){
		$con= dbcon(); 
		$your_id=$_POST['your_id'];
		$matric=$_POST['matric'];
		$prog_id=$_POST['prog'];
		$last=$_POST['last'];
		$ref= $con->real_escape_string(ucwords($_POST['ref']));
		$paymt_option=$con->real_escape_string(ucwords($_POST['paymt_option']));
		$ref_exists= $con->query("SELECT * FROM  users WHERE receipt_ref='$ref' ") or die(mysqli_error($con));
		$matricule_exists= $con->query("SELECT * FROM personal_details WHERE matricule='$matric' ") or die(mysqli_error($con));
		if($ref_exists->num_rows>0){
			echo "<script>alert('Error. Receipt Reference ".$ref." already Exists in the system')</script>";		

		}
		else if($matricule_exists->num_rows>0){
		    echo "<script>alert('Error. Matricule ".$matric." already Exists in the system')</script>";
		}
		
		
		else {
		
	
		$query_ref = $con->query("UPDATE users set  receipt_ref='$ref',payment_option_id='$paymt_option',validator='$user' WHERE id='$your_id' ") or die(mysqli_error($con));

	
		$query =$con->query("UPDATE personal_details set matricule='$matric',admitted='1' WHERE your_id='$your_id' ") or die(mysqli_error($con));
		$query_prog =$con->query("UPDATE programs set serial='$last'  WHERE id='$prog_id' ") or die(mysqli_error($con));

		

		echo "<script>alert('Student has successfully been admitted . Thank you')</script>";
		echo '<meta http-equiv="Refresh" content="0; url=?admission_letters">';
		
		}
		
		}
	}



	function SaveMatriculeInd($user){
		if(isset($_POST['save'])){
	$con= dbcon(); 
	$your_id=$_POST['your_id'];
	$matric=$_POST['matric'];
	$prog_id=$_POST['prog'];
	$last=$_POST['last'];
	

	
		$matricule_exists= $con->query("SELECT * FROM personal_details WHERE matricule='$matric' ") or die(mysqli_error($con));
	 $counts=$matricule_exists->num_rows;
	 if($matricule_exists->num_rows>0){
		    echo "<script>alert('Error. Matricule ".$matric." already Exists in the system')</script>";
		  
		}
	else{
		
		$select =$con->query("SELECT * FROM  users WHERE id=".$your_id) or die(mysqli_error($con));
$row=$select->fetch_assoc();

$userTel =$row['tel'];		   
echo $applicantNumber = "237".$userTel;
$message = "Congratulations. You have successfully been admitted into St.Louis University Institute please Check your E-Mail";

//$message = "ST LOUIS UNIVERSITY INSTITUTE congratulates you on your admission for the 2022-2023 academic year";
Helpers::sendSMS($message,$applicantNumber);
exit;

	

	$query =$con->query("UPDATE personal_details set matricule='$matric',admitted='1' WHERE your_id='$your_id' ") or die(mysqli_error($con));
	$query_prog =$con->query("UPDATE programs set serial='$last'  WHERE id='$prog_id' ") or die(mysqli_error($con));

	

	echo "<script>alert('Student has successfully been admitted . Thank you')</script>";
	echo '<meta http-equiv="Refresh" content="0; url=?admit_applicant">';
	
	}
		}
}


			function ChangeMat($user){
				if(isset($_POST['changeit'])){
			$con= dbcon(); 
			$your_id=$_POST['your_id'];
			$matric=$_POST['matric'];
			$prog_id=$_POST['prog'];
			$last=$_POST['last'];
			$matricule_exists= $con->query("SELECT * FROM personal_details WHERE matricule='$matric' ") or die(mysqli_error($con));
			if($matricule_exists->num_rows>0){
		    echo "<script>alert('Error. Matricule ".$matric." already Exists in the system')</script>";
		    echo '<meta http-equiv="Refresh" content="0; url=?change_prog">';
		}
		
		
		else {

			$query =$con->query("UPDATE personal_details set matricule='$matric' WHERE your_id='$your_id' ") or die(mysqli_error($con));

			$query =$con->query("UPDATE stage_two set first_choice='$prog_id' WHERE your_id='$your_id' ") or die(mysqli_error($con));
			$query_prog =$con->query("UPDATE programs set serial='$last'  WHERE id='$prog_id'   ") or die(mysqli_error($con));



			echo "<script>alert('Changes Successfully Done . Thank you')</script>";
			echo '<meta http-equiv="Refresh" content="0; url=?change_prog">';

			}
				}
			}
			
	 function testSmsGroup(){
		 if(isset($_POST['save'])){
		$con= dbcon(); 
		$tempArray =array();
		$phoneNumbers=$con->query("SELECT tel FROM  users WHERE user_level='1' ") or die(mysqli_error($con));
		while($contact =$phoneNumbers->fetch_array()){
			array_push($tempArray,$contact['tel']);
		}
		$formatContactArray = Helpers::formatPhoneNumbers($tempArray);
		//send sms to formatted array of numbers
		$message=$_POST['message'];
		Helpers::sendSMS($message,$formatContactArray);
		echo "<script>alert('Your Form has successfully been Submitted . Thank you')</script>";
	}
		
	 }

	 function SaveManualPayments(){
		$con= dbcon(); 
		if(isset($_POST['submit'])){
		 $id=base64_decode($_GET['xxc']);
		 $year_id=$_POST['year_id'];
		 $mode=$_POST['mode'];
		 $dtype=$_POST['dtype'];
		 @session_start();
		 $date=date('Y-m-d G:i:s');
		 $user_id=$_SESSION['userSession'];
		 if(empty($dtype)){
			echo "<script>alert('Choose Degree type to continue')</script>";

		 }
		 else if(empty($mode)){
			echo "<script>alert('Choose a Reason for this method to continue')</script>";

		 } 
		 else {
		 $Payments=$con->query("SELECT * from degrees WHERE id='$mode' ") or die(mysqli_error($con));
		while($rows =$Payments->fetch_array()){
			 $amt=$rows['amount'];
		}
		$select_trans =$con->query("SELECT * FROM  users,transactions where transactions.user_id='".$id."' 
		AND users.id=transactions.user_id AND  transactions.year_id='$year_id' ") or die(mysqli_error($con));								
		 $momo_paid=$select_trans->num_rows;
		 if($momo_paid>0){
			echo "<script>alert('Payments Details already Exists for this User')</script>";

		 }
		 else {

			$query =$con->query("INSERT INTO transactions set created_at='$date',updated_at='$date',
			year_id='$year_id',staff_id='$user_id', amount='$amt', user_id='$id',reference='MANAUAL',
			degree_type_id='$dtype',mode_id='$mode' ") or die(mysqli_error($con));
			echo "<script>alert('Payments successfully bypassed. Tell the applicant to login and continue')</script>";
			echo '<meta http-equiv="Refresh" content="0; url=?approve_pmts">';

		 }

		}
	}


	}

		
	//With this function you can calculate the dates left until a certain date	
	function expire($expiration_date) // delare the function and get the expiration date as a parameter
	{
		$date=strtotime($expiration_date); // get the expiration date in seconds
		$days_left=ceil(($date-time())/(60*60*24)); // calculate the days left. calculate the expiration date minus the current time in seconds. Devide the difference by the seonds in one day
													// The result number will be the days left.
		return $days_left; //return the value
	}
	
	function convert_number_to_words($number) {

    $hyphen      = '-';
    $conjunction = ' and ';
    $separator   = ', ';
    $negative    = 'negative ';
    $decimal     = ' point ';
    $dictionary  = array(
        0                   => 'zero',
        1                   => 'One',
        2                   => 'Two',
        3                   => 'Three',
        4                   => 'Four',
        5                   => 'Five',
        6                   => 'Six',
        7                   => 'Seven',
        8                   => 'Eight',
        9                   => 'Nine',
        10                  => 'Ten',
        11                  => 'Eleven',
        12                  => 'Twelve',
        13                  => 'Thirteen',
        14                  => 'Fourteen',
        15                  => 'Fifteen',
        16                  => 'Sixteen',
        17                  => 'Seventeen',
        18                  => 'Eighteen',
        19                  => 'Nineteen',
        20                  => 'Twenty',
        30                  => 'Thirty',
        40                  => 'Fourty',
        50                  => 'Fifty',
        60                  => 'Sixty',
        70                  => 'Seventy',
        80                  => 'Eighty',
        90                  => 'Ninety',
        100                 => 'Hundred',
        1000                => 'Thousand',
        1000000             => 'Million',
        1000000000          => 'Billion',
        1000000000000       => 'Trillion',
        1000000000000000    => 'Quadrillion',
        1000000000000000000 => 'Quintillion'
    );

    if (!is_numeric($number)) {
        return false;
    }

    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }

    $string = $fraction = null;

    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }

    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }

    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }

    return $string;
}
	

	
	
	
			
			// With this function you can calculate on how many days someone has birthday
	function countdays($date)   // declare the function and get the birth date as a parameter
	{
		 $olddate =  substr($d, 4); // use this line if you have a date in the format YYYY-mm-dd.
		 $newdate = date("Y") ."".$olddate; //set the full birth date this year
		 $nextyear = date("Y")+1 ."".$olddate; //set the full birth date next year
		 
		 
			if(strtotime($newdate) > strtotime(date("Y-m-d"))) //check if the birthday has passed this year. In order to check use strotime(). if it has not....
			{
			$start_ts = strtotime($newdate); // set a variable equal to the birthday in seconds (Unix timestamp, check php manual for more information)
			$end_ts = strtotime(date("Y-m-d"));// and a variable equal to today in seconds
			$diff = $end_ts - $start_ts; // calculate the difference of today minus birthday
			$n = round($diff / (60*60*24));// divide the diffence with the seconds of one day to get the dates. Use round() to get a round number.
										//(60*60*24) represents 60 seconds * 60 minutes * 24 hours = 1 day in seconds. You can also directly write 86400
			$return = substr($n, 1); //you need this to get the right value without -
			return $return; // return the value
			}
			else // else if the birthday has past this year
			{
			$start_ts = strtotime(date("Y-m-d")); // set a variable equal to the today in seconds
			$end_ts = strtotime($nextyear); // and a variable with the birtday next year
			$diff = $end_ts - $start_ts; // calculate the difference of next birthday minus today
			$n = round($diff / (60*60*24)); // divide the diffence with the seconds of one day to get the dates.
			$return = $n; // assign the dates to return
			return $return; // return the value
		
			}
		
		}
				
			
	
	