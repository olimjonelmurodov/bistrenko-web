<div class="col-md-12">
		<div class="grid email">
			<div class="grid-body">
				<div class="row">
					<!-- BEGIN INBOX MENU -->
					<div class="col-md-3 p-3">
						<h2 class="grid-title"><?=isset($data[0]->phone)?$data[0]->phone:""?></h2>
						</div>
					</div>
					<!-- END INBOX MENU -->
					
                    <!-- BEGIN INBOX CONTENT -->
		<form action="<?php echo site_url('servers/saveserver?id=').$id; ?>" method="post">
			<div class="form-group">
				<input name="phone" type="text" class="form-control" placeholder="Telefon raqami" value = "<?=isset($data[0]->phone)?$data[0]->phone:""?>">
			</div>
			<div class="form-group">
				<input name="name" type="text" class="form-control" placeholder="Ismi" value = "<?=isset($data[0]->name)?$data[0]->name:""?>">
			</div>
			<div class="form-group d-flex">
				<input name="code" id="codetxt" type="text" class="form-control" placeholder="Maxfiy kod" value = "<?=isset($data[0]->code)?$data[0]->code:""?>">
				<button type="button" id="randomBtn" class="btn btn-primary btn-xs" style="margin-left: 5px;"><i class="fa fa-key"></i></button>
				<div class="snackbar">Nusxa qilindi (Copied)</div>
			</div>
			<div class="form-group">
				<label>Yetkazib beruvchini tanlang:</label>
				<select name="placeid" class="form-control" required>
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
<script>
randomBtn.onclick=function(){
	var txt = generatePassword();
	document.getElementById('codetxt').value=txt;
	copyPassword(txt, 0);
}
function copyPassword(txt, snackid){
	if (txt){
		copyTextToClipboard(txt);
		fallbackCopyTextToClipboard(txt);
		var x = document.getElementsByClassName("snackbar")[snackid];
		x.className = "snackbar show";
		x.innerHTML = '"'+txt+'" nusxa qilindi'
		setTimeout(function(){ x.className = x.className.replace("snackbar show", "snackbar"); }, 3000);		
	}
}

function generatePassword() {
    var length = 8,
        charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789",
        retVal = "";
    for (var i = 0, n = charset.length; i < length; ++i) {
        retVal += charset.charAt(Math.floor(Math.random() * n));
    }
    return retVal;
}
function fallbackCopyTextToClipboard(text) {
  var textArea = document.createElement("textarea");
  textArea.value = text;
  
  // Avoid scrolling to bottom
  textArea.style.top = "0";
  textArea.style.left = "0";
  textArea.style.position = "fixed";

  document.body.appendChild(textArea);
  textArea.focus();
  textArea.select();

  try {
    var successful = document.execCommand('copy');
    var msg = successful ? 'successful' : 'unsuccessful';
    console.log('Fallback: Copying text command was ' + msg);
  } catch (err) {
    console.error('Fallback: Oops, unable to copy', err);
  }

  document.body.removeChild(textArea);
}
function copyTextToClipboard(text) {
  if (!navigator.clipboard) {
    fallbackCopyTextToClipboard(text);
    return;
  }
  navigator.clipboard.writeText(text).then(function() {
    console.log('Async: Copying to clipboard was successful!');
  }, function(err) {
    console.error('Async: Could not copy text: ', err);
  });
}</script>
