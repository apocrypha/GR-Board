<?php
// ��Ƽ���ε�� �ø� ������ ���ۼ� ���߿� �ٽ� ������ ��� ����
if(!$_POST['id'] || !$_POST['filename']) exit();
$_POST['id'] = str_replace(array('../', '.php'), '', $_POST['id']);
$_POST['filename'] = str_replace(array('../', '.php'), '', $_POST['filename']);
@unlink('data/'.$_POST['id'].'/'.$_POST['filename']);

$readTmpList = @file('data/tmpfile.'.$_SERVER['REMOTE_ADDR']);

foreach ($readTmpList as $k => $v) {
	//���� �̸�,�ٸ� ������ �̹��������� ���ε� ���� ��� ��Ȯ�� �ɷ����� ���ؼ� explode�ι� ���.
	$v_ex=explode('__GRBOARD__',$v);
	$v_ex_ex=end(explode('/',$v_ex[0]));
    if($v_ex_ex==$_POST['filename']){
    	unset($readTmpList[$k]);
    	break;
    }
}
$newTmp=implode('',$readTmpList);
$f = @fopen('data/tmpfile.'.$_SERVER['REMOTE_ADDR'], 'w');
@fwrite($f, $newTmp);
@fclose($f);
?>