<?php 
	include_once("includes/session.php");
	include_once("includes/zz.php"); 
    include_once("includes/functions.php"); 

	if(isset($_POST['submit']))
	{
		$staffno = $_POST['staffno'];
		$staffpass = $_POST['staffpass'];

            // Search for staff
            $getstaff = "SELECT * FROM stafflist INNER JOIN staffrole ON stafflist.staffno = staffrole.staffNum WHERE staffno='$staffno' AND sname='$staffpass'";
            $staff = mysql_query($getstaff, $connection);
            confirm_query($staff);

            if(mysql_num_rows($staff) < 1)
            {
            	// Invalid staff
            	$incorrectLogin = 'Staff details not found';
            }else
            {
            	// Valid staff
            	$staffrow = mysql_fetch_array($staff);
            	$_SESSION['staffRoleId'] = $staffrow['staffRoleId'];
            	$_SESSION['fname'] = $staffrow['fname'];
            	$_SESSION['adminroleid'] = $staffrow['staffRoleNo'];
            	$_SESSION['staffno'] = $staffrow['staffno'];
                $_SESSION['is_adminlogged_in'] = true;
                $adminid = $_SESSION['staffRoleId'];
                $logtime = date('Y-m-d H:i:s');

                $updating = "UPDATE staffrole SET loginTime = '$logtime' WHERE staffRoleId = '$adminid'";
        		$updated = mysql_query($updating);

        		if($_SESSION['adminroleid'] == 'Super Admin')
                {
                	header("Location:dashboard.php");
                }else
                {
                	header("Location:clearance.php");
                }
            }
	}
?>
<?php require('views/header.php'); ?>

	<div id="page-content" class="mt60 mb60">
		<div class="container">
			<div class="row">
				<div class="col-sm-4 page-content">					
				</div>

				<div class="col-sm-4 page-sidebar">
					<aside>
						<div class="widget sidebar-widget white-container contact-form-widget">
							<h5 class="widget-title">Sign In</h5>

							<div class="widget-content">
								<?php if(isset($incorrectLogin)): ?>
										<div class='alert alert-error'>
											<h6><?php echo $incorrectLogin;?></h6>
											<a href='#' class='close fa fa-times'></a>
										</div>
								<?php endif; ?>
								<form class="mt30" action='' method='POST'>
									<div class="form-group">
										<input type="text" class="form-control" placeholder="Username" name='staffno' required >
										<input type="password" class="form-control" placeholder="Password" name='staffpass' required >
									</div>

									<button type="submit" class="btn btn-default" name='submit'><i class="fa fa-lock"></i> Sign In</button>
								</form>
							</div>
						</div>
					</aside>
				</div>

				<div class="col-sm-4 page-content">					
				</div>
			</div>
		</div> <!-- end .container -->
	</div> <!-- end #page-content -->

<?php require('views/footer.php'); ?>