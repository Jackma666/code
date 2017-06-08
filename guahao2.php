<?php  
ini_set("display_errors", "On");
error_reporting(E_ALL | E_STRICT);


if ($op = $_GET["op"]) {
 	echo 'sucess!';
}

$op = "<a href='?op=view&id=$id'>
<img src='/res/img/b_detail.gif' width='55' height='56' align='absmiddle' alt='查看详情'>
</a>";

echo $op;



?>