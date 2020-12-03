<div class="col-md-12">
		<div class="grid email">
			<div class="grid-body">
				<div class="row">
					<!-- BEGIN INBOX MENU -->
					<div class="col-md-3 p-3">
						<h2 class="grid-title"><?=$desc?></h2>
						</div>
					</div>
					<!-- END INBOX MENU -->
					
                    <!-- BEGIN INBOX CONTENT -->
					<form action="<?php echo site_url('settings/savesetting?id=').$id; ?>" method="post" enctype="multipart/form-data">
<?php if ($data[0]->type==0){?>
			<div class="form-group">
				<textarea name="uzbek" rows="6" type="text" class="form-control" placeholder="O'zbekcha qiymati"><?=isset($data[0]->value)?$data[0]->value:""?></textarea>
			</div>
			<div class="form-group">
				<textarea name="russian" rows="6" type="text" class="form-control" placeholder="Ruscha qiymati (bo'sh qoldirilgan holda o'zbekcha qiymat olinadi)"><?=isset($data[0]->textvalue_ru)?$data[0]->textvalue_ru:""?></textarea>
			</div>
<?php } else if ($data[0]->type==4){?>
<script src="http://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.js"></script>
<link href="http://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.css" rel="stylesheet"/>
			<div class="form-group">
				<input name="time" id="time" placeholder="Vaqt" value = "<?=isset($data[0]->value)?$data[0]->value:""?>"></textarea>
			</div>
<script>
var timepicker = new TimePicker('time', {
  lang: 'en',
  theme: 'dark'
});

var input = document.getElementById('time');

timepicker.on('change', function(evt) {
  
  var value = (evt.hour || '00') + ':' + (evt.minute || '00');
  evt.element.value = value;

});
</script>
<?php } else if ($data[0]->type==3){?>
			<div class="form-group">
				<input name="number" type="number" step="0.01" min="0" class="form-control" placeholder="Raqam" value = "<?=isset($data[0]->value)?$data[0]->value:""?>"></textarea>
			</div>
<?php } else if ($data[0]->type==5){?>
			<div class="form-group">
				<input name="number" type="text" class="form-control" placeholder="Parol" value = "<?=isset($data[0]->value)?$data[0]->value:""?>"></textarea>
			</div>
<?php } else if ($data[0]->type==6){?>
			<div class="form-group">
                                <label>Holatni tanlang:</label>
                                <select name="number" class="form-control" required>
                                        <?php if (isset($data[0]->value) and intval($data[0]->value)==1){?>
                                                <option value="1" selected="selected">Ha</option>
                                                <option value="0">Yo'q</option>
                                        <?php } else {?>
                                                <option value="1">Ha</option>
                                                <option value="0" selected="selected">Yo'q</option>
                                        <?php }?>
                                </select>
			</div>
<?php } else if ($data[0]->type==1){?>
			<div class="form-group">
			    <input name="latitude" class="form-control" placeholder="Kenglik" value="<?=isset($data[0]->value)?(json_decode($data[0]->value)->latitude):""?>">
			</div>
			<div class="form-group">
			    <input name="longitude" class="form-control" placeholder="Uzunlik" value="<?=isset($data[0]->value)?(json_decode($data[0]->value)->longitude):""?>">
			</div>
<?php } else if ($data[0]->type==2){?>
			<div class="form-group">
				<textarea name="uzcontent" rows="6" type="text" class="form-control" placeholder="O'zbekcha matn"><?=isset($data[0]->value)?$data[0]->value:""?></textarea>
			</div>
			<div class="form-group">
				<textarea name="rucontent" rows="6" type="text" class="form-control" placeholder="Ruscha matn (bo'sh qoldirilgan holda o'zbekcha matn olinadi)"><?=isset($data[0]->textvalue_ru)?$data[0]->textvalue_ru:""?></textarea>
			</div>
			<div class="form-group">
			    <label>Rasmni tanlang:</label>
			    <input name="image" type="file" class="form-control">
			</div>
<?php }?>
			<br>
			<input class="col-md-3 mr-auto btn btn-block btn-primary text-light" type="submit" value="Kiritish"/>
                    <!-- END INBOX CONTENT -->
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- END INBOX -->
