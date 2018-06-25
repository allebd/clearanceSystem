<?php 
	include_once("includes/session.php");
	include_once("includes/zz.php"); 
    include_once("includes/functions.php"); 

	if(isset($_POST['submit']))
	{
		$matricno = $_POST['matricno'];
		$regno = $_POST['regno'];

            // Search for matric
            $getstdnt = "SELECT * FROM studlist WHERE matricno='$matricno' AND regno='$regno'";
            $stdnt = mysql_query($getstdnt, $connection);
            confirm_query($stdnt);

            if(mysql_num_rows($stdnt) < 1)
            {
            	// Invalid Matric Number
            	$incorrectLogin = 'Matric No. or Reg No. Incorrect';
            }else
            {            	
            	// Valid Matric Number
            	$studrow = mysql_fetch_array($stdnt);
            	$_SESSION['regno'] = $studrow['regno'];
            	$_SESSION['program'] = $studrow['program'];
            	$_SESSION['college'] = $studrow['college'];
            	$_SESSION['dept'] = $studrow['dept'];
            	$_SESSION['fname'] = $studrow['fname'];
            	$_SESSION['sname'] = $studrow['sname'];
            	$_SESSION['theclearance'] = $studrow['theclearance'];
            	$_SESSION['matno'] = $matricno;
                $_SESSION['is_logged_in'] = true;
            	header("Location:mydashboard.php");
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
										<input type="text" class="form-control" placeholder="Username" name='matricno' required >
										<input type="password" class="form-control" placeholder="Password" name='regno' required >
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