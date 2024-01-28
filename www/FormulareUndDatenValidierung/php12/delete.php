<?php

require_once('lib/db.func.inc.php');

if (isset($_POST['recordId'])) {
    $recordId = $_POST['recordId'];
    deleteRecord($recordId);
    echo "success";
}

?>