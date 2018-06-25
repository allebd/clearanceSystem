<?php 
	include_once("includes/session.php");
	include_once("includes/zz.php"); 
    include_once("includes/functions.php");

    confirm_adminlogged_in();

    $staffno = $_SESSION['staffno'];
    $getadmins = "SELECT * FROM stafflist INNER JOIN staffrole ON stafflist.staffno = staffrole.staffNum INNER JOIN roles ON staffrole.staffRoleNo = roles.roleName WHERE staffdelete = '' AND staffno NOT IN ('$staffno')";
    $theadmins = mysql_query($getadmins);

    $getroles = "SELECT * FROM roles";
    $theroles = mysql_query($getroles);

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
								<li class="active"><a href="#">Welcome <?php echo $_SESSION['fname'];?></a></li>
								<?php if($_SESSION['adminroleid'] == 'Super Admin'){ ?>
								<li><a href="dashboard.php">Admins</a></li>	
								<li><a href="colleges.php">Colleges</a></li>
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
							<h6>All Admins</h6>
							<a href="#" id='shownew' class="btn btn-default">Upload Admin</a>

							<?php if(mysql_num_rows($theadmins) < 1) {?>
							<p class='pt20 mb90 pb210'>No Admin added yet.</p>
							<?php }else{?>
							<table class="table-hover">
								<thead>
									<tr>
										<th>S/N</th>
										<th>Name</th>
										<th>Email</th>
										<th>Phone</th>
										<th>Role</th>
										<th>Last Login</th>
										<th></th>
										<th></th>
									</tr>
								</thead>

								<tbody>
									<?php while($adminrow = mysql_fetch_array($theadmins)){ ?>
									<tr>
										<td><?php echo $serial;?></td>									
										<td><?php echo ucwords($adminrow['sname']);?> <?php echo ucwords($adminrow['fname']);?></td>
										<td><?php echo $adminrow['email'];?></td>
										<td><?php echo $adminrow['phone'];?></td>
										<td><?php echo ucwords($adminrow['roleName']);?></td>
										<td><?php echo $adminrow['loginTime'];?></td>
										<td><a href="models/adminedit.php?ad=<?php echo $adminrow['staffRoleId'];?>" class='btn btn-primary fa fa-edit' title='Edit'></a></td>
										<td><a href="models/admindelete.php?ad=<?php echo $adminrow['staffRoleId'];?>" class='btn btn-primary fa fa-trash-o' onclick="return confirm('Are you sure you want to delete?')" title='Delete'></a></td>
									</tr>
									<?php $serial = $serial + $inc; ?>
									<?php } ?>
								</tbody>
							</table>
							<?php } ?>
						</div>
						<div id='thenew' class='pb60'>
							<form method='POST' action="models/newadmin.php" enctype='multipart/form-data' class='pb50'>
								<fieldset>
									<legend>New Admin</legend>	
										<label>
											Upload .CSV (e.g. Staff No., College, Department, Surname, Firstname, Email, Phone, Role):
										</label>
										<input type='file' name='admins' accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"  required />
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