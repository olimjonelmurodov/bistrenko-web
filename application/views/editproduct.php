<div class="col-md-12">
		<div class="grid email">
			<div class="grid-body">
				<div class="row">
					<!-- BEGIN INBOX MENU -->
					<div class="col-md-3 p-3">
						<h2 class="grid-title"><?=$productname?></h2>


						</div>
					</div>
					<!-- END INBOX MENU -->
					
                    <!-- BEGIN INBOX CONTENT -->
		<form action="<?php echo site_url('products/saveproduct?id=').$id; ?>" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<input name="uzbek" type="text" class="form-control" placeholder="O'zbekcha nomi" value = "<?=isset($data[0]->uzbek)?$data[0]->uzbek:""?>">
			</div>
			<div class="form-group">
				<input name="russian" type="text" class="form-control" placeholder="Ruscha nomi" value = "<?=isset($data[0]->russian)?$data[0]->russian:""?>">
			</div>
			<div class="form-group">
				<input name="price" type="number" class="form-control" placeholder="Narx" value = "<?=isset($data[0]->price)?intval($data[0]->price)/100:""?>">
			</div>
			<div class="form-group">
			    <textarea name="desc_uz" rows="6" class="form-control" placeholder="O'zbekcha ma'lumot"><?=isset($data[0]->desc_uz)?$data[0]->desc_uz:""?></textarea>
			</div>
			<div class="form-group">
			    <textarea name="desc_ru" rows="6" class="form-control" placeholder="Ruscha ma'lumot"><?=isset($data[0]->desc_ru)?$data[0]->desc_ru:""?></textarea>
			</div>
                        <div class="form-group">
				<input name="maxcount" type="number" class="form-control" placeholder="Maksimal miqdori" value = "<?=isset($data[0]->maxcount)?$data[0]->maxcount:""?>">
			</div>
			<div class="form-group">
			    <label>Rasmni tanlang (o'zgartirilmasa oldingi rasm qoladi):</label>
			    <input name="image" type="file" class="form-control">
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
