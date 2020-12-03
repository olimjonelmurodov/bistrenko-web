<div class="col-md-12">
	<div class="grid email">
		<div class="grid-body">
			<div class="row">
				<!-- BEGIN INBOX MENU -->
				<div class="col-md-9 p-3 d-flex">
					<div class="flex-grow-1">
						<h2 class="grid-title">Foydalanuvchilar</h2>
					</div>
					<div class="ml-auto">
						<a class="btn btn-block btn-primary text-light" data-toggle="modal" data-target="#compose-modal"><i class="fa fa-plus"></i>&nbsp;&nbsp;Yangi Foydalanuvchi</a>
					</div>
				</div>
			</div>
			<!-- END INBOX MENU -->
			
			<!-- BEGIN INBOX CONTENT -->
			<div class="col-md-9">
				<div class="row">
				<div class="table-responsive">
					<table class="table table-striped table-sm">
					<thead><tr>
						<th>#</th>
						<th>Login</th>
						<th>Turi</th>
						<th></th>
						</thead>
						<tbody><?php
							$i=1;
							foreach($data as $item) {
	echo '<tr>';
		echo '<td class="name">'.$i++.'</td>';
        echo '<td class="name"><a>'.$item->username.'</a></td>';
        echo '<td class="name"><a>'.($item->privilege==0?'Admin':'Oddiy foydalanuvchi').'</a></td>';
        echo '<td class="action text-right">
			<a class="btn btn-danger btn-sm text-white" href="'.site_url('auth/deleteauth?id=').$item->id.'"><i class="fa fa-trash fa-fw"></i></a> 
        </td>';
    echo '</tr>';
}
?>

							</tbody></table>
						</div>
					<!-- END INBOX CONTENT -->
					
					<!-- BEGIN COMPOSE MESSAGE -->
					<div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true">
						<div class="modal-wrapper">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header bg-blue">
										<div class="d-flex  bd-highlight">
										  <div class="p-2 bd-highlight"><h4 class="modal-title">Yangi Foydalanuvchi</h4></div>
										</div>
										<div class="d-flex flex-row-reverse bd-highlight">
										  <div class="p-2 bd-highlight"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button></div>
										</div>
									</div>
									<form action="<?php echo site_url('auth/addauth') ?>" method="post">
										<div class="modal-body">
											<div class="form-group">
												<input name="username" type="text" class="form-control" placeholder="Login">
											</div>
											<div class="form-group">
												<input name="password" id="password" type="password" class="form-control" placeholder="Parol" oninput="check_pass();">
											</div>
											<div class="form-group">
												<input name="repeat_password" id="repeat_password" type="password" class="form-control" placeholder="Parolni qaytaring" oninput="check_pass();">
											</div>
                                                                                        <div class="form-group">
                                                                                                <label>Foydalanuvchi turini tanlang:</label>
                                                                                                <select name="privilege" class="form-control" required>
                                                                                                        <option value="0">Administrator</option>
                                                                                                        <option value="1">Oddiy foydalanuvchi</option>
                                                                                                </select>
                                                                                        </div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Bekor qilish</button>
											<button type="submit" id="submit" class="btn btn-primary pull-right" disabled><i class="fa fa-plus"></i> Foydalanuvchi qo'shish</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
					<!-- END COMPOSE MESSAGE -->
				</div>
			</div>
		</div>
	</div>
</div>
	<!-- END INBOX -->
<script>
function check_pass() {
    if (document.getElementById('password').value ==
            document.getElementById('repeat_password').value) {
        document.getElementById('submit').disabled = false;
    } else {
        document.getElementById('submit').disabled = true;
    }
}

</script>
