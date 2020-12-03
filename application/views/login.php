
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Shaxsiy kabinetga kirish</title>
	<meta charset="UTF-8">
	<meta name="description" content="Kirish">
	<meta name="keywords" content="event, unica, creative, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="<?=base_url('application/assets/css/fa-all.css');?>" rel="stylesheet">
	<link href="<?=base_url('application/assets/css/bootstrap.min.css');?>" rel="stylesheet">
	<link href="<?=base_url('application/assets/css/login.css');?>" rel="stylesheet">
</head>
<body>
<div class="bgimage"></div>
<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3>Kirish</h3>
			</div>
			<div class="card-body">
            <form action="<?php echo site_url('login/checklogin');?>" method="post">
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input name="username" type="text" class="form-control" placeholder="Login">
						
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input name="password" type="password" class="form-control" placeholder="Parol">
					</div>
					<div class="form-group">
						<input type="submit" value="Kirish" class="btn float-right login_btn">
                    </div>
            </form>
			</div>
		</div>
			<?php if ($error){ ?>
			<div class="card">
				<div class="card-body">
					<div class="alert alert-danger" role="alert">
						<?php if ($error=="wrongpass"){?>
							<p>Xato login yoki parol</p>
							</div>
					<?php } ?>
					<?php if ($error=="blocked"){?>
						<p>Sizning akkauntingiz bloklangan</p>
							</div>
					<?php } ?>
				</div>
			</div>
			<?php } ?>
	</div>
</div>
<script src="<?=base_url('application/assets/js/jquery-3.2.1.min.js');?>"></script> 
 <script src="<?=base_url('application/assets/js/bootstrap.min.js');?>"></script> 
</body>
</html>

