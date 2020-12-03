<div class="col-md-12">
	<div class="grid email">
		<div class="grid-body">
			<div class="row">
				<!-- BEGIN INBOX MENU -->
				<div class="col-md-9 p-3">
					<h2 class="grid-title">Sozlanmalar</h2>
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
						<th>Ma'lumot</th>
						<th>Qiymat</th>
						<th>Turi</th>
						<th></th>
						</thead>
						<tbody><?php
							$i=1;
							foreach($data as $item) {
	echo '<tr>';
	echo '<td class="name">'.$i++.'</td>';
        if (hasadminrights()){        
                echo '<td class="name"><a href="'.site_url('settings/editsetting?id=').$item->id.'">'.$item->desc.'</a></td>';
                echo '<td class="name"><a href="'.site_url('settings/editsetting?id=').$item->id.'">'.
($item->type==1?'Kenglik: '.json_decode($item->value)->latitude.', Uzunlik: '.json_decode($item->value)->longitude:
(($item->type==6 and intval($item->value)==1)?'Ha':(($item->type==6 and intval($item->value)==0)?'Yo\'q':number_format($item->value, 0, ',', ' '))))
.'</a></td>';
                echo '<td class="name"><a href="'.site_url('settings/editsetting?id=').$item->id.'">'.
($item->type==0?"Tekst":($item->type==1?"Joylashuv":($item->type==2?"Rasm":($item->type==4?"Vaqt":($item->type==5?"Parol":($item->type==6?"Holat":"Raqam")))))).'</a></td>';
                echo '<td class="action text-right">
                <a class="btn btn-primary btn-sm text-white" href="'.site_url('settings/editsetting?id=').$item->id.'"><i class="fa fa-pencil-alt fa-fw"></i></a> 
                </td>';
        } else{
                echo '<td class="name"><a>'.$item->desc.'</a></td>';
                echo '<td class="name"><a>'.($item->type==1?'Kenglik: '.json_decode($item->value)->latitude.', Uzunlik: '.json_decode($item->value)->longitude:($item->value)).'</a></td>';
                echo '<td class="name"><a>'.($item->type==0?"Tekst":($item->type==1?"Joylashuv":($item->type==2?"Rasm":"Raqam"))).'</a></td>';                
                }
    echo '</tr>';
}
?>

							</tbody></table>
						</div>
					<!-- END INBOX CONTENT -->
				</div>
			</div>
		</div>
	</div>
</div>
	<!-- END INBOX -->
