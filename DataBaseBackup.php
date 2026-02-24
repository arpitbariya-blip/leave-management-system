<?php
$a = 'C:\Downloads/';
if (!file_exists($a)) {
    mkdir("C:\Downloads");
}
include_once "Mysqldump.php";
$dump = new Ifsnop\Mysqldump\Mysqldump('mysql:host=localhost;dbname=leavemgmt', 'root', '');
$dump->start($a . date("Y-m-d-H-i-s") . '.sql');
header('Location:index.php?message=Database Download SuccessFully');

?>