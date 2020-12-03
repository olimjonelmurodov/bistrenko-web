<div class="col-md-12">
		<div class="grid email">
			<div class="grid-body">
				<div class="row">
					<!-- BEGIN INBOX MENU -->
					<div class="col-md-3 p-3">
						<h2 class="grid-title"><?=($data[0]->uzbek)?></h2>


						</div>
					</div>
					<!-- END INBOX MENU -->
					
                    <!-- BEGIN INBOX CONTENT -->
		<form action="<?php echo site_url('menus/savemenu?id=').$id; ?>" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<input name="uzbek" type="text" class="form-control" placeholder="O'zbekcha nomi" value = "<?=isset($data[0]->uzbek)?$data[0]->uzbek:""?>">
			</div>
			<div class="form-group">
				<input name="russian" type="text" class="form-control" placeholder="Ruscha nomi" value = "<?=isset($data[0]->russian)?$data[0]->russian:""?>">
			</div>
			<br><br>
			<input class="col-md-3 mr-auto btn btn-block btn-primary text-light" type="submit" value="Kiritish"/>
                    <!-- END INBOX CONTENT -->
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- END INBOX -->
