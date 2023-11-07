

								<?php
					
                            $tid_exist = $con->query("SELECT * FROM  personal_details WHERE program='".$_GET['dept']."' and photo!='' 
                               ") or die(mysqli_error($con));
                               echo $tid_exist->num_rows;
                        
                            while($rows=$tid_exist->fetch_assoc()){
                              
                            $image=$rows['photo'];
								?>

                    <div class="col-sm-3" style="border:1px solid#000">
                       
                        <img src="../Students/images/<?php echo $image;?>"  class="img-responsive" style="width:200px; height:200px" alt="Image">
                        <h4><?php  echo $rows['name']; ?></h4> 
                    </div>
                                                
                          
                           
                          
                            <?php   } ?>
                                   