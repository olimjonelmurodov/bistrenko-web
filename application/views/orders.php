<?php
function boldread($s, $cond){
        return $cond?$s:'<b>'.$s.'</b>';
}
function printnum($value, $type){
    if ($type){
        return number_format(($value), 2, ',', ' ');}
    else
        return number_format(($value), 0, ',', ' ');
        
}
?>
<div class="col-md-12">
        <div class="grid email">
                <div class="grid-body">
                        <div class="row">
                                <!-- BEGIN INBOX MENU -->
                                <div class="col-md-12 p-3 d-flex">
                                        <div class="flex-grow-1">
                                                <h2 class="grid-title" style="display:inline-block;margin-right:10px;">Buyurtmalar</h2>
                                        </div>
                                        <form class="form-inline mr-auto ">
                                                <input type="text" name="search" class="mr-1 form-control" value="<?=$search?>" placeholder="Qidirish...">
                                                <button type="submit" class="mr-2 btn btn-primary"><i class="fa fa-search"></i> Qidirish</button>
                                                <button type="button" id="btnExport" class="mr-2 btn btn-success"><i class="fa fa-file-excel"></i> Eksport qilish</a>
                                                <button type="button" id="btnDelete" class="btn btn-danger"><i class="fa fa-trash"></i> O'chirish</a>
                                        </form>
                                </div>
                        </div>
                        <!-- END INBOX MENU -->

                        <!-- BEGIN INBOX CONTENT -->
                        <div class="col-md-12">
                                <div class="row">
                                <div class="table-responsive">
                                        <table class="table table-striped table-sm">
                                        <thead>
                                                <tr>
                                                        <th><input type="checkbox" id='select-all'></th>
                                                        <th>#</th>
                                                        <th>Mijoz telefoni</th>
                                                        <th>Manzili</th>
                                                        <th>Jami narxi</th>
                                                        <th>Ko'rsatilgan narxi</th>
                                                        <th>Sana</th>
                                                        <th>Yuborildimi?</th>
                                                        <th></th>
                                                        <th></th>
                                                </tr>
                                                </thead>
                                                <tbody>
<?php
$i=1;
$sendalluzs = 0;
$sendallcny = 0;
$rcvalluzs = 0;
$rcvallcny = 0;
$comalluzs = 0;
$comallcny = 0;
$overalluzs = 0;
$overallcny = 0;
foreach($data as $item) {
        echo '<tr>';
        echo '<td class="name"><input type="checkbox" name="select[]" value="'.$item->id.'"></td>';
        echo '<td class="name"><a href="'.site_url('orders/vieworder?id=').$item->id.'">'.boldread($item->id, $item->is_read).'</a></td>';
        echo '<td class="name"><a href="'.site_url('orders/vieworder?id=').$item->id.'">'.boldread($item->phone, $item->is_read).'</a></td>';
        echo '<td class="name"><a href="'.site_url('orders/vieworder?id=').$item->id.'">'.boldread($item->orientation, $item->is_read).'</a></td>';
        echo '<td class="name"><a href="'.site_url('orders/vieworder?id=').$item->id.'">'.boldread(number_format(intval($item->price/100), 0, ',', ' ').' so\'m', $item->is_read).'</a></td>';
        echo '<td class="name"><a href="'.site_url('orders/vieworder?id=').$item->id.'">'.boldread(number_format(intval($item->shown_price/100), 0, ',', ' ').' so\'m', $item->is_read).'</a></td>';
        echo '<td class="name"><a href="'.site_url('orders/vieworder?id=').$item->id.'">'.boldread($item->date, $item->is_read).'</a></td>';
        if ($item->status==-1){
                $s = '<p class="text-danger"><b>'."Bekor qilindi".'</b></p>';
                $actions = '';
        }
        else if ($item->status==0){
                $s = '<p class="text-warning"><b>'."Xodim tasdiqlashi kutilmoqda".'</b></p>';
                $actions='';
        }
        else if ($item->status==2){
                $s = '<p class="text-warning"><b>'."Kuryer tasdiqlashi kutilmoqda".'</b></p>';
                $actions='';
        }
        else if ($item->status==3){
                $s = '<p class="text-warning"><b>'."Buyurtma tayyorlanayapti".'</b></p>';
                $actions='';
        }
        else if ($item->status==4){
                $s = '<p class="text-warning"><b>'."Yo'lda".'</b></p>';
                $actions='';
        }
        else if ($item->status==1){
                $s = '<p class="text-success"><b>'."Yetkazildi".'</b></p>';
                $actions = '';
        }
        echo '<td class="name"><a href="'.site_url('orders/vieworder?id=').$item->id.'">'.boldread($s, $item->is_read).'</a></td>';
        if (hasadminrights()){
                echo '<td class="action text-right">'.$actions.'</td>';
                echo '<td class="action text-right">
                <a class="btn btn-success btn-sm text-white" href="'.site_url('orders/vieworder?id=').$item->id.'"><i class="fa fa-eye fa-fw"></i></a>
                <a class="btn btn-danger btn-sm text-white delete" href="'.site_url('orders/deleteorder?id=').$item->id.'" data-confirm="Aniq o\'chirmoqchimisiz?"><i class="fa fa-trash fa-fw"></i></a>
                </td>';
        }
        else{
                echo '<td class="action text-right">
                <a class="btn btn-success btn-sm text-white" href="'.site_url('orders/vieworder?id=').$item->id.'"><i class="fa fa-eye fa-fw"></i></a>
                </td>';
        }
        echo '</tr>';
}

?>

                                                        </tbody></table>
                                                </div>
                                                <nav aria-label="Page navigation example">
                                                    <ul class="pagination">
                            <?php
                            if ($search)
                                $val="&search=".$search;
                            else
                                $val="";
                            if ($start>0){
                            ?>
                                                        <li class="page-item"><a class="page-link" href="<?=site_url('orders?start='.($start-$limit).$val)?>">Oldingisi</a></li>
                            <?php
                            }
                            $c = ($count / $limit);
                            if ($c>1)
                            for($i=1; $i<=$c; $i++){
                            ?>

                                                        <li class="page-item"><a class="page-link" href="<?=site_url('orders?start='.(($i-1)*$limit).$val)?>"><?=$i?></a></li>
                            <?php
                            }
                            if ($start + $limit<$count){
                            ?>
                                                        <li class="page-item"><a class="page-link" href="<?=site_url('orders?start='.($start+$limit).$val)?>">Keyingisi</a></li>
                            <?php
                            }
                            ?>
                                                    </ul>
                                                </nav>
                                </div>
                        </div>
                </div>
        </div>
</div>
<!-- END INBOX -->
<script>
(function() {
    var deleteLinks = document.querySelectorAll('.delete');
    for (var i = 0; i < deleteLinks.length; i++) {
      deleteLinks[i].addEventListener('click', function(event) {
          event.preventDefault();

          var choice = confirm(this.getAttribute('data-confirm'));

          if (choice) {
            window.location.href = this.getAttribute('href');
          }
      });
    }
    var elements = document.getElementsByName('select[]');
    var n;
    for (n = 0; n < elements.length; ++n)
        elements[n].onclick = checkboxClicked;
    document.getElementById('btnExport').onclick=postExport
    document.getElementById('btnDelete').onclick=postDelete
})()
function setBtnName(condition)
{
  if (condition) {
    document.getElementById('btnDelete').innerHTML='<i class="fa fa-trash"></i> Tanlanganlarni o\'chirish';
    document.getElementById('btnExport').innerHTML='<i class="fa fa-file-excel"></i> Tanlanganlarni eksport qilish';
  }
  else
  {
    document.getElementById('btnDelete').innerHTML='<i class="fa fa-trash"></i> O\'chirish';
    document.getElementById('btnExport').innerHTML='<i class="fa fa-file-excel"></i> Eksport qilish';
  }
}
document.getElementById('select-all').onclick=function () {
  var checkboxes = document.getElementsByName('select[]');
  var toggleVal = document.getElementById('select-all').checked;
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = toggleVal;
  }
  setBtnName(toggleVal && checkboxes.length>0);
}
function checkboxClicked() {
  var checkboxes = document.getElementsByName('select[]');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    if (checkboxes[i].checked){
      setBtnName(true);
      return true;
    }
    setBtnName(false);
  }
}
function postExport(){
  var checkboxes = document.getElementsByName('select[]');
  var data = [];
  for(var i=0, n=checkboxes.length;i<n;i++) {
    data.push({key: checkboxes[i].value,  value: checkboxes[i].checked});
  }
  post("<?=$search?site_url('orders/export?search='.$search):site_url('orders/export')?>", JSON.stringify(data));
//    window.location.href="<?=site_url('orders/export?search='.$search)?>";
}
function postDelete(){
  if (confirm('Aniq tanlanganlarni o\'chirmoqchimisiz? (Agar hech narsa tanlanmagan bo\'lsa shu sahifadagi HAMMA buyurtmalar o\'chiriladi.')) {
    var checkboxes = document.getElementsByName('select[]');
    var data = [];
    for(var i=0, n=checkboxes.length;i<n;i++) {
      data.push({key: checkboxes[i].value,  value: checkboxes[i].checked});
    }
    post("<?=$search?site_url('orders/deletemarked?search='.$search):site_url('orders/deletemarked')?>", JSON.stringify(data));
  }
}
function post(path, params, method='post') {

  // The rest of this code assumes you are not using a library.
  // It can be made less wordy if you use one.
  const form = document.createElement('form');
  form.method = method;
  form.action = path;

  for (const key in params) {
    if (params.hasOwnProperty(key)) {
      const hiddenField = document.createElement('input');
      hiddenField.type = 'hidden';
      hiddenField.name = key;
      hiddenField.value = params[key];

      form.appendChild(hiddenField);
    }
  }

  document.body.appendChild(form);
  form.submit();
}
</script>
