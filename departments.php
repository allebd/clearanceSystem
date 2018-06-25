<?php 
	include_once("includes/session.php");
	include_once("includes/zz.php"); 
    include_once("includes/functions.php");

    confirm_adminlogged_in();

    $getdept = "SELECT * FROM departments";
    $thedept = mysql_query($getdept);

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
								<li><a href="colleges.php">Colleges</a></li>
								<li class="active"><a href="departments.php">Departments</a></li>
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
							<h6>All Departments</h6>
							<a href="#" id='shownew' class="btn btn-default">Upload Department</a>

							<?php if(mysql_num_rows($thedept) < 1) {?>
							<p class='pt20 mb90 pb210'>No Department added yet.</p>
							<?php }else{?>
							<table class="table-hover">
								<thead>
									<tr>
										<th>S/N</th>
										<th>Name</th>
										<th>Short Form</th>
										<th>College</th>
										<th></th>
									</tr>
								</thead>

								<tbody>
									<?php while($deptrow = mysql_fetch_array($thedept)){ ?>
									<tr>
										<td><?php echo $serial;?></td>									
										<td><?php echo ucwords($deptrow['department']);?></td>
										<td><?php echo $deptrow['dept'];?></td>
										<td><?php echo $deptrow['coldept'];?></td>
										<td><a href="models/deptdelete.php?ad=<?php echo $deptrow['did'];?>" class='btn btn-primary fa fa-trash-o' onclick="return confirm('Are you sure you want to delete?')" title='Delete'></a></td>
									</tr>
									<?php $serial = $serial + $inc; ?>
									<?php } ?>
								</tbody>
							</table>
							<?php } ?>
						</div>
						<div id='thenew' class='pb60'>
							<form method='POST' action="models/newdepartment.php" enctype='multipart/form-data' class='pb50'>
								<fieldset>
									<legend>New Department</legend>	
										<label>
											Upload .CSV (e.g. Serial No., Department, Short Form, College):
										</label>
										<input type='file' name='departments' accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"  required />
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