
<?php require_once("../backend/cls_select.php"); ?>
<?php 
    $obj = new Get();
    $resultCatHead = $obj->GetActivityCat();

     if ($resultCatHead->num_rows > 0) {
        foreach ($resultCatHead as $row) {

            echo $row['activityCatHead'].'<br>';

        }
    }


?>