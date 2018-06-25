<?php 
	include_once("includes/session.php");
	include_once("includes/zz.php"); 
    include_once("includes/functions.php");

    confirm_adminlogged_in();

    $getcols = "SELECT * FROM colleges";
    $thecols = mysql_query($getcols);

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
								<li><a href="#">Welcome <?php echo $_SESSION['fname'];?></a></li>
								<?php if($_SESSION['adminroleid'] == 'Super Admin'){ ?>
								<li><a href="dashboard.php">Admins</a></li>	
								<li class="active"><a href="colleges.php">Colleges</a></li>
								<li><a href="departments.php">Departments</a></li>	
								<li><a href="students.php">Students</a></li>									
								<?php } ?>
								<?php if($_SESSION['adminroleid'] != 'Super Admin'){ ?>
								<li><a href="clearance.php">Clearance</a></li>									
								<?php } ?>
								<li><a href="models/adminlogout.php">Log Out</a></li>
							</ul>
						</div>
					</aside>
				</div>

				<div class="col-sm-9 page-content">
					<div class="white-container mb0">
						<div id='thegentable' class='pb90'>
							<h6>All Colleges</h6>
							<a href="#" id='shownew' class="btn btn-default">Upload College</a>

							<?php if(mysql_num_rows($thecols) < 1) {?>
							<p class='pt20 mb90 pb210'>No College added yet.</p>
							<?php }else{?>
							<table class="table-hover">
								<thead>
									<tr>
										<th>S/N</th>
										<th>Name</th>
										<th>Short Form</th>
										<th></th>
									</tr>
								</thead>

								<tbody>
									<?php while($colrow = mysql_fetch_array($thecols)){ ?>
									<tr>
										<td><?php echo $serial;?></td>									
										<td><?php echo ucwords($colrow['college']);?></td>
										<td><?php echo $colrow['col'];?></td>
										<td><a href="models/coldelete.php?ad=<?php echo $colrow['cid'];?>" class='btn btn-primary fa fa-trash-o' onclick="return confirm('Are you sure you want to delete?')" title='Delete'></a></td>
									</tr>
									<?php $serial = $serial + $inc; ?>
									<?php } ?>
								</tbody>
							</table>
							<?php } ?>
						</div>
						<div id='thenew' class='pb60'>
							<form method='POST' action="models/newcollege.php" enctype='multipart/form-data' class='pb50'>
								<fieldset>
									<legend>New College</legend>	
										<label>
											Upload .CSV (e.g. Serial No., College, Short Form):
										</label>
										<input type='file' name='colleges' accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"  required />
									<br>
									<input type="submit" name="submit" class="btn btn-default" value='Save'> <a href="#" id='hidenew' class="btn btn-primary" >Cancel</a>
								</fieldset>
							</form>
						</div>
					</div>
				</div>				
			</div>
		</div> <!-- end .container -->
	</div> <!-- end #page-content -->

<?php require('views/footer.php'); ?>