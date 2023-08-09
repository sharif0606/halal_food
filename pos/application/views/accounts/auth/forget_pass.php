<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html class="body-full-height">
<head>
	<meta charset="UTF-8">
	<title>Forget Password</title>
	<link rel="stylesheet" href="<?= base_url();?>assets/css/theme-default.css" />
</head>

<body>
	<div class="registration-container">            
            <div class="registration-box animated fadeInDown">
                <div class="registration-logo"></div>
                <div class="registration-body">
                    <div class="registration-title"><strong>Forgot</strong> Password?</div>
                    <div class="registration-subtitle">A password recovery email will be sent to your email address if your email address is correct. </div>
                    <?= form_open("admin/auth/auth_login/forget_pass_email"); ?>                        
                    <h4>Your E-mail</h4>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="text" class="form-control" placeholder="Email" name="email"><br>
							<div class="danger"><?= form_error('email'); ?></div>
                        </div>
                    </div>                                                            
                    <div class="form-group push-up-20">
                        <div class="col-md-6">
                            <a href="#" class="btn btn-link btn-block">Registration</a>
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-danger btn-block">Send</button>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="registration-footer">
                    <div class="pull-left">
                        &copy; 2017 AppName
                    </div>
                </div>
            </div>
            
        </div>
</body>
</html>
