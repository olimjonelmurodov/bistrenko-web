<div class="col-md-12">
		<div class="grid email">
			<div class="grid-body">
				<div class="row">
					<!-- BEGIN INBOX MENU -->
					<div class="col-md-3 p-3">
						<h2 class="grid-title"><?=$categoryname?></h2>
						</div>
					</div>
					<!-- END INBOX MENU -->
					
                    <!-- BEGIN INBOX CONTENT -->
		<form action="<?php echo site_url('categories/savecategory?id=').$id; ?>" method="post">
			<div class="form-group">
				<input name="uzbek" type="text" class="form-control" placeholder="O'zbekcha nomi" value = "<?=isset($data[0]->uzbek)?$data[0]->uzbek:""?>">
			</div>
			<div class="form-group">
				<input name="russian" type="text" class="form-control" placeholder="Ruscha nomi" value = "<?=isset($data[0]->russian)?$data[0]->russian:""?>">
			</div>
			<div class="form-group">
				<label>Yetkazib beruvchini tanlang:</label>
				<select name="placeid" class="form-control" required>
					<?php var_dump($data[0]->placeid);?>
				<?php foreach ($places as $class){
					if (isset($data[0]->placeid) and $class->id == $data[0]->placeid){
					    echo '<option value="'.$class->id.'" selected>'.$class->uzbek.'</option>';
                                        }
					else{
					    echo '<option value="'.$class->id.'">'.$class->uzbek.'</option>';
                                        }
					}
					?>
			</select>
			<br>
			<input class="col-md-3 mr-auto btn btn-block btn-primary text-light" type="submit" value="Kiritish"/>
                    <!-- END INBOX CONTENT -->
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- END INBOX -->
