<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
 	<title>
		Bistrenkobot
	</title>
	<link href="<?=base_url('application/assets/css/fa-all.css');?>" rel="stylesheet">
	<link href="<?=base_url('application/assets/css/bootstrap.min.css');?>" rel="stylesheet">
	<link href="<?=base_url('application/assets/css/main.css');?>" rel="stylesheet">

</head>
<body>
  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="menu-item" id="sidebar-wrapper">
      <div class="sidebar-heading p-0"><a href="<?php echo site_url('orders')?>"><img src="<?=base_url('application/assets/arrow.png');?>" width="256"></a></div>
      <div class="list-group list-group-flush">
        <a href="<?php echo site_url('orders') ?>" class="list-group-item list-group-item-action menu-item<?php echo $page=='orders' ? '-active':'';?>"><i class="fas fa-shopping-cart fa-fw"></i> Buyurtmalar <span class= 
        <?php $urc=getunreadcount();
        if (empty($urc)) 
        echo '"badge badge-pill badge-secondary">0';
        else
        echo '"badge badge-pill badge-danger">'.$urc;
        ?>
        </span></a>
        <a href="<?php echo site_url('menus') ?>" class="list-group-item list-group-item-action menu-item<?php echo $page=='menus' ? '-active':'';?>"><i class="fas fa-concierge-bell fa-fw"></i> Xizmat turkumlari</a>
        <a href="<?php echo site_url('places') ?>" class="list-group-item list-group-item-action menu-item<?php echo $page=='places' ? '-active':'';?>"><i class="fas fa-store-alt fa-fw"></i> Yetkazib beruvchilar</a>
        <a href="<?php echo site_url('categories') ?>" class="list-group-item list-group-item-action menu-item<?php echo $page=='categories' ? '-active':'';?>"><i class="fas fa-book-reader fa-fw"></i> Kategoriyalar</a>
        <a href="<?php echo site_url('products') ?>" class="list-group-item list-group-item-action menu-item<?php echo $page=='products' ? '-active':'';?>"><i class="fas fa-hamburger fa-fw"></i> Mahsulotlar</a>
        <?php if (hasadminrights()){
            ?>
        <a href="<?php echo site_url('servers') ?>" class="list-group-item list-group-item-action menu-item<?php echo $page=='servers' ? '-active':'';?>"><i class="fas fa-users-cog fa-fw"></i> Xodimlar</a>
        <a href="<?php echo site_url('couriers') ?>" class="list-group-item list-group-item-action menu-item<?php echo $page=='couriers' ? '-active':'';?>"><i class="fas fa-truck fa-fw"></i> Kuryerlar</a>
        <a href="<?php echo site_url('settings') ?>" class="list-group-item list-group-item-action menu-item<?php echo $page=='settings' ? '-active':'';?>"><i class="fas fa-cog fa-fw"></i> Sozlanmalar</a>
        <a href="<?php echo site_url('auth') ?>" class="list-group-item list-group-item-action menu-item<?php echo $page=='auth' ? '-active':'';?>"><i class="fas fa-user fa-fw"></i> Foydalanuvchilar</a>
        <a href="<?php echo site_url('users') ?>" class="list-group-item list-group-item-action menu-item<?php echo $page=='users' ? '-active':'';?>"><i class="fab fa-telegram fa-fw"></i> Bot foydalanuvchilari</a>
        
        <?php }?>
      </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <?php if (!empty($in)){?>
          <ul class = "navbar-nav mr-auto mt-2 mt-lg-0">
              <li class="nav-item mt-0 mb-0">
                  <div class="alert <?=($in>0?'alert-success':'alert-danger')?> mt-0 mb-0" role="alert">
                    <?php
                    if ($in==-1)
                    echo "O'zini o'zi o'chirish mumkin emas";
                    else if ($in==1)
                    echo "Parol o'zgardi";
                    ?>
                  </div>
              </li>
          </ul>
          <?php } ?>
          <?php if (isset($privilegein)){?>
          <ul class = "navbar-nav mr-auto mt-2 mt-lg-0">
              <li class="nav-item mt-0 mb-0">
                  <div class="alert <?=($privilegein>0?'alert-success':'alert-danger')?> mt-0 mb-0" role="alert">
                    <?php
                    if ($privilegein==-1)
                    echo "Ushbu raqam ruxsat darajalari ro'yxatida bor.";
                    else if ($privilegein==0)
                    echo "Ushbu raqam egasi hali telegram botini ishlatmagan.";
                    else if ($privilegein==1)
                    echo "Raqam egasining statusi o'zgartirildi.";
                    ?>
                  </div>
              </li>
          </ul>
          <?php } ?>
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?=$this->session->userdata('username')?></a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="<?php echo site_url('auth/changepasswordindex') ?>">Parolni o'zgartirish</a>
                <a class="dropdown-item" href="<?php echo site_url('auth/logout') ?>">Chiqish</a>
              </div>
            </li>
          </ul>
        </div>
      </nav>
     <div class="container-fluid">
 
