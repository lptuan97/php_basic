<?php
if (!defined('_INCODE')) die('Access Deined...');
// autoRemoveTokenLogin();
?>
<html>
<head>
    <meta charset="utf-8"/>
    <title><?php echo(!empty($data['pageTitle'])?$data['pageTitle']:'Không xác định');?></title>
    <link type="text/css" rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE; ?>/css/bootstrap.min.css"/>
    <link type="text/css" rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE; ?>/css/font-awesome.min.css"/>
    <link type="text/css" rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE; ?>/css/style.css?ver=<?php echo rand(); ?>"/>
</head>
<body>
