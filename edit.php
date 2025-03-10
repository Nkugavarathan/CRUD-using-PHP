<?php
$name = "";
$email = "";
$phonenumber = "";
$address = "";

$errorMessage = "";
$successMessage = "";

include("database.php");

if ($_SERVER['REQUEST_METHOD'] == "GET") {

    if (!isset($_GET['id'])) {
        header("Location:index.php");
        exit;
    }

    $id = $_GET['id'];

    $query = "SELECT * FROM clients WHERE ID=$id";
    $result = $connection->query($query);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("Location:index.php");
        exit;
    }

    $name = $row["name"];
    $email = $row["email"];
    $phonenumber = $row["phone"];
    $address = $row["address"];
} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phonenumber = $_POST['phonenumber'];
    $address = $_POST['address'];

    do {
        if (empty($name) || empty($email) || empty($phonenumber) || empty($address)) {
            $errorMessage = "All the fields are required";
            break;
        }

        $query = "UPDATE clients SET name='$name', email='$email', phone='$phonenumber', address='$address' WHERE id=$id";

        $result = $connection->query($query);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $successMessage = "Client updated successfully";
        header("Location:index.php");
        exit;
    } while (false);
}
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
    <div class="container p-3 my-5 ">
        <h2>Edit Client</h2>
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

        <form action="edit.php" method="post" id="clientForm">
            <input type="hidden" name="id" value="<?php echo $id ?>">
            <div class="row mb-3">
                <label for="name" class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $name ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="email" class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="email" class="form-control" name="email" value="<?php echo $email ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="phonenumber" class="col-sm-3 col-form-label">Phone number</label>
                <div class="col-sm-6">
                    <input type="number" class="form-control" name="phonenumber" value="<?php echo $phonenumber ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="address" class="col-sm-3 col-form-label">Address</label>
                <div class="col-sm-8">
                    <input class="form-control" name="address" value="<?php echo $address ?>"></input>
                </div>
            </div>

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

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <button type="button" class="btn btn-warning" onclick="resetForm()">Reset</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-danger" href="./index.php">Cancel</a>
                </div>
            </div>
        </form>
    </div>

    <script>
        function resetForm() {
            document.getElementById("clientForm").reset();
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>