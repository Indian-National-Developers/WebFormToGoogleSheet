<?php 

require_once('db.php');

$db                     =   mysql_connect($host, $username, $password) or die('Could not connect');
mysql_select_db($db_name, $db) or die('');

$paramArray             =   array();
$paramArray[]           =   $_POST['name'];
$paramArray[]           =   $_POST['mailID'];
$paramArray[]           =   $_POST['address'];
$paramArray[]           =   $_POST['town'];
$paramArray[]           =   $_POST['city'];
$paramArray[]           =   $_POST['state'];
$paramArray[]           =   $_POST['bloodGroup'];
$paramArray[]           =   $_POST['education'];
$paramArray[]           =   $_POST['phone'];
$paramArray[]           =   $_POST['donation'];

$paramValues            =   "'" . implode("','", $paramArray) . "'";
$paramValues            =   $paramValues . ', now()';
//echo $paramValues;

$sql                    =   "INSERT INTO registration (name, mailID, address, town, city, state, bloodGroup, education, phone, donation, addedOn) VALUES ($paramValues)";
echo ($sql);

$db_insert              =   mysql_query($sql);

if (!$db_insert) {
    mysql_close();
    $json       =   array();
    $json['status'] = 'fail';
    $json['message'] = mysql_error();;
    echo json_encode($json);
} else {
    $json       =   array();
    $json['status'] = 'success';
    $json['contactID'] = mysql_insert_id();
    echo json_encode($json);
}

mysql_close();

?>

