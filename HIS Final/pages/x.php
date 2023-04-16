<!DOCTYPE html>
<html lang="en">
<?php require_once("../backend/cls_select.php"); ?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php
    $obj = new Get();
    $resultCatHead = $obj->GetActivityCat();

    ?>
    <form action="../backend/DB_insert.php" method="post">
        <label for="first-dropdown">Select a value:</label>
        <select id="first-dropdown" name="acitivity">
            <?php
            if ($resultCatHead->num_rows > 0) :
                foreach ($resultCatHead as $row) :
            ?>
                    <option><?php echo $row['activityCatHead']; ?></option>
                    <!-- <option value="Leadership / Management">Leadership / Management (For the contribution of 1 Academic Year)</option> -->
            <?php
                endforeach;
            endif;
            ?>
        </select>


        <label for="second-dropdown">Select another value:</label>
        <select id="second-dropdown" name="acitivity1">
            <!-- options for first value -->
        </select>
    <button type="submit" name="fuck">submit</button>
</form>

    <script>
        const firstDropdown = document.getElementById("first-dropdown");
        const secondDropdown = document.getElementById("second-dropdown");

        firstDropdown.addEventListener("change", (event) => {
            // clear options from second dropdown
            secondDropdown.innerHTML = "";

            // add options to second dropdown based on value of first dropdown

            <?php

            $obj1 = new Get();
            $resultCatAll = $obj1->GetActivityCatAll();
            if ($resultCatHead->num_rows > 0) :
                foreach ($resultCatHead as $row) :
            ?>
                    if (event.target.value === "<?php echo $row['activityCatHead']; ?>") {

                        secondDropdown.innerHTML = `
                        <?php
                        if ($resultCatAll->num_rows > 0) :
                            foreach ($resultCatAll as $row1) :
                                if ($row1['activityCatHead'] == $row['activityCatHead']) :
                        ?><option><?php echo $row1['activitySubCat']; ?></option>
                        <?php
                                endif;
                            endforeach;
                        endif;
                        ?>`;
                    }
            <?php

                endforeach;
            endif;
            ?>
            // add more conditions for other values of first dropdown if needed
        });
    </script>

</body>

</html>