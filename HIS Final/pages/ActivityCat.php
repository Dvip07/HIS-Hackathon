<!-- INCLUDE HEADER -->
<?php include '../inc/header.php'; ?>

<!-- INCLUDE SIDEBAR -->
<?php include '../inc/sidebar.php'; ?>

<?php require_once("../backend/cls_select.php"); ?>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-2 grid-margin stretch-card">
                <?php 
                    if(isset($_SESSION['insert'])){
                        echo "<script>alert('Data is inserted');</script>";
                        unset($_SESSION['insert']);
                    }
                ?>
            </div>
            <div class="col-8 grid-margin stretch-card">

            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Add 100 Point Activity Category</h4>
                        <p class="card-description">
                        Category and Sub-Category <a href="#" type="button" class="btn btn-link btn-sm">View</a><br>
                        </p>
                        <form class="forms-sample" method="post" action="../backend/DB_insert.php" enctype="multipart/form-data">

                            <div class="form-group">
                                <label for="CatHead">Category Heading</label>
                                <input type="text" class="form-control" name="CatHead" id="CatHead" placeholder="">

                            </div>

                            <div class="form-group">
                                <label for="SubCatValue">Number of Sub-Category</label>
                                <input type="number" class="form-control" name="SubCatValue" id="SubCatValue" placeholder="Enter the total number of subcategory" min="0" max="15" onkeyup="changeInputs()">

                            </div>

                            <div id="input-container"></div>

                            <!-- Submit Button-->
                            <button type="submit" class="btn btn-primary mr-2" name="ActivityCat">Submit</button>
                            <button type="reset" class="btn btn-light">Reset</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

        function changeInputs() {
            const selectedValue = document.getElementById("SubCatValue").value;
            const inputContainer = document.getElementById("input-container");

            // Clear any previous inputs
            inputContainer.innerHTML = "";

            if(selectedValue>15){
                const length=15;
                alert("You can not add more then 15!!");
                // Create new inputs based on selected value
                for (let i = 0; i < length; i++) {
                    // Create input group
                    const inputGroup = document.createElement("div");
                    inputGroup.classList.add("form-group");

                    // Create label
                    const label = document.createElement("label");
                    label.textContent = `Sub-category ${i + 1}`;

                    // Create input field
                    const input = document.createElement("input");
                    input.type = "text";
                    input.placeholder = "Enter a value";
                    input.name = `SubCat${i + 1}`;
                    input.classList.add("form-control");

                    // Add label and input to input group
                    inputGroup.appendChild(label);
                    inputGroup.appendChild(input);

                    // Add input group to container
                    inputContainer.appendChild(inputGroup);
                }
                
            }else{
                // Create new inputs based on selected value
                for (let i = 0; i < selectedValue; i++) {
                    // Create input group
                    const inputGroup = document.createElement("div");
                    inputGroup.classList.add("form-group");

                    // Create label
                    const label = document.createElement("label");
                    label.textContent = `Sub-category ${i + 1}`;

                    // Create input field
                    const input = document.createElement("input");
                    input.classList.add("form-control");
                    input.type = "text";
                    input.name = `SubCat${i + 1}`;
                    input.placeholder = "Enter a value";
                    // input.required = "true";
                    

                    // Add label and input to input group
                    inputGroup.appendChild(label);
                    inputGroup.appendChild(input);

                    // Add input group to container
                    inputContainer.appendChild(inputGroup);
                }
            }
        }

</script>

<!-- INCLUDE FOOTER -->
<?php include '../inc/footer.php'; ?>