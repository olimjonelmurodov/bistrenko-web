<div class="col-md-12">
    <div class="grid email">
        <div class="grid-body">
            <div class="row">
                <!-- BEGIN INBOX MENU -->
                <div class="col-md-12 p-3 d-flex">
                    <div class="flex-grow-1">
                        <h2 class="grid-title">Mahsulotlar</h2>
                    </div>
					<div class="ml-auto">
                                        <form class="form-inline mr-auto ">
                                                <input type="text" name="search" class="mr-1 form-control" value="<?=$search?>" placeholder="Qidirish...">
                                                <button type="submit" class="mr-2 btn btn-primary"><i class="fa fa-search"></i> Qidirish</button>
                                            <?php if (hasadminrights()){?>
                                                <a class="btn btn-primary text-light" data-toggle="modal" data-target="#compose-modal"><i class="fa fa-plus"></i>&nbsp;&nbsp;Yangi Mahsulot</a>
                                            <?php }?>                    
						</form>						
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
                        <th>O'zbekcha</th>
                        <th>Ruscha</th>
                        <th>Narxi</th>
                        <th>Yetkazib beruvchi</th>
                        <th>Kategoriya</th>
                        <th>Rasmi bormi?</th>
                        <th>Holati</th>
                        <th></th>
                        </thead>
                        <tbody><?php
                            $i=1;
                            foreach($data as $item) {
    echo '<tr>';
    echo '<td class="name">'.$i++.'</td>';
    if (hasadminrights()){
        echo '<td class="name"><a href="'.site_url('products/editproduct?id=').$item->id.'">'.$item->uzbek.'</a></td>';
        echo '<td class="name"><a href="'.site_url('products/editproduct?id=').$item->id.'">'.$item->russian.'</a></td>';
        echo '<td class="name"><a href="'.site_url('products/editproduct?id=').$item->id.'">'.number_format(intval($item->price/100), 0, ',', ' ').'</a></td>';
        echo '<td class="name"><a href="'.site_url('products/editproduct?id=').$item->id.'">'.$item->place.'</a></td>';
        echo '<td class="name"><a href="'.site_url('products/editproduct?id=').$item->id.'">'.$item->category.'</a></td>';
        echo '<td class="name"><a href="'.site_url('products/editproduct?id=').$item->id.'">'.($item->hasimage=="t"?'Ha':'Yo\'q').'</a></td>';
        echo '<td class="name"><a href="'.site_url('products/editproduct?id=').$item->id.'">'.($item->isactive==1?'Aktiv':'Noaktiv').'</a></td>';
        echo '<td class="action text-right">';
        if ($item->isactive==1)
			echo '<a class="btn btn-warning btn-sm text-white" href="'.site_url('products/block?id=').$item->id.'"><i class="fa fa-ban fa-fw"></i></a> ';
		else
			echo '<a class="btn btn-success btn-sm text-white" href="'.site_url('products/restore?id=').$item->id.'"><i class="fa fa-recycle fa-fw"></i></a> ';
        echo '<a class="btn btn-primary btn-sm text-white" href="'.site_url('products/editproduct?id=').$item->id.'"><i class="fa fa-pencil-alt fa-fw"></i></a> 
        <a class="btn btn-danger btn-sm text-white" href="'.site_url('products/deleteproduct?id=').$item->id.'"><i class="fa fa-trash fa-fw"></i></a> 
        </td>';
    }
    else{
        echo '<td class="name"><a>'.$item->uzbek.'</a></td>';
        echo '<td class="name"><a>'.$item->russian.'</a></td>';
        echo '<td class="name"><a>'.$item->price.'</a></td>';
        echo '<td class="name"><a>'.$item->category.'</a></td>';
        echo '<td class="name"><a>'.($item->hasImage=="t"?'Ha':'Yo\'q').'</a></td>';
    }

    echo '</tr>';
}
?>

                            </tbody></table>
                        </div>
                    <!-- END INBOX CONTENT -->
                    <nav aria-label="Page navigation example">
							<ul class="pagination">
						<?php
                            if ($start>0){
                            ?>
                                                        <li class="page-item"><a class="page-link" href="<?=site_url('products?start='.($start-$limit))?>">Oldingisi</a></li>
                            <?php
                            }
                            $c = ($count / $limit);
                            if ($c>1)
                            for($i=1; $i<=$c; $i++){
                            ?>

                                                        <li class="page-item"><a class="page-link" href="<?=site_url('products?start='.(($i-1)*$limit))?>"><?=$i?></a></li>
                            <?php
                            }
                            if ($start + $limit<$count){
                            ?>
                                                        <li class="page-item"><a class="page-link" href="<?=site_url('products?start='.($start+$limit))?>">Keyingisi</a></li>
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
                                          <div class="p-2 bd-highlight"><h4 class="modal-title">Yangi Mahsulot</h4></div>
                                        </div>
                                        <div class="d-flex flex-row-reverse bd-highlight">
                                          <div class="p-2 bd-highlight"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button></div>
                                        </div>
                                    </div>
                                    <form action="<?php echo site_url('products/addproduct') ?>" method="post" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <input name="uzbek" type="text" class="form-control" placeholder="O'zbekcha nomi">
                                            </div>
                                            <div class="form-group">
                                                <input name="russian" type="text" class="form-control" placeholder="Ruscha nomi">
                                            </div>
                                            <div class="form-group">
                                                <input name="price" type="number" class="form-control" placeholder="Narx">
                                            </div>
                                            <div class="form-group">
                                                <textarea name="desc_uz" class="form-control" placeholder="O'zbekcha ma'lumot"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <textarea name="desc_ru" class="form-control" placeholder="Ruscha ma'lumot"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <input name="maxcount" type="number" class="form-control" placeholder="Maksimal miqdori (bo'sh holda 100ga teng)">
                                            </div>

                                            <div class="form-group">
                                                <label>Rasmni tanlang:</label>
                                                <input name="image" type="file" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Yetkazib beruvchini tanlang:</label>
                                                <select id="place" class="form-control" onchange="populateCategory()" required>
                                                <?php foreach ($places as $class){
                                                    if ($class->id==$lastplaceid)
                                                        echo '<option value="'.$class->id.'" selected>'.$class->uzbek.'</option>';
                                                    else
                                                        echo '<option value="'.$class->id.'">'.$class->uzbek.'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Kategoriyani tanlang:</label>
                                                <select id="category" name="categoryid" class="form-control" required>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Bekor qilish</button>
                                            <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Mahsulot qo'shish</button>
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
var catSel = document.getElementById('category');
placeSel = document.getElementById('place');
categories = JSON.parse('<?=$categories?>');
document.addEventListener("DOMContentLoaded", function(event) {
    populateCategory();
});
function populateCategory(){
    catSel.innerHTML="";
    l = categories.length;
    for (var i=0; i<l; i++){
        if (categories[i].placeid==placeSel.value){
                opt = document.createElement('option');
                opt.value = categories[i].id;
                opt.innerHTML = categories[i].uzbek;
                catSel.appendChild(opt);
            }
    }

}
</script>
