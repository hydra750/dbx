<?php
// require both the database and functions files; The DB file must come before the functions file
require 'includes/database.inc.php';
require 'includes/functions.inc.php';

/*
CHEAT SHEET
mode = c, r, u, d (create, read, update, delete)
id = id or value of the columnn or row; for reading or deleting all the values the "all" string must be used
table = the table that your use
row = the row to be selected
col = the column to be selected
data = this is used to insert or update values in the table, and must be set as an associative array
vuln = covers the two vulnerabilities when it comes to web application; SQL injection and XSS - values are -> sql, xss, all. The default is set to all i recommend you leave this as it is
*/



//Examples

//Inserting data
$DataIn = array('Field1' => 'Entry1', 'Field2' => 'Entry2');
dbx($mode = 'c', $id = null, $table = 'TableName', $row = null, $col = null, $data = $DataIn, $vuln = 'all');

//Fetching data
dbx($mode = 'r', $id = 'all', $table = 'TableName'); //For fetching all values -> returns a MySQL result
dbx($mode = 'r', $id = 1, $table = 'TableName', $row = 'RowName'); //For fetching a specific value, you also can use col instead of row and the $id must be the desired id as an INT -> returns the value


//Updating data
$DataIn = array('Field1' => 'Entry1', 'Field2' => 'Entry2');
dbx($mode = 'u', $id = null, $table = 'TableName', $row = null, $col = null, $data = $DataIn, $vuln = 'all');

//Deleting data
dbx($mode = 'd', $id = 'all', $table = 'TableName'); //For deleting all the values
dbx($mode = 'd', $id = 1, $table = 'TableName'); //For deleting a specific value, the $id must be a desired id as an INT

?>
