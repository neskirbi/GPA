<?php
/**
 * Created by PhpStorm.
 * User: nztr
 * Date: 26/1/2018
 * Time: 17:31
 * TEST
 */
$host = "127.0.0.1";
$_TEMP["username"] = 'CBDRCVP';
$_TEMP["password"] = 'cbd1';
$sql_conn = sqlsrv_connect($host, array("Database" => "dbventasjtib", "UID" => $_TEMP["username"], "PWD" => $_TEMP["password"], "CharacterSet" => "UTF-8"));
?>
