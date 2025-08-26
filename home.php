<?php header('Content-Type: text/html; charset=utf-8'); ?>
<?php date_default_timezone_set('america/bogota'); ?>
<?php error_reporting(E_ALL); ?>
<?php ini_set('display_errors', 1); ?>
<?php include_once	( dirname( __FILE__ ) . '/src/sistema/Utiles.php'); ?>
<?php include_once	( dirname( __FILE__ ) . '/src/sistema/Config.php'); ?>
<?php include_once	( dirname( __FILE__ ) . '/src/sistema/Pagina.php'); ?>
<?php include_once	( dirname( __FILE__ ) . '/src/sistema/Correo.php'); ?>
<?php include_once	( dirname( __FILE__ ) . '/src/datos/Singleton.php'); ?>
<?php include_once	( dirname( __FILE__ ) . '/src/datos/Clsdatos.php'); ?>
<?php Utiles::IncluirArchivos( dirname( __FILE__ ) . '/src/modelo' ); ?>
<?php include_once	( dirname( __FILE__ ) . '/src/sistema/Seguridad.php'); ?>
<?php include_once	( dirname( __FILE__ ) . '/src/sistema/Menubar/Menubar.php'); ?>
<?php include_once	( dirname( __FILE__ ) . '/src/sistema/Headerbar/Headerbar.php'); ?>
<?php include_once	( dirname( __FILE__ ) . '/src/ctrls/IndexCtrl.php'); ?>
<?php include_once	( dirname( __FILE__ ) . '/src/ctrls/HomeCtrl.php'); ?>
<?php include_once	( dirname( __FILE__ ) . '/src/libs/phpqrcode/qrlib.php'); ?>
<?php $index = new HomeCtrl(); ?>
<?php $index->render(); ?>