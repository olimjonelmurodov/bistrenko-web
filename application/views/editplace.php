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
		<form action="<?php echo site_url('places/saveplace?id=').$id; ?>" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<input name="uzbek" type="text" class="form-control" placeholder="O'zbekcha nomi" value = "<?=isset($data[0]->uzbek)?$data[0]->uzbek:""?>">
			</div>
			<div class="form-group">
				<input name="russian" type="text" class="form-control" placeholder="Ruscha nomi" value = "<?=isset($data[0]->russian)?$data[0]->russian:""?>">
			</div>
			<div class="form-group">
				<label>Xizmat turkumini tanlang:</label>
				<select name="menuid[]" class="form-control" required multiple>
				<?php foreach ($menus as $class){
					if (in_array($class->id, $place_menus)) {
					    echo '<option value="'.$class->id.'" selected>'.$class->uzbek.'</option>';
                                        }
					else{
					    echo '<option value="'.$class->id.'">'.$class->uzbek.'</option>';
                                        }
					}
					?>
				</select>
			</div>
			<div class="form-group">
				<input name="latitude" type="text" class="form-control" placeholder="Ruscha nomi" value = "<?=isset($data[0]->latitude)?$data[0]->latitude:""?>">
			</div>
			<div class="form-group">
				<input name="longitude" type="text" class="form-control" placeholder="Ruscha nomi" value = "<?=isset($data[0]->longitude)?$data[0]->longitude:""?>">
			</div>
			<div class="form-group">
				<input name="menulink" type="text" class="form-control" placeholder="Menyu havolasi" value = "<?=isset($data[0]->uzbek)?$data[0]->menulink:""?>">
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
