<?php 
	include_once("includes/session.php");
	include_once("includes/zz.php"); 
    include_once("includes/functions.php");

    confirm_adminlogged_in();

    $getstud = "SELECT * FROM studlist";
    $thestud = mysql_query($getstud);

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
								<li><a href="departments.php">Departments</a></li>	
								<li class="active"><a href="students.php">Students</a></li>								
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
							<h6>All Students</h6>
							<a href="#" id='shownew' class="btn btn-default">Upload Student</a>

							<?php if(mysql_num_rows($thestud) < 1) {?>
							<p class='pt20 mb90 pb210'>No Student added yet.</p>
							<?php }else{?>
							<table class="table-hover">
								<thead>
									<tr>
										<th>S/N</th>
										<th>First Name</th>
										<th>Last Name</th>
										<th>Matric Number</th>
										<th>Registration Number</th>
										<th>Program</th>
										<th>Department</th>
										<th>College</th>
										<th>Approval Status</th>
										<th></th>
									</tr>
								</thead>

								<tbody>
									<?php while($studrow = mysql_fetch_array($thestud)){ ?>
									<tr>
										<td><?php echo $serial;?></td>									
										<td><?php echo ucwords($studrow['fname']);?></td>
										<td><?php echo ucwords($studrow['sname']);?></td>
										<td><?php echo $studrow['matricno'];?></td>
										<td><?php echo $studrow['regno'];?></td>
										<td><?php echo ucwords($studrow['program']);?></td>
										<td><?php echo ucwords($studrow['dept']);?></td>
										<td><?php echo ucwords($studrow['college']);?></td>
										<td><?php echo ucwords($studrow['theclearance']);?></td>
										<td><a href="models/studdelete.php?ad=<?php echo $studrow['matricno'];?>" class='btn btn-primary fa fa-trash-o' onclick="return confirm('Are you sure you want to delete?')" title='Delete'></a></td>
									</tr>
									<?php $serial = $serial + $inc; ?>
									<?php } ?>
								</tbody>
							</table>
							<?php } ?>
						</div>
						<div id='thenew' class='pb60'>
							<form method='POST' action="models/newstudent.php" enctype='multipart/form-data' class='pb50'>
								<fieldset>
									<legend>New Student</legend>	
										<label>
											Upload .CSV (e.g. Serial No., First Name, Surname, Matric Number, Registration Number, Program, Department, College, Clearance Status):
										</label>
										<input type='file' name='students' accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"  required />
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