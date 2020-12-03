<div class="col-md-12">
    <div class="grid email">
        <div class="grid-body">
            <div class="row">
                <!-- BEGIN INBOX MENU -->
                <div class="col-md-9 p-3 d-flex">
                    <div class="flex-grow-1">
                        <h2 class="grid-title">Xodimlarga xabarlar</h2>
                    </div>
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
                        <th>Xabar</th>
                        <th>Rasm bormi?</th>
                        <th>Xodim nomi</th>
                        <th></th>
                        </thead>
                        <tbody><?php
                            $i=1;
                            foreach($data as $item) {
    echo '<tr>';
    echo '<td class="name">'.$i++.'</td>';
    echo '<td class="name">'.$item->message.'</td>';
    echo '<td class="name">'.($item->hasImage?'Ha':'Yo\'q').'</td>';
    echo '<td class="name">'.base64_decode($item->name).'</td>';
    if (hasadminrights()){
        echo '<td class="action text-right">
        <a class="btn btn-danger btn-sm text-white" href="'.site_url('messages/deletemessage?id=').$item->id.'"><i class="fa fa-trash fa-fw"></i></a> 
        </td>';
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
