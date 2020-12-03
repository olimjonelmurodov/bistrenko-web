<div class="col-md-12">
    <div class="grid email">
        <div class="grid-body">
            <div class="row">
                <!-- BEGIN INBOX MENU -->
                <div class="col-md-9 p-3 d-flex">
                    <div class="flex-grow-1">
                        <h2 class="grid-title">Xizmat turkumlari</h2>
                    </div>
<?php if (hasadminrights()){?>
                    <div class="ml-auto">
                        <a class="btn btn-block btn-primary text-light" data-toggle="modal" data-target="#compose-modal"><i class="fa fa-plus"></i>&nbsp;&nbsp;Yangi Xizmat turkumi</a>
                    </div>
<?php }?>                    
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
                        <th>O'zbekcha</th>
                        <th>Ruscha</th>
                        <th></th>
                        </thead>
                        <tbody><?php
    $i=0;
                            foreach($data as $item) {
                                
    echo '<tr>';
    echo '<td class="name">'.++$i.'</td>';
    if (hasadminrights()){
        echo '<td class="name"><a href="'.site_url('menus/editmenu?id=').$item->id.'">'.(isset($item->uzbek)?$item->uzbek:"").'</a></td>';
        echo '<td class="name"><a href="'.site_url('menus/editmenu?id=').$item->id.'">'.(isset($item->russian)?$item->russian:"").'</a></td>';
        echo '<td class="action text-right">
        <a class="btn btn-primary btn-sm text-white" href="'.site_url('menus/editmenu?id=').$item->id.'"><i class="fa fa-pencil-alt fa-fw"></i></a> 
        <a class="btn btn-danger btn-sm text-white" href="'.site_url('menus/deletemenu?id=').$item->id.'"><i class="fa fa-trash fa-fw"></i></a> 
        </td>';
    }
    else{
        echo '<td class="name"><a>'.(isset($item->uzbek)?$item->uzbek:"").'</a></td>';
        echo '<td class="name"><a>'.(isset($item->russian)?$item->russian:"").'</a></td>';
    }

    echo '</tr>';
}
?>

                            </tbody></table>
                        </div>
                    <!-- END INBOX CONTENT -->
                    

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
                                    <form action="<?php echo site_url('menus/addmenu') ?>" method="post">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <input name="uzbek" type="text" class="form-control" placeholder="O'zbekcha nomi">
                                            </div>
                                            <div class="form-group">
                                                <input name="russian" type="text" class="form-control" placeholder="Ruscha nomi">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Bekor qilish</button>
                                            <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Xizmat turkumi qo'shish</button>
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
