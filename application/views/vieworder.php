<div class="col-md-12">
		<div class="grid email">
			<div class="grid-body">
				<div class="row">
					<!-- BEGIN INBOX MENU -->
					<div class="col-md-3 p-3">
						<h2 class="grid-title"><?=$data[0]->name?></h2>


						</div>
					</div>
					<!-- END INBOX MENU -->

                    <!-- BEGIN INBOX CONTENT -->
			<div class="form-group">
				<p>Buyurtma raqami: <?=$data[0]->id?></p>
			</div>
			<div class="form-group">
				<p>Buyurtmachining nomi: <?=$data[0]->name?></p>
			</div>
			<div class="form-group">
				<p>Buyurtmachining telefoni: <?=$data[0]->phone?></p>
			</div>

<?php
if ($data[0]->longitude and $data[0]->latitude and $data[0]->orientation){
?>
<iframe
width="300"
height="170"
frameborder="0"
scrolling="no"
marginheight="0"
marginwidth="0"
src="https://maps.google.com/maps?q=<?=$data[0]->latitude?>,<?=$data[0]->longitude?>&hl=uz&z=14&amp;output=embed"
>
</iframe>
<div class="form-group">
	<p>Buyurtmachining manzili: <?=$data[0]->orientation?></p>
</div>
<?php
} else if ($data[0]->orientation) {
?>
			<div class="form-group">
				<p>Buyurtmachining manzili: <?=$data[0]->orientation?></p>
			</div>
<?php
}
?>
			<div class="form-group">
				<p>Buyurtmani yetkazish turi: <?=($data[0]->deliverytype)?"Olib ketish":"Yetkazib berish"?></p>
			</div>
			<div class="form-group">
				<p>Buyurtma holati: <?=($data[0]->status)?"Yetkazilgan":"Yetkazilmagan"?></p>
			</div>
			<div class="form-group">
				<p>Buyurtma vaqti: <?=($data[0]->date)?></p>
			</div>
			<div class="col-md-9">
				<div class="row">
<?php
$html='<div class="table-responsive"><table class="table table-striped table-sm">
<thead><tr>
<th class="name">#</th>
<th class="name">Mahsulot nomi</th>
<th class="name">Mahsulot miqdori</th>
<th class="name">Narxi</th>
<th class="name">Jami</th>
</thead>
<tbody>';


$i=1;
$f=0;
foreach($products as $item) {
        $html.='<tr>';
        $html.='<td class="name">'.$i++.'</td>';
        $html.='<td class="name">'.$item->uzbek.'</td>';
        $html.='<td class="name">'.$item->value.'</td>';
        $html.='<td class="name">'.number_format(intval($item->price/100), 0, ',', ' ').' so\'m </td>';
        $html.='<td class="name">'.number_format(intval($item->price*$item->value/100), 0, ',', ' ').' so\'m</td>';
        $html.='</tr>';
	$f = $f + $item->price*$item->value;
}
$html.='</tbody></table></div></div></div>';
echo $html;
$html='<div class="form-group"><p>Buyurtma vaqti: '.$data[0]->date.'</p></div>'.$html;
$html='<div class="form-group"><p>Buyurtma raqami: '.$data[0]->id.'</p></div>'.$html;
$html = str_replace(' class="table table-striped table-sm"', ' style="border: 1px solid black; border-collapse:collapse;"', $html);
$html = str_replace(' class="name"', ' style="border: 1px solid black; border-collapse:collapse;  padding: 5px;" ', $html);
$html='<style type="text/css" media="print">
@page {
    size: auto;   /* auto is the initial value */
    margin: 0;  /* this affects the margin in the printer settings */
}
</style>'.$html;
//var_dump('<xmp>'.$html.'</xmp>');
?>
                                <div class="form-group">
                                        <p>Buyurtma narxi: <?=number_format(intval($f/100), 0, ',', ' ')?> so'm</p>
                                </div>
                                </div>
			</div>
		</div>
	</div>
        <div id="divToPrint" style="display:none;">
          <div style="width:1000px;height:700px;">
                   <?php echo $html; ?>
          </div>
        </div>	<!-- END INBOX -->
<script type="text/javascript">
    function PrintDiv() {
        var divToPrint = document.getElementById('divToPrint');
        var popupWin = window.open('', '_blank', 'width=1000,height=700');
        popupWin.document.open();
        popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
        popupWin.document.close();
    }
</script>
