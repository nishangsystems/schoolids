		<style>
      .french{
        color: #938A8A;
      }
      </style>
                            
      		
                            
                            	
								
                            <head>
<script type='text/javascript'>
function preview_image(event) 
{
 var reader = new FileReader();
 reader.onload = function()
 {
  var output = document.getElementById('output_image');
  output.src = reader.result;
 }
 reader.readAsDataURL(event.target.files[0]);
}
</script>
<style>
body

#wrapper
{
 text-align:center;
 margin:0 auto;
 padding:0px;
 width:995px;
}
#output_image
{
 max-width:200px;
}
h1{
    font-size:19px;
    border:1px solid#000;
}
</style>                      	
								
								
								
                
                <?php
            
                                   
							MomoProof($year_id,$user_id);
                            $number="";
                            $tid="";
                            $tid_exist = $con->query("SELECT * FROM  transactions WHERE user_id='$user_id'  
                            AND year_id='$year_id'  ") or die(mysqli_error($con));
                             $counts=$tid_exist->num_rows;
                        
                            while($rows=$tid_exist->fetch_assoc()){
                              $number=$rows['tel'];
                           $tid=$rows['reference'];
                           $image=$rows['image'];
                            }
								?>
                            
                           
                <h2 style="color:#f00">How to Apply for a Program | Comment postuler à un programme</h2>
                           <p style="font-size:16px; font-weight:500; line-height:2">
                           1. Pay an application Fee of <span style="color:#f00">5,000 Frs</span> to <span style="color:#f00">6 71 98 92 92</span> with Momo Name :<span style="color:#f00">EMELIE BERINYUY ASHUMBENG</span><br>

                           -> Payer des frais de dossier de <span style="color:#f00">5 000 Frs</span> au <span style="color:#f00">6 71 98 92 92</span> avec Momo <span style="color:#f00">Nom :EMELIE BERINYUY ASHUMBENG </span><br>
                          
                          2.Copy the Financial Transaction Id from MTN and input in the Form on the next Page together with the 
                           Telephone Number used in Payment. If you can screenshot the Momo message from MTN it will of added advantage<br><br>

                      -> Copiez l'identifiant de transaction financière de MTN et saisissez-le dans le formulaire de la page suivante avec le numéro de téléphone
                      utilisé pour le paiement. Si vous pouvez capturer le message Momo de MTN, cela sera un avantage supplémentaire<br>
                            
                      3. After Filling out the form Click on Save and continue to complete the application process.
                             Note that the process is only complete when you receive an SMS text message from St. Louis after which you will
                             print our your application form and submit to your school secretariate<br><br>


                             ->Copiez l'identifiant de transaction financière de MTN et saisissez-le dans le formulaire de la page
                              suivante avec le numéro de téléphone utilisé pour le paiement. Si vous pouvez capturer le message Momo 
                              de MTN, cela sera un avantage supplémentaire



                          </p>
                            	
                                                    			<form method="POST" action="" enctype="multipart/form-data">
                                                               
                                                                
                                                                                                                                        
                                                                <div class="form-group col-md-3">
                                                                      <label for="inputPassword4">Momo Number Used in Paying <br />
                                                                      <span style="color:#00f">Numéro Momo utilisé pour payer? </span></label>
                                                                    <input type="text" required name="number" autocomplete="off"  style="color:#00F; font-weight:bold" value="<?php echo $number; ?>" onBlur="doCalc(this.form)"  class="form-control"   >
                                                                   

                                                                                                                                            
                                                                <div class="form-group col-md-3">
                                                                      <label for="inputPassword4">Momo Transaction ID <br />
                                                                      <span style="color:#00f">ID de transaction Momo </span></label>
                                                                    <input type="text" required name="trans_id" autocomplete="off"  style="color:#00F; font-weight:bold" value="<?php echo $tid; ?>" onBlur="doCalc(this.form)"  class="form-control"   >
                                                                  </div>

                                                                  <div class="form-group col-md-2">
                                                                      <label for="inputPassword4">Amount  <br />
                                                                      <span style="color:#00f">montant </span></label>
                                                                    <input type="text" READONLY autocomplete="off"  style="color:#F00; font-weight:bold" value="5,000 Frs" onBlur="doCalc(this.form)"  class="form-control"   >
                                                                  </div>
                                                                  
                                                                                                                                            
                                                                  <div class="form-group col-md-3">
                                                                      <label for="inputPassword4">Screenshot of Transaction<br />
                                                                      <span style="color:#999">Capture d'écran de la transaction? </span></label>
                                                                     
                                                                      <input type="file" name = "image" value="<?php  echo $image; ?>" accept="image/*" onchange="preview_image(event)" style="width:200; height:200">
 <img id="output_image"/>

                                                                  </div>

                                                                  <div class="form-group col-md-2">
                                                                  <label for="inputPassword4">Preview Screenshot of Transaction<br />
                                                                      <span style="color:#999">Aperçu de la capture d'écran de la transaction
 </span></label>
                                                                     
                                                                  <img src="img/<?php  echo $image; ?>" required class="img-rounded" alt="Cinque Terre" width="304" height="236"> 

                                                                  </div>
                                                                  </div>
                                                                 
                                                                         
                                                                         
                                                                                                    
                                                                      
                                                                                  
                                                                                  
                                                                                 <div class="clearfix form-actions">
                                                        <div class="col-md-offset-3 col-md-9">
                                                            
                                                            <button class="btn btn-info" type="submit" name="save">
                                                                <i class="ace-icon fa fa-check bigger-110"></i>
                                                                SAVE AND CONTINUE
                                                            </button>

                                                            <?PHP if($counts>0){
                                                            ?>
                                                                              <a href="?stage_six&id=<?php echo $_GET['id']; ?>&campus_id=<?php echo $_GET['campus_id']; ?>&g=<?php echo $_GET['g']; ?>&your_id=<?php echo $your_id; ?>&submitnow&hdgfg**8idid" class="btn btn-pink" onclick="return confirm('Are you sure you wish to submit this Form because once submitted updates, cannot be done again')">
                                                                                                          
                                                                <i class="ace-icon fa fa-check-square-o bigger-110"></i>
                                                                VALIDATE AND SUBMIT APPLICATION TO THE ADMISSION OFFICE
                                                                                      
                                                                                        </a>
                                                              
                                                                            <?php } ?>
                                                                </div>
                                                                </div>


                                                              

											
										
									
                                    </form>
                                    </div>
                                    </div>

                                    <?   SubmitForm();  ?>
                                   