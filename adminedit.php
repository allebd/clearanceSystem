<?php 
	include_once("includes/session.php");
	include_once("includes/zz.php"); 
    include_once("includes/functions.php");

    confirm_adminlogged_in();

    $staffRoleId = $_SESSION['adminedit'];

    $getadmins = "SELECT * FROM stafflist INNER JOIN staffrole ON stafflist.staffno = staffrole.staffNum INNER JOIN roles ON staffrole.staffRoleNo = roles.roleName WHERE staffRoleId = '$staffRoleId'";
    $theadmins = mysql_query($getadmins);

    $getroles = "SELECT * FROM roles";
    $theroles = mysql_query($getroles);
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
					<div class="white-container mb60 pb50">
						<?php while($adminrow = mysql_fetch_array($theadmins)){ ?>
							<form method='post' action="models/editadmin.php?ad=<?php echo $staffRoleId; ?>" class='pb50'>
								<fieldset>
									<legend>Edit Supervisor</legend>	
										<label>
											Staff ID:
										</label>
										<?php echo $adminrow['staffno'];?><br>
										<label>
											Name:
										</label>
										<?php echo ucwords($adminrow['sname']);?> <?php echo ucwords($adminrow['fname']);?><br>
										<label>
											Email:
										</label>
										<?php echo $adminrow['email'];?><br>
										<label>
											Phone:
										</label>
										<?php echo $adminrow['phone'];?><br>
										<label>
											College:
										</label>
										<?php echo ucwords($adminrow['college']);?><br>
										<label>
											Department:
										</label>
										<?php echo ucwords($adminrow['dept']);?><br>
										<label>
											Role:
										</label>		
										<select name='role' required>
											<option value='<?php echo $adminrow['roleName'];?>' selected><?php echo ucwords($adminrow['roleName']);?></option>
											<?php while($rolerow = mysql_fetch_array($theroles)){ ?>
											<option value='<?php echo $rolerow['roleName'];?>'><?php echo $rolerow['roleName'];?></option>
											<?php } ?>
										</select>
									<br>
									<input type="submit" name="submit" class="btn btn-default" value='Save'> <a href="dashboard.php" class="btn btn-primary" >Cancel</a>
								</fieldset>
							</form>
						<?php } ?>
					</div>
				</div>
			</div>
		</div> <!-- end .container -->
	</div> <!-- end #page-content -->

<?php require('views/footer.php'); ?>