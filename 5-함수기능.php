<?php
//금지할 확장자
//$ban_ext = array('php', 'php3', 'html', 'htm', 'cgi', 'pl');
//$ext="php";
//if(in_array($ext, $ban_ext)){
//    echo "aa";
//
//}

$a="a.b";
$b  = explode(".",$a);
echo $b[0];
echo "<br>";
for($i=0; $i<2;$i++){
    echo $b[$i];
    echo "<br>";
}

$ext = strtolower($b[sizeof($b) - 1]);
echo $ext;
?>