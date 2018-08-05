<?php
require 'database.inc.php';
require 'functions.inc.php';

$DataIn = array('Field1' => 'Entry1', 'Field2' => 'Entry2');
dbx($mode = 'c', $id = 0, $table = 'TableName', $row = 0, $col = null, $data = $DataIn, $vuln = 'all');
?>
