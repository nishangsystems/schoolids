
		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

			<div id="sidebar" class="sidebar                  responsive                    ace-save-state">
				<script type="text/javascript">
					try{ace.settings.loadState('sidebar')}catch(e){}
				</script>

				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
					<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
						<button class="btn btn-success">
							<i class="ace-icon fa fa-signal"></i>
						</button>

						<button class="btn btn-info">
							<i class="ace-icon fa fa-pencil"></i>
						</button>

						<button class="btn btn-warning">
							<i class="ace-icon fa fa-users"></i>
						</button>

						<button class="btn btn-danger">
							<i class="ace-icon fa fa-cogs"></i>
						</button>
					</div>

					<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
						<span class="btn btn-success"></span>

						<span class="btn btn-info"></span>

						<span class="btn btn-warning"></span>

						<span class="btn btn-danger"></span>
					</div>
				</div><!-- /.sidebar-shortcuts -->

				<ul class="nav nav-list">
					<li class="active">
						<a href="index.php">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> Dashboard </span>
						</a>

						<b class="arrow"></b>
					</li>

					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-desktop"></i>
							<span class="menu-text">
								Excel Zone
							</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">

						<li class="">
								<a href="?new_names_upload">
									<i class="menu-icon fa fa-caret-right"></i>
									Upload Names
								</a>

								<b class="arrow"></b>
							</li>
							

							<li class="">
								<a href="?new_upload">
									<i class="menu-icon fa fa-caret-right"></i>
									Printed IDs
								</a>

								<b class="arrow"></b>
							</li>
							

					 

					 

							
								<?php 
								/*

								$tid_exist = $con->query("SELECT * FROM  personal_details  GROUP BY program 
								") or die(mysqli_error($con));

								while($rows=$tid_exist->fetch_assoc()){
								?>
							<li class="">
								<a href="?all_certi&dept=<?php echo $rows['program'] ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									<?php echo $rows['program'];  ?>
								</a>

								<b class="arrow"></b>
							</li>
							<?php } */ ?>


							
						
						</ul>
					</li>

					 

				




				 
 
					 
                     
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-pencil-square-o"></i>
							<span class="menu-text"> Campus Reports  </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
						

						
						</ul>
					</li>

					           
					 


					
                    
                    
                

					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-users"></i>

							<span class="menu-text">
								Accounts & Users

								
							</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="?create_users&link=Create Users Accounts">
									<i class="menu-icon fa fa-caret-right"></i>
									Create Users
								</a>

								<b class="arrow"></b>
							</li>
 

							<li class="">
								<a href="../logout.php">
									<i class="menu-icon fa fa-caret-right"></i>
									Log Out
								</a>

								<b class="arrow"></b>
							</li>

							
						</ul>
					</li>
				</ul><!-- /.nav-list -->
              

			

				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>
			</div>