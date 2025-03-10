<?php
$name = "";
$email = "";
$phonenumber = "";
$address = "";
$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phonenumber = $_POST['phonenumber'];
    $address = $_POST['address'];
}
do {
    if (empty($name) || empty($email) || empty($phonenumber) || empty($address)) {
        $errorMessage = "All th fields are required";
        break;
    }

    $successMessage = "clinet added successfully";

    include("database.php");

    // insert client into database 
    $query = "INSERT INTO clients(name,email,phone,address) VALUES
    ('$name','$email','$phonenumber','$address')";

    $result = $connection->query($query);

    if (!$result) {
        $errorMessage = "Invalid query : " . $connection->error;
        break;
    }
    header("Location:index.php");
} while (false);

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body>
    <!-- bg-danger bg-gradient -->

    <div class="container p-3 my-5 ">
        <h2>New Client</h2>
        <?php
        if (!empty($errorMessage)) {
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
        ?>

        <form action="insert.php" method="post" id="clientForm">
            <div class="row mb-3">
                <label for="" class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $name ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="" class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="email" class="form-control" name="email" value="<?php echo $email ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="" class="col-sm-3 col-form-label">Phone number</label>
                <div class="col-sm-6">
                    <input type="number" class="form-control" name="phonenumber" value="<?php echo $phonenumber ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="" class="col-sm-3 col-form-label">Address</label>
                <div class="col-sm-8">
                    <input class="form-control" name="address" value="<?php echo $address ?>"> </input>
                </div>
            </div>

            <!-- success message -->

            <?php
            if (!empty($successMessage)) {
                echo "
                <div class='alert alert-success alert-dismissible fade show' role='alert'>
                    <strong>$successMessage</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>
                ";
            }
            ?>

            <div class=" row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <button type="button" class="btn btn-warning" onclick="resetForm()">Reset</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a type="submit" class="btn btn-danger" href="./index.php">Cancel</a>
                </div>

            </div>
        </form>
    </div>

    <script>
        function resetForm() {
            document.getElementById("clientForm").reset();
        }
    </script>
    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"> </script>

</body>

</html>