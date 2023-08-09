<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Forget Password Change</title>
<link rel="stylesheet" href="<?php echo base_url();?>assets/login/css/style.css" />
</head>

<body>
  <div class="body"></div>
		<div class="grad"></div>
		<div class="header">
			<div>Kaj<span>Bangla</span></div>
		</div>
		<br>
		<div class="login">
			<?php echo form_open("auth_login/save_change_pass"); ?>
				<input type="password" value="<?= set_value('password'); ?>" placeholder="New Password" name="password"><br>
				<div class="danger"><?php echo form_error('password'); ?></div>
				
				<input type="password" value="<?= set_value('password'); ?>" placeholder="Repeat Password" name="passconf"><br>
				<div class="danger"><?php echo form_error('password'); ?></div>
				
				<input type="hidden" name="forgetKey" value="<?= $forgetKey ?>">
				<div class="danger"><?php echo form_error('forgetKey'); ?></div>
				
				<input type="submit" value="Send"><br><br>
				<span><a href="<?= base_url() ?>auth_login">You know the password !</a></span>
				
			</form>
		</div>
</body>
</html>