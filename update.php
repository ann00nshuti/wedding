<?php
error_reporting(0);
include("setting.php");

$obj = new settings();

if (isset($_POST['search'])) {
    $name = $_POST['search_name'];
    $result = $obj->ViewOneRow("client", "NAME", $name);
    $row = $result->fetch(PDO::FETCH_ASSOC);
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $product = $_POST['product'];
    $amount = $_POST['amount'];
    $description = $_POST['description'];
    $duration = $_POST['duration'];

    $obj->UpdateOneColumn("client", "NAME", "CONTACT", "EMAIL", "PRODUCT", "AMOUNT", "DESCRIPTION", "DURATION", $name, $contact, $email, $product, $amount, $description, $duration, $id);

    // Redirect to admin page
    header("Location: adminpage.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>S.A.N.O collection - Update Client</title>
    <!-- Bootstrap core CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            padding: 20px;
            font-family: 'flexslider-icon';
  src: url('../fonts/flexslider-icon.eot');
  src: url('../fonts/flexslider-icon.eot?#iefix') format('embedded-opentype'), url('../fonts/flexslider-icon.woff') format('woff'), url('../fonts/flexslider-icon.ttf') format('truetype'), url('../fonts/flexslider-icon.svg#flexslider-icon') format('svg');
  font-weight: normal;
  font-style: normal;
        }

        .form-control {
            margin-bottom: 20px;
        }

        .success-message {
            color: green;
            font-weight: bold;
            text-align: center;
        }

        @media screen and (max-width: 860px) {
  .flex-direction-nav .flex-prev {
    opacity: 1;
    left: 10px;
  }
  .flex-direction-nav .flex-next {
    opacity: 1;
    right: 10px;
  }
}

    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Update Client</h1>
        <form method="POST">
            <div class="form-group">
                <label for="search_name">Search by Name:</label>
                <input type="text" name="search_name" id="search_name" class="form-control" required>
            </div>
            <div class="form-group">
                <input type="submit" name="search" class="btn btn-primary btn-block" value="Search">
            </div>
        </form>

        <?php if (isset($row)) : ?>
            <form method="POST">
                <div class="form-group">
                    <label for="id">ID:</label>
                    <input type="text" name="id" id="id" class="form-control" value="<?php echo $row['IDE']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name" class="form-control" value="<?php echo $row['NAME']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="contact">Contact:</label>
                    <input type="text" name="contact" id="contact" class="form-control" value="<?php echo $row['CONTACT']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" class="form-control" value="<?php echo $row['EMAIL']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="product">Product:</label>
                    <input type="text" name="product" id="product" class="form-control" value="<?php echo $row['PRODUCT']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="amount">Amount:</label>
                    <input type="number" name="amount" id="amount" class="form-control" value="<?php echo $row['AMOUNT']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <input type="text" name="description" id="description" class="form-control" value="<?php echo $row['DESCRIPTION']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="duration">Duration:</label>
                    <input type="date" name="duration" id="duration" class="form-control" value="<?php echo $row['DURATION']; ?>" required>
                </div>
                <div class="form-group">
                    <input type="submit" name="update" class="btn btn-primary btn-block" value="Update">
                </div>
            </form>
        <?php endif; ?>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
