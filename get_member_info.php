<?php
// 기본 클래스를 불러온다. @sirini
$headerGiven = 'Content-type: text/xml; charset=utf-8';
include 'class/common.php';
$GR = new COMMON;
$GR->dbConn();

// 회원 정보를 xml 로 반환 @sirini
if($_POST['no']) $uno = (int)$_POST['no']; else exit();
$memInfo = $GR->getArray('select email, homepage from '.$dbFIX.'member_list where no = \''.$uno.'\'');
if(!$memInfo['email']) $memInfo['email'] = 0;
if(!$memInfo['homepage']) $memInfo['homepage'] = 0;
echo '<?xml version="1.0" encoding="utf-8"?><lists><item no="'.$uno.'"><email>'.$memInfo['email'].'</email><homepage>'.$memInfo['homepage'].'</homepage></item></lists>';
?>