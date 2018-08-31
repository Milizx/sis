<?php include_once 'staff-header.php'; ?>
<?php $StaffManager = new StaffManager(); ?>
<?php
    // Get provided profile
    if(isset($_GET['uid'])) {
        $user = $StaffManager->get_single_employee($_GET['uid'])[0];
    } else {
        header('Location: staff-search.php');
    }
?>
<?php
	if (isset($_POST['userid']) && isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['doby']) && isset($_POST['dobm']) && isset($_POST['dobd']) && isset($_POST['salary']) && isset($_POST['nic']) && isset($_POST['mobile_no']) && isset($_POST['address']) && isset($_POST['email']) && isset($_POST['gender'])) {

        $userid = $_POST['userid'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $departments = $_POST['userid'];
        $dob = $_POST['doby'] . '-' . $_POST['dobm'] . '-' . $_POST['dobd'];
        $salary = $_POST['salary'];
        $nic = $_POST['nic'];
        $mobile_no = $_POST['mobile_no'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];

		$user_update_status = $StaffManager->update_employee($userid, $fname, $lname, $departments, $dob, $salary, $nic, $mobile_no, $address, $email, $gender);

		if($user_update_status) {
			set_success_msg("<strong>Success!</strong> User has been successfully updated!");
		} else {
			set_error_msg("<strong>Failed!</strong> Something strange happened while trying to update!");
		}

		header('Location: staff-profile.php?uid='.$userid);
	}
?>
				<div class="col-md-10">
					<nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<a href="" class="nav-item nav-link active">Profile</a>
                            <a href="staff-search.php" class="nav-item nav-link disabled">Back</a>
						</div>
					</nav>
					<div class="tab-content">
						<div class="tab-pane mt-4 show active">
							<form method="post" action="staff-profile.php">
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">User Id</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<input value="<?php echo $user['userid']; ?>" type="text" class="form-control" name="userid" placeholder="First name" required readonly>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Name</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-3">
												<input value="<?php echo $user['fname']; ?>" type="text" class="form-control" name="fname" placeholder="First name" required>
                                                <small class="form-text text-muted">First Name</small>
											</div>
											<div class="col-md-3">
												<input value="<?php echo $user['lname']; ?>" type="text" class="form-control" name="lname" placeholder="Last name" required>
                                                <small class="form-text text-muted">Last Name</small>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Departments</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
                                                <select size="5" name="departments" class="form-control" multiple>
                                                    <?php foreach($user['departments'] as $department) { ?>
                                                    <option value="<?php echo $department['did']; ?>" <?php echo ($department['status']) ? 'selected' : '' ; ?>><?php echo $department['name']; ?></option>
                                                    <?php } ?>
                                                </select>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Date of Birth</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-2">
												<input value="<?php echo substr($user['dob'], 0, 4); ?>" type="text" class="form-control" name="doby" placeholder="Year" required>
                                                <small class="form-text text-muted">Year</small>
											</div>
											<div class="col-md-2">
												<input value="<?php echo substr($user['dob'], 5, 2); ?>" type="text" class="form-control" name="dobm" placeholder="Month" required>
                                                <small class="form-text text-muted">Month</small>
											</div>
											<div class="col-md-2">
												<input value="<?php echo substr($user['dob'], 8, 2); ?>" type="text" class="form-control" name="dobd" placeholder="Date" required>
                                                <small class="form-text text-muted">Date</small>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Basic Salary</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<input value="<?php echo $user['salary']; ?>" type="text" class="form-control" name="salary" placeholder="LKR" required>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">NIC</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<input value="<?php echo $user['nic']; ?>" type="text" class="form-control" name="nic" placeholder="Ex: 123456789V" required>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Contacts</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<input value="<?php echo $user['mobile_no']; ?>" type="text" class="form-control" name="mobile_no" placeholder="Mobile" required>
                                                <small class="form-text text-muted">Mobile</small>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label"></label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<textarea type="text" class="form-control" name="address" placeholder="Address" rows="3" required><?php echo $user['address']; ?></textarea>
                                                <small class="form-text text-muted">Address</small>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label"></label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<input value="<?php echo $user['email']; ?>" type="email" class="form-control" name="email" placeholder="Email" required>
                                                <small class="form-text text-muted">Email</small>
											</div>
										</div>
									</div>
								</div>
								<fieldset class="form-group">
									<div class="row">
										<legend class="col-form-label col-sm-2 pt-0">Gender</legend>
										<div class="col-sm-10 col-md-2">
											<select name="gender" class="form-control" required>
												<option value="1" <?php echo ($user['gender']) ? 'selected' : '' ; ?>>Male</option>
												<option value="0" <?php echo ($user['gender']) ? '' : 'selected' ; ?>>Female</option>
											</select>
										</div>
									</div>
								</fieldset>
								<div class="form-group row mt-5">
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-2">
                                        <button type="submit" class="btn btn-danger">Remove</button>
                                    </div>
									<div class="col-sm-3" style="text-align: right;">
										<button type="submit" class="btn btn-dark">Update Profile</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
<?php include_once 'staff-footer.php'; ?>