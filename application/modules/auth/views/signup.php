<?php include'common/header.php'?>
<body class="bg-login">
	<div class="login-screen signup">
		<div class="panel-login blur-content">
			<div class="panel-heading"><img src="../../assets/globals/img/teamfox.png" height="100" alt=""></div><!--.panel-heading-->

			<div id="pane-create-account" class="panel-body">
				<h2>Create a New Account</h2>
				<?php if(isset($message)){   ?>
				<div id="infoMessage" class="alert alert-error">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<?php echo $message;?>
			</div>
				<?php   }   ?>				
			<?php echo form_open("auth/register_user");?>
				<div class="form-group">
					<div class="inputer">
						<div class="input-wrapper">
						<input type="text" class="form-control"  placeholder="First Name" name="first_name" value="<?php echo $this->form_validation->set_value('first_name')?>" placeholder="First Name"  /> 
						</div>
					</div>
				</div><!--.form-group-->
				<div class="form-group">
					<div class="inputer">
						<div class="input-wrapper">
						<input type="text" class="form-control"placeholder="Last Name" name="last_name" value="<?php echo $this->form_validation->set_value('last_name')?>"   pattern="([a-z A-Z]*)"    data-validation-required-message="Please Enter Last Name" data-validation-pattern-message="Please enter only Alphabets !" title="Please enter only Alphabets !"   />
						</div>
					</div>
				</div>				
				<div class="form-group">
					<div class="inputer">
						<div class="input-wrapper">
						 <input type="text" class="form-control" placeholder="User Name" name="username" value="<?php echo $this->form_validation->set_value('username')?>"   data-validation-required-message="Please Enter User Name"  title="Please enter only Alphabets !"    />
						</div>
					</div>
				</div>				
				<div class="form-group">
					<div class="inputer">
						<div class="input-wrapper">
							<input type="email" class="form-control"  name="email" placeholder="Email Address" data-validation-required-message="Please Enter Email" value="<?php echo $this->form_validation->set_value('email')?>"   /> 
						</div>
					</div>
				</div><!--.form-group-->				
				<div class="form-group">
					<div class="inputer">
						<div class="input-wrapper">
							<select class="selecter form-control"  name="type">
								<option value="">Select Type</option>
								<option value="student">Student</option>
								<option value="org">Organiser</option>
							</select>
						</div>
					</div>
				</div><!--.form-group-->				
				<div class="form-group">
					<div class="inputer">
						<div class="input-wrapper">
						
							<input type="password"  class="form-control" placeholder="Password" minlength="2" name="password" value="<?php echo $this->form_validation->set_value('password')?>"data-validation-required-message="Please Enter password "/>
						</div>
					</div>
				</div><!--.form-group-->
				<div class="form-group">
					<div class="inputer">
						<div class="input-wrapper">
							<input type="password" class="form-control" placeholder="Confirm Password" name="password_confirm" value="<?php echo $this->form_validation->set_value('password_confirm')?>"  data-validation-matches-match="password"  data-validation-matches-message="Must match Password entered above"    /> 
						</div>
					</div>
				</div>
				<div class="form-buttons clearfix">
					<button type="button" onclick="window.location.replace('login')"class="btn btn-white pull-left show-pane-login">Cancel</button>
					<!--.form-buttons<button type="submit" class="btn btn-white pull-left show-pane-login">Cancel</button>-->
					<button type="submit" name="submit" class="btn btn-success pull-right">Sign Up</button>
				</div>			
			<?php echo form_close();?>
			</div><!--#login.panel-body-->
		</div><!--.blur-content-->
	</div><!--.login-screen-->
	<div class="bg-blur dark">
		<div class="overlay"></div><!--.overlay-->
	</div><!--.bg-blur-->
<?php include'common/footer.php'?>
	</div><!--.content-->

	<div class="layer-container">

		<!-- END OF SEARCH LAYER -->	

	</div><!--.layer-container-->
</body>
