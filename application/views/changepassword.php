<div class="col-md-12">
		<div class="grid email">
			<div class="grid-body">
				<div class="row">
					<!-- BEGIN INBOX MENU -->
					<div class="col-md-3 p-3">
						<h2 class="grid-title">Parolni o'zgartirish</h2>
						<?php if (isset($error) and $error=='wrongpass'){?>
						<div class="alert alert-danger" role="alert">
							Xato parol
						</div>
						<?php }?>
                                        </div>
                                </div>
					<!-- END INBOX MENU -->
					
                    <!-- BEGIN INBOX CONTENT -->
			<form action="<?php echo site_url('auth/changepassword'); ?>" method="post">
			<div class="form-group">
				<input name="oldpassword" type="password" class="form-control" placeholder="Eski parol">
			</div>
			<div class="form-group">
				<input name="password" type="password" class="form-control" placeholder="Yangi parol">
			</div>
			<div class="form-group">
				<input name="repeatpassword" type="password" class="form-control" placeholder="Yangi parolni qayta kiriting">
			</div>
			<br>
			<input class="col-md-3 mr-auto btn btn-block btn-primary text-light" type="submit" value="Kiritish"/>
                    <!-- END INBOX CONTENT -->
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- END INBOX -->
