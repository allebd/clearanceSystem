<?php 
	include_once("includes/session.php");
	include_once("includes/zz.php"); 
    include_once("includes/functions.php"); 

    confirm_logged_in();

    $getroles = "SELECT * FROM `roles` WHERE `roleName` <> 'Super Admin'";
    $gettingroles = mysql_query($getroles);

    $serial = 1;
    $inc = 1;
?>
<?php require('views/header.php'); ?>

	<div id="page-content">
		<div class="container">
			<div class="row">
				<div class="col-sm-3 page-sidebar">
					<aside>
						<div class="widget sidebar-widget white-container links-widget">
							<ul>
								<li class="active"><a href="#">Welcome <?php echo ucwords($_SESSION['fname']);?></a></li>
								<li><a href="models/logout.php">Log Out</a></li>
							</ul>
						</div>
					</aside>
				</div>
				<div class="col-sm-9 page-content">
					<div class="white-container mb0">
						<p><a href="#" onclick="printContent('clearanceprint')" class='btn btn-primary'>Print Clearance</a></p>
						<div id='clearanceprint'>
							<div id='thegentable' class='pb90'>
								<table>
									<tr>
										<td><strong>Surname:</strong> <?php echo ucwords($_SESSION['sname']);?></td>
										<td><strong>First Name:</strong> <?php echo ucwords($_SESSION['fname']);?></td>
										<td><strong>Matric Number:</strong> <?php echo $_SESSION['matno'];?></td>
										<td><strong>Reg No.:</strong> <?php echo $_SESSION['regno'];?></td>
									</tr>
									<tr>
										<td><strong>Department:</strong> <?php echo $_SESSION['dept'];?></td>
										<td><strong>College:</strong> <?php echo $_SESSION['college'];?></td>
										<td><strong>Program:</strong> <?php echo $_SESSION['program'];?></td>
										<td><strong>Approval Status:</strong> <?php $theclearance = $_SESSION['theclearance'];
										if($theclearance != ''):?><?php echo $_SESSION['theclearance'];?><?php endif; ?><?php if($theclearance == ''):?><?php echo "Not Approved";?><?php endif; ?></td>
									</tr>
								</table>

								<?php if(mysql_num_rows($gettingroles) < 1) {?>
								<p class='pt20 mb90 pb210'>No clearance done yet.</p>
								<?php }else{?>
								<table class="table-hover">
									<thead>
										<tr>
											<th>S/N</th>
											<th>Clearance</th>
											<th>Date Cleared</th>
											<th>Status</th>
										</tr>
									</thead>

									<tbody>
										<?php while($rolrow = mysql_fetch_array($gettingroles)){ ?>
										<tr>
											<td><?php echo $serial;?></td>	
											<td>
												<?php $roleName = $rolrow['roleName'];
												      echo str_replace(" Admin Officer","","$roleName");
												?>			
											<td>
												<?php 
													$matricno = $_SESSION['matno'];
													$adminroleid = $rolrow['roleName'];
												    $getclear = "SELECT * FROM `clearance` WHERE studclearno = '$matricno' AND `clearname` = '$adminroleid'";
	    											$gettingclear = mysql_query($getclear);

	    											if(mysql_num_rows($gettingclear) < 1)
	    											{
	    												$dclearance = "";
	    											}else{
	    												$clearrow = mysql_fetch_array($gettingclear);
	    												$dclearance = $clearrow['clearstatus'];
	    											}

	    											if($dclearance != ''){ 
	    												echo date_format(date_create($clearrow['cleardate']), 'l F j, Y');
	    											}
												?>
											</td>
											<td>
												<?php 
													if($dclearance == ''){ 
												?>
												<button type='button' class='btn btn-danger'>Not Cleared</button>
												<?php }else{ ?>
												<button type='button' class='btn btn-success'>Cleared</button>
												<?php } ?>
											</td>
										</tr>
										<?php $serial = $serial + $inc; ?>
										<?php } ?>
									</tbody>
								</table>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
				
			</div>
		</div> <!-- end .container -->
	</div> <!-- end #page-content -->

<?php require('views/footer.php'); ?>