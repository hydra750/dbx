<?php
function dbx($mode = null, $id = null, $table = null, $row = null, $col = null, $data = null, $vuln = "all") {
	global $conn; //connection to DB
	switch ($mode) {
		case 'c':
			if ("$vuln"=="") {
				$f = null;
				$e = null;
				foreach ($data as $field => $entry) {
					$f .="`$field`, ";
					$e .="\"$entry\", ";
				}
				$fields = rtrim($f, ", ");
				$entries = rtrim($e, ", ");
				$sql = "INSERT INTO `$table` ($fields) VALUES ($entries)";
				return mysqli_query($conn2, $sql) or die('SQL error: '.mysqli_error($conn2));
			} elseif ("$vuln"=="xss") {
				$f = null;
				$e = null;
				foreach ($data as $field => $entry) {
					$f .="`$field`, ";
					$ex = htmlspecialchars($entry);
					$e .="\"$ex\", ";
				}
				$fields = rtrim($f, ", ");
				$entries = rtrim($e, ", ");
				$sql = "INSERT INTO `$table` ($fields) VALUES ($entries)";
				return mysqli_query($conn2, $sql) or die('SQL error: '.mysqli_error($conn2));
			} elseif ("$vuln"=="sql") {
				$f = null;
				$e = null;
				foreach ($data as $field => $entry) {
					$f .="`$field`, ";
					$ex = mysqli_real_escape_string($conn2, $entry);
					$e .="\"$ex\", ";
				}
				$fields = rtrim($f, ", ");
				$entries = rtrim($e, ", ");
				$sql = "INSERT INTO `$table` ($fields) VALUES ($entries)";
				return mysqli_query($conn2, $sql) or die('SQL error: '.mysqli_error($conn2));
			} elseif ("$vuln"=="all") {
				$f = null;
				$e = null;
				foreach ($data as $field => $entry) {
					$f .="`$field`, ";
					$ex = mysqli_real_escape_string($conn2, $entry);
					$ex = htmlspecialchars($ex);
					$e .="\"$ex\", ";
				}
				$fields = rtrim($f, ", ");
				$entries = rtrim($e, ", ");
				$sql = "INSERT INTO `$table` ($fields) VALUES ($entries)";
				return mysqli_query($conn2, $sql) or die('SQL error: '.mysqli_error($conn2));
			} else {
				die('Syntax error: invalid "vuln" argument - '.$vuln);
			}
			break;

		case 'r':
			if ("$id"=="all") {
				$result = mysqli_query($conn2, "SELECT * FROM `$table`") or die('SQL error: '.mysqli_error($conn2));
				return $result;
			} else {
				$a = mysqli_query($conn2, "SELECT * FROM `$table` WHERE id=$id") or die('SQL error: '.mysqli_error($conn2));
				$a = mysqli_fetch_assoc($a);
				return $a["$row"];
			}
			break;

		case 'u':
			if ("$vuln"=="") {
				$x = null;
				foreach ($data as $field => $entry) {
					$x .= "`$field` = '$entry', ";
				}
				$data = rtrim($x, ", ");
				$sql = "UPDATE `$table` SET $data WHERE `id` = $id";
				return mysqli_query($conn2, $sql) or die('SQL error: '.mysqli_error($conn2));
			} elseif ("$vuln"=="xss") {
				$x = null;
				foreach ($data as $field => $entry) {
					$entry = htmlspecialchars($entry);
					$x .= "`$field` = '$entry', ";
				}
				$data = rtrim($x, ", ");
				$sql = "UPDATE `$table` SET $data WHERE `id` = $id";
				return mysqli_query($conn2, $sql) or die('SQL error: '.mysqli_error($conn2));
			} elseif ("$vuln"=="sql") {
				$x = null;
				foreach ($data as $field => $entry) {
					$entry = mysqli_real_escape_string($conn2, $entry);
					$x .= "`$field` = '$entry', ";
				}
				$data = rtrim($x, ", ");
				$sql = "UPDATE `$table` SET $data WHERE `id` = $id";
				return mysqli_query($conn2, $sql) or die('SQL error: '.mysqli_error($conn2));
			} elseif ("$vuln"=="all") {
				$x = null;
				foreach ($data as $field => $entry) {
					$entry = mysqli_real_escape_string($conn2, $entry);
					$entry = htmlspecialchars($entry);
					$x .= "`$field` = '$entry', ";
				}
				$data = rtrim($x, ", ");
				$sql = "UPDATE `$table` SET $data WHERE `id` = $id";
				return mysqli_query($conn2, $sql) or die('SQL error: '.mysqli_error($conn2));
			} else {
				die('Syntax error: invalid "vuln" argument - '.$vuln);
			}
			break;
		
		case 'd':
			if ("$id"=="all") {
				return mysqli_query($conn2, "TRUNCATE `$table`") or die('SQL error: '.mysqli_error($conn2));
			} else {
				return mysqli_query($conn2, "DELETE FROM `$table` WHERE id=$id") or die('SQL error: '.mysqli_error($conn2));
			}
			break;
	}
}

?>
