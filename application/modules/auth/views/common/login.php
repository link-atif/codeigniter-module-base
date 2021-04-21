<div class="col-sm-6">
					<ol class="breadcrumb">
						<li class="dropdown dropdown-user dropdown-dark">
								
								<?php if($this->session->userdata('user_id'))
								{ 
										$user_id 	= $this->session->userdata('user_id');
										$userA 		= $this->ion_auth->user($user_id)->row();
								?>
								
								<span class="username username-hide-mobile">Welcome <?php echo $userA->username;?></span>
									<li>
										<a href="<?php echo site_url("".$this->config->item('authModule')."/logout"."") ?>">
										<i class="icon-key"></i> Log Out </a>
									</li>
											
								<?php }else{ ?>
								<li><a id="loginButton" class="white"><img src="<?php echo  base_url();?>themes/acpe/frontend/images/sign_in.png"> Signin</a></li> 

								<li><a  class="white" href="index.php/classic/register"><img src="<?php echo  base_url();?>themes/acpe/frontend/images/register.png"> Register</a></li>
								<?php } ?>						
							</li>
					</ol>
				</div><!--.col-->
