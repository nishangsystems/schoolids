		
                            
                            	
								
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
							UpdateMomoProof($email,$user_id);
              if($closes<0){
                echo $msg = "<div class='alert alert-danger'>
                          <span class='glyphicon glyphicon-info-sign'></span> &nbsp; ERROR. Sorry Latest Date for this Exercise has passed please contcat the IT department</strong> !
                        </div>";
                     		
                    
            }
            else {
                            $tid_exist = $con->query("SELECT * FROM  personal_details WHERE matricule='$email'  
                               ") or die(mysqli_error($con));
                        
                            while($rows=$tid_exist->fetch_assoc()){
                              
                             $image=$rows['photo'];

                             $year = date("Y");

                        //Month in mm format, with leading zeros.
                        $month = date("m");

                        //Day in dd format, with leading zeros.
                        $day = date("d");

                        //The folder path for our file should be YYYY/MM/DD
                        $directory = $rows['img_path'];;
								?>
                            
                            <h1 style="text-align:center; ">
                  
                </h1>
                            
                            	
                                                    			<form method="POST" action="" enctype="multipart/form-data">

                                                          <div class="form-row">
                                                          <div class="form-group col-md-2">
                                                                  <label for="inputPassword4">Sample Photo<br />
                                                                      <span style="color:#999">Aperçu de la capture d'écran de la transaction
 </span></label>
                                                                     
                                                                  <img src="images/1.JPG" style="border:1px solid#000" required class="img-rounded" alt="Cinque Terre" width="200" height="200"> 

                                                                  </div>
                                                                 
                                                                         
                                                               
                                                                
                                                                                                                                        
                                                                <div class="form-group col-md-4">
                                                                      <label for="inputPassword4">Name <br />
                                                                      <span style="color:#999">Nom</span></label>
                                                                    <input type="text" value="<?php echo $rows['name']; ?>" required name="name" autocomplete="off"  style="color:#00F; font-weight:bold"  onBlur="doCalc(this.form)"  class="form-control"   >
                                                                  </div>
                                                                  

                                                                                                                                            
                                                                <div class="form-group col-md-2">
                                                                      <label for="inputPassword4">Matricule <br />
                                                                      <span style="color:#999">Matricule </span></label>
                                                                    <input type="text" readonly required name="matric" autocomplete="off" value="<?php echo $rows['matricule']; ?>"  style="color:#00F; font-weight:bold"  onBlur="doCalc(this.form)"  class="form-control"   >
                                                                  </div>

                                                                  <div class="form-group col-md-2">
                                                                      <label for="inputPassword4"> Gender :
                                                                      <BR />
                                                                      <span style="color:#999">Sexe</span> </label>
                                                                       <select  name="sex" onBlur="doCalc(this.form)" required class="form-control">
                                                                        <option value="<?php echo $rows['sex']; ?>"  onBlur="doCalc(this.form)"><?php echo $rows['sex']; ?></option>
                                                                        <option value="M"  onBlur="doCalc(this.form)">Male</option>
                                                                         <option value="F"  onBlur="doCalc(this.form)">Female</option>
																		
                                                                      </select>
                                                                    </div>
                                                                  

                                                                  <div class="form-group col-md-2">
                                                                      <label for="inputEmail4">Date of Birth <?php echo $rows['dob']; ?><BR />
                                                                      <span style="color:#999">Date de Naissance</span></label>
                                                                      <?php if (empty($rows['dbob'] )){ ?>
                                                                        <input type="text" value="<?php echo $rows['dob']; ?>" required name="dob" autocomplete="off"  style="color:#00F; font-weight:bold"  onBlur="doCalc(this.form)"  class="form-control"   >
                                                                        <?php } else {   ; ?>
                                                                        
                                                                        <input type="date" name="dob" value="<?php  echo date('Y-m-d', strtotime($rows['dob']));
																	   ?>" class="form-control" required="required" style="color:#00F; font-weight:bold"   >
                                     <?php } ?>
                                                                          
                                                                          
                                   
                                                                    </div>
                                                                    <div class="form-group col-md-2">
                                                                      <label for="inputPassword4">Place of Birth<BR />
                                                                      <span style="color:#999">Lieu de Naissance</span></label>
                                                                      <input type="text" style="color:#00F; font-weight:bold"  name="pob" autocomplete="off"  value="<?php echo $rows['pob']; ?>" onBlur="doCalc(this.form)" required="required" class="form-control"   >
                                                                    </div>
                                                                    
                                                                    <div class="form-group col-md-2">
                                                                      <label for="inputPassword4">Nationality<BR />
                                                                      <span style="color:#999">Nationalité</span></label>
                                                                       <select  name="nation" onBlur="doCalc(this.form)" class="form-control">
                                                                        <option value="<?php echo $rows['nationality']; ?>" style="color:#00F; font-weight:bold"   onBlur="doCalc(this.form)"><?php echo $rows['nationality']; ?></option>
                                                                         <option value="cameroonian">Cameroonian</option>
																		 <option value="afghan">Afghan</option>
                                                                      <option value="albanian">Albanian</option>
                                                                      <option value="algerian">Algerian</option>
                                                                      <option value="american">American</option>
                                                                      <option value="andorran">Andorran</option>
                                                                      <option value="angolan">Angolan</option>
                                                                      <option value="antiguans">Antiguans</option>
                                                                      <option value="argentinean">Argentinean</option>
                                                                      <option value="armenian">Armenian</option>
                                                                      <option value="australian">Australian</option>
                                                                      <option value="austrian">Austrian</option>
                                                                      <option value="azerbaijani">Azerbaijani</option>
                                                                      <option value="bahamian">Bahamian</option>
                                                                      <option value="bahraini">Bahraini</option>
                                                                      <option value="bangladeshi">Bangladeshi</option>
                                                                      <option value="barbadian">Barbadian</option>
                                                                      <option value="barbudans">Barbudans</option>
                                                                      <option value="batswana">Batswana</option>
                                                                      <option value="belarusian">Belarusian</option>
                                                                      <option value="belgian">Belgian</option>
                                                                      <option value="belizean">Belizean</option>
                                                                      <option value="beninese">Beninese</option>
                                                                      <option value="bhutanese">Bhutanese</option>
                                                                      <option value="bolivian">Bolivian</option>
                                                                      <option value="bosnian">Bosnian</option>
                                                                      <option value="brazilian">Brazilian</option>
                                                                      <option value="british">British</option>
                                                                      <option value="bruneian">Bruneian</option>
                                                                      <option value="bulgarian">Bulgarian</option>
                                                                      <option value="burkinabe">Burkinabe</option>
                                                                      <option value="burmese">Burmese</option>
                                                                      <option value="burundian">Burundian</option>
                                                                      <option value="cambodian">Cambodian</option>
                                                                      <option value="cameroonian">Cameroonian</option>

                                                                      <option value="canadian">Canadian</option>
                                                                      <option value="cape verdean">Cape Verdean</option>
                                                                      <option value="central african">Central African</option>
                                                                      <option value="chadian">Chadian</option>
                                                                      <option value="chilean">Chilean</option>
                                                                      <option value="chinese">Chinese</option>
                                                                      <option value="colombian">Colombian</option>
                                                                      <option value="comoran">Comoran</option>
                                                                      <option value="congolese">Congolese</option>
                                                                      <option value="costa rican">Costa Rican</option>
                                                                      <option value="croatian">Croatian</option>
                                                                      <option value="cuban">Cuban</option>
                                                                      <option value="cypriot">Cypriot</option>
                                                                      <option value="czech">Czech</option>
                                                                      <option value="danish">Danish</option>
                                                                      <option value="djibouti">Djibouti</option>
                                                                      <option value="dominican">Dominican</option>
                                                                      <option value="dutch">Dutch</option>
                                                                      <option value="east timorese">East Timorese</option>
                                                                      <option value="ecuadorean">Ecuadorean</option>
                                                                      <option value="egyptian">Egyptian</option>
                                                                      <option value="emirian">Emirian</option>
                                                                      <option value="equatorial guinean">Equatorial Guinean</option>
                                                                      <option value="eritrean">Eritrean</option>
                                                                      <option value="estonian">Estonian</option>
                                                                      <option value="ethiopian">Ethiopian</option>
                                                                      <option value="fijian">Fijian</option>
                                                                      <option value="filipino">Filipino</option>
                                                                      <option value="finnish">Finnish</option>
                                                                      <option value="french">French</option>
                                                                      <option value="gabonese">Gabonese</option>
                                                                      <option value="gambian">Gambian</option>
                                                                      <option value="georgian">Georgian</option>
                                                                      <option value="german">German</option>
                                                                      <option value="ghanaian">Ghanaian</option>
                                                                      <option value="greek">Greek</option>
                                                                      <option value="grenadian">Grenadian</option>
                                                                      <option value="guatemalan">Guatemalan</option>
                                                                      <option value="guinea-bissauan">Guinea-Bissauan</option>
                                                                      <option value="guinean">Guinean</option>
                                                                      <option value="guyanese">Guyanese</option>
                                                                      <option value="haitian">Haitian</option>
                                                                      <option value="herzegovinian">Herzegovinian</option>
                                                                      <option value="honduran">Honduran</option>
                                                                      <option value="hungarian">Hungarian</option>
                                                                      <option value="icelander">Icelander</option>
                                                                      <option value="indian">Indian</option>
                                                                      <option value="indonesian">Indonesian</option>
                                                                      <option value="iranian">Iranian</option>
                                                                      <option value="iraqi">Iraqi</option>
                                                                      <option value="irish">Irish</option>
                                                                      <option value="israeli">Israeli</option>
                                                                      <option value="italian">Italian</option>
                                                                      <option value="ivorian">Ivorian</option>
                                                                      <option value="jamaican">Jamaican</option>
                                                                      <option value="japanese">Japanese</option>
                                                                      <option value="jordanian">Jordanian</option>
                                                                      <option value="kazakhstani">Kazakhstani</option>
                                                                      <option value="kenyan">Kenyan</option>
                                                                      <option value="kittian and nevisian">Kittian and Nevisian</option>
                                                                      <option value="kuwaiti">Kuwaiti</option>
                                                                      <option value="kyrgyz">Kyrgyz</option>
                                                                      <option value="laotian">Laotian</option>
                                                                      <option value="latvian">Latvian</option>
                                                                      <option value="lebanese">Lebanese</option>
                                                                      <option value="liberian">Liberian</option>
                                                                      <option value="libyan">Libyan</option>
                                                                      <option value="liechtensteiner">Liechtensteiner</option>
                                                                      <option value="lithuanian">Lithuanian</option>
                                                                      <option value="luxembourger">Luxembourger</option>
                                                                      <option value="macedonian">Macedonian</option>
                                                                      <option value="malagasy">Malagasy</option>
                                                                      <option value="malawian">Malawian</option>
                                                                      <option value="malaysian">Malaysian</option>
                                                                      <option value="maldivan">Maldivan</option>
                                                                      <option value="malian">Malian</option>
                                                                      <option value="maltese">Maltese</option>
                                                                      <option value="marshallese">Marshallese</option>
                                                                      <option value="mauritanian">Mauritanian</option>
                                                                      <option value="mauritian">Mauritian</option>
                                                                      <option value="mexican">Mexican</option>
                                                                      <option value="micronesian">Micronesian</option>
                                                                      <option value="moldovan">Moldovan</option>
                                                                      <option value="monacan">Monacan</option>
                                                                      <option value="mongolian">Mongolian</option>
                                                                      <option value="moroccan">Moroccan</option>
                                                                      <option value="mosotho">Mosotho</option>
                                                                      <option value="motswana">Motswana</option>
                                                                      <option value="mozambican">Mozambican</option>
                                                                      <option value="namibian">Namibian</option>
                                                                      <option value="nauruan">Nauruan</option>
                                                                      <option value="nepalese">Nepalese</option>
                                                                      <option value="new zealander">New Zealander</option>
                                                                      <option value="ni-vanuatu">Ni-Vanuatu</option>
                                                                      <option value="nicaraguan">Nicaraguan</option>
                                                                      <option value="nigerien">Nigerien</option>
                                                                      <option value="north korean">North Korean</option>
                                                                      <option value="northern irish">Northern Irish</option>
                                                                      <option value="norwegian">Norwegian</option>
                                                                      <option value="omani">Omani</option>
                                                                      <option value="pakistani">Pakistani</option>
                                                                      <option value="palauan">Palauan</option>
                                                                      <option value="panamanian">Panamanian</option>
                                                                      <option value="papua new guinean">Papua New Guinean</option>
                                                                      <option value="paraguayan">Paraguayan</option>
                                                                      <option value="peruvian">Peruvian</option>
                                                                      <option value="polish">Polish</option>
                                                                      <option value="portuguese">Portuguese</option>
                                                                      <option value="qatari">Qatari</option>
                                                                      <option value="romanian">Romanian</option>
                                                                      <option value="russian">Russian</option>
                                                                      <option value="rwandan">Rwandan</option>
                                                                      <option value="saint lucian">Saint Lucian</option>
                                                                      <option value="salvadoran">Salvadoran</option>
                                                                      <option value="samoan">Samoan</option>
                                                                      <option value="san marinese">San Marinese</option>
                                                                      <option value="sao tomean">Sao Tomean</option>
                                                                      <option value="saudi">Saudi</option>
                                                                      <option value="scottish">Scottish</option>
                                                                      <option value="senegalese">Senegalese</option>
                                                                      <option value="serbian">Serbian</option>
                                                                      <option value="seychellois">Seychellois</option>
                                                                      <option value="sierra leonean">Sierra Leonean</option>
                                                                      <option value="singaporean">Singaporean</option>
                                                                      <option value="slovakian">Slovakian</option>
                                                                      <option value="slovenian">Slovenian</option>
                                                                      <option value="solomon islander">Solomon Islander</option>
                                                                      <option value="somali">Somali</option>
                                                                      <option value="south african">South African</option>
                                                                      <option value="south korean">South Korean</option>
                                                                      <option value="spanish">Spanish</option>
                                                                      <option value="sri lankan">Sri Lankan</option>
                                                                      <option value="sudanese">Sudanese</option>
                                                                      <option value="surinamer">Surinamer</option>
                                                                      <option value="swazi">Swazi</option>
                                                                      <option value="swedish">Swedish</option>
                                                                      <option value="swiss">Swiss</option>
                                                                      <option value="syrian">Syrian</option>
                                                                      <option value="taiwanese">Taiwanese</option>
                                                                      <option value="tajik">Tajik</option>
                                                                      <option value="tanzanian">Tanzanian</option>
                                                                      <option value="thai">Thai</option>
                                                                      <option value="togolese">Togolese</option>
                                                                      <option value="tongan">Tongan</option>
                                                                      <option value="trinidadian or tobagonian">Trinidadian or Tobagonian</option>
                                                                      <option value="tunisian">Tunisian</option>
                                                                      <option value="turkish">Turkish</option>
                                                                      <option value="tuvaluan">Tuvaluan</option>
                                                                      <option value="ugandan">Ugandan</option>
                                                                      <option value="ukrainian">Ukrainian</option>
                                                                      <option value="uruguayan">Uruguayan</option>
                                                                      <option value="uzbekistani">Uzbekistani</option>
                                                                      <option value="venezuelan">Venezuelan</option>
                                                                      <option value="vietnamese">Vietnamese</option>
                                                                      <option value="welsh">Welsh</option>
                                                                      <option value="yemenite">Yemenite</option>
                                                                      <option value="zambian">Zambian</option>
                                                                      <option value="zimbabwean">Zimbabwean</option>
                                                                      </select>
                                                                    </div>
                                                                    
                                                                  
                                                                  
                                                                                                                                            
                                                                <div class="form-group col-md-3">
                                                                      <label for="inputPassword4">Photo<br />
                                                                      <span style="color:#999">PHOTO </span></label>
                                                                     
                                                                      <input type="file" name = "image" value="<?php  echo $image; ?>" accept="image/*" onchange="preview_image(event)" style="width:200; height:200">
 <img id="output_image"/>

                                                                  </div>
                                                                 


                                                                  <div class="form-group col-md-2">
                                                                  <label for="inputPassword4">Preview Photo<br />
                                                                      <span style="color:#999">Aperçu de la Photo
 </span></label>
                                                                     
                                                                  <img src="<?php echo  $directory; ?>/<?php  echo $image; ?>" style="border:1px solid#000" required class="img-rounded" alt="Cinque Terre" width="200" height="200"> 

                                                                  </div>
                                                                  </div>
                                                                         
                                                                   <?php if(empty($image) ){

                                                                   ?>                                                                                                  
                                                                      
                                                                                  
                                                                                  
                                                                                 <div class="clearfix form-actions">
                                                        <div class="col-md-offset-3 col-md-9">
                                                            
                                                            <button class="btn btn-info" type="submit" name="save"  >
                                                                <i class="ace-icon fa fa-check bigger-110"></i>
                                                               UPDATE DATA
                                                            </button>
                                                                </div>
                                                                </div>
                                                                <?php }    else { } /*  ?>
                                                                  <div class="col-md-offset-3 col-md-9">
                                                                  <a href="?view_pmts&del=<?php echo $image; ?>" onclick="return confirm('Are you sure you wish to Delete this image and Upload again')" class="btn btn-danger btn-xs">Delete Image and Reupload</a>
                                                                </div>

                                                                  <?php } */  ?>

                                                                 

											
										
									
                                    </form>
                                    </div>
                                    </div>
                                    <?php }  } ?>

                                    <?php 


                                     $path = 'images/'.$image.' ';
                                    
                                   exit;
                                    if($_GET['del']){
                                      unlink($path);
                                      
                                      $update=$con->query("UPDATE personal_details SET photo='' WHERE photo='$image'  
                                      ") or die(mysqli_error($con));

                                      
                                        echo '<meta http-equiv="Refresh" content="1; url=?view_pmts">';
                                    }
                                     
                                    
                                    ?>
                                   