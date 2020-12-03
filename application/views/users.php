<div class="col-md-12">
	<div class="grid email">
		<div class="grid-body">
			<div class="row">
				<!-- BEGIN INBOX MENU -->
				<div class="col-md-9 p-3">
					<h2 class="grid-title">Telegram bot foydalanuvchilari</h2>
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
						<th>Telefon nomeri</th>
						<th>Telegram ID</th>
						</thead>
						<tbody><?php
							$i=$start+1;
							foreach($data as $item) {
	echo '<tr>';
	echo '<td class="name">'.$i++.'</td>';
        echo '<td class="name">'.$item->phone.'</td>';
		echo '<td class="name">'.$item->userid.'</td>';		
    echo '</tr>';
}
?>

							</tbody></table>
						</div>
						<nav aria-label="Page navigation example">
							<ul class="pagination">
						<?php
                            if ($start>0){
                            ?>
                                                        <li class="page-item"><a class="page-link" href="<?=site_url('users?start='.($start-$limit))?>">Oldingisi</a></li>
                            <?php
                            }
                            $c = ($count / $limit);
                            if ($c>1)
                            for($i=1; $i<=$c; $i++){
                            ?>

                                                        <li class="page-item"><a class="page-link" href="<?=site_url('users?start='.(($i-1)*$limit))?>"><?=$i?></a></li>
                            <?php
                            }
                            if ($start + $limit<$count){
                            ?>
                                                        <li class="page-item"><a class="page-link" href="<?=site_url('users?start='.($start+$limit))?>">Keyingisi</a></li>
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
