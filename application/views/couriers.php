<div class="col-md-12">
	<div class="grid email">
		<div class="grid-body">
			<div class="row">
				<!-- BEGIN INBOX MENU -->
				<div class="col-md-12 p-3 d-flex">
					<div class="flex-grow-1">
						<h2 class="grid-title">Kuryerlar</h2>
					</div>
<?php if (hasadminrights()){?>     
					<div class="ml-auto">
                                        <form class="form-inline mr-auto ">
                                                <input type="text" name="search" class="mr-1 form-control" value="<?=$search?>" placeholder="Qidirish...">
                                                <button type="submit" class="mr-2 btn btn-primary"><i class="fa fa-search"></i> Qidirish</button>
						<a class="btn btn-primary text-light" data-toggle="modal" data-target="#compose-modal"><i class="fa fa-plus"></i>&nbsp;&nbsp;Yangi Kuryer</a>
						</form>						
<?php }?>  
				</div>
			</div>
			<!-- END INBOX MENU -->
			
			<!-- BEGIN INBOX CONTENT -->
			<div class="col-md-12">
				<div class="row">
				<div class="table-responsive">
					<table class="table table-striped table-sm">
					<thead><tr>
						<th>#</th>
						<th>Telefon nomeri</th>
						<th>Ismi</th>
						<th>Telegram ID</th>
						<th>Maxfiy kod</th>
						<th></th>
						</thead>
						<tbody><?php
							$i=$start+1;
							foreach($data as $item) {
		echo '<tr>';
		echo '<td class="name">'.$i++.'</td>';
		echo '<td class="name">'.$item->phone.'</td>';
		echo '<td class="name">'.$item->name.'</td>';
		echo '<td class="name">'.$item->userid.'</td>';		
		echo '<td class="name">'.$item->code.'</td>';		
		echo '<td class="action text-right">
                <a class="btn btn-primary btn-sm text-white" onclick="copyPassword(\''.$item->code.'\', 0)" href="#"><i class="fa fa-copy fa-fw"></i></a>
                <a class="btn btn-primary btn-sm text-white delete" href="'.site_url('couriers/editcourier?id=').$item->id.'"><i class="fa fa-pencil-alt fa-fw"></i></a>
                <a class="btn btn-danger btn-sm text-white delete" href="'.site_url('couriers/deletecourier?id=').$item->id.'" data-confirm="Aniq o\'chirmoqchimisiz?"><i class="fa fa-trash fa-fw"></i></a>
                </td>';
		echo '</tr>';
}
?>

							</tbody></table>
						</div>
						<div class="snackbar">Nusxa qilindi</div>

						<nav aria-label="Page navigation example">
							<ul class="pagination">
						<?php
			   if ($search)
			      $val="&search=".$search;
			  else
			      $val="";
                            if ($start>0){
                            ?>
                                                        <li class="page-item"><a class="page-link" href="<?=site_url('servers?start='.($start-$limit).$val)?>">Oldingisi</a></li>
                            <?php
                            }
                            $c = ($count / $limit);
                            if ($c>1)
                            for($i=1; $i<=$c; $i++){
                            ?>

                                                        <li class="page-item"><a class="page-link" href="<?=site_url('servers?start='.(($i-1)*$limit).$val)?>"><?=$i?></a></li>
                            <?php
                            }
                            if ($start + $limit<$count){
                            ?>
                                                        <li class="page-item"><a class="page-link" href="<?=site_url('servers?start='.($start+$limit).$val)?>">Keyingisi</a></li>
                            <?php
                            }
                            ?>

							</ul>
						</nav>
					<!-- BEGIN COMPOSE MESSAGE -->
					<div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true">
						<div class="modal-wrapper">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header bg-blue">
										<div class="d-flex  bd-highlight">
										  <div class="p-2 bd-highlight"><h4 class="modal-title">Yangi Kuryer</h4></div>
										</div>
										<div class="d-flex flex-row-reverse bd-highlight">
										  <div class="p-2 bd-highlight"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button></div>
										</div>
									</div>
									<form action="<?php echo site_url('couriers/addcourier') ?>" method="post">
										<div class="modal-body">
											<div class="form-group">
												<input name="phone" type="text" class="form-control" placeholder="Telefon raqami">
											</div>
											<div class="form-group">
												<input name="name" type="text" class="form-control" placeholder="Ismi">
											</div>
											<div class="form-group d-flex">
												<input name="code" maxlength="8" id="codetxt" type="text" class="form-control" placeholder="Maxfiy kod" required>
												<button type="button" id="randomBtn" class="btn btn-primary btn-xs" style="margin-left: 5px;"><i class="fa fa-key"></i></button>
												<div class="snackbar">Nusxa qilindi (Copied)</div>
												</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Bekor qilish</button>
											<button type="submit" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Kuryer qo'shish</button>
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
randomBtn.onclick=function(){
	var txt = generatePassword();
	document.getElementById('codetxt').value=txt;
	copyPassword(txt, 1);
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
