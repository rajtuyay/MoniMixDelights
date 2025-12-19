<?php
define('db_server','localhost');
define('db_username','root');
define('db_password','');
define('db_name','db_monimix');

$connection = mysqli_connect(db_server,db_username,db_password,db_name);

// if($connection == false){ die( "ERROR: could not connect." .mysli_connection_error()); }

?>