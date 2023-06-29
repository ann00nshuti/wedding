<?php
include("setting.php");
$obj = new settings();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="Anne" content="annedesign">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet">

    <title>S.A.N.O collection</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/wedcss.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/lightbox.css">
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

        h2 {
            color: darkorange;
            font-weight: bold;
            text-align: center;
            font-weight: normal;
            font-style: normal;

        }

        .success-message {
             font-family: 'flexslider-icon';
            color:black;
            font-weight: bold;
            text-align: left;
            font-weight: normal;
            font-style: normal;
        }

        /* CSS Styles */
        @media (max-width: 768px) {
            /* Mobile responsive styles */
            .main-nav .nav {
                display: none;
            }
        }

    </style>
</head>
<body>

<h2>Event and wedding Client portal</h2>
<div class="form-group">
                <a href="index.php" class="btn btn-primary btn-block">Back to Home</a>
            </div>
<div class="container">
    <form method="POST">

        <div class="form-group">
            <input type="text" name="name" class="form-control" placeholder="Client Name" required>
        </div>
        <div class="form-group">
            <input type="text" name="contact" class="form-control" placeholder="Telephone" required>
        </div>
        <div class="form-group">
            <input type="email" name="email" class="form-control" placeholder="Email" required>
        </div>
        <div class="form-group">
            <input type="text" name="product" class="form-control" placeholder="Product" required>
        </div>
        <div class="form-group">
            <input type="number" name="amount" class="form-control" placeholder="Amount" required>
        </div>
        <div class="form-group">
            <input type="text" name="description" class="form-control" placeholder="Description" required>
        </div>
        <div class="form-group">
            <input type="date" name="duration" class="form-control" placeholder="When" required>
        </div>
        <div class="form-group">
            <input type="submit" name="send" class="btn btn-primary btn-block" value="Request">
        </div>

    </form>
    <?php
    if (isset($_POST['send'])) {
        $name = $_POST['name'];
        $contact = $_POST['contact'];
        $email = $_POST['email'];
        $product = $_POST['product'];
        $amount = $_POST['amount'];
        $description = $_POST['description'];
        $duration = $_POST['duration'];

        $obj->addclient("client", $name, $contact, $email, $product, $amount, $description, $duration);
        ?>
        <div class="success-message">
            <p>Your booking has been received successfully. Here are the details you provided:</p>
            <ul>
                <li><strong>Your Name is:</strong> <?php echo $name; ?></li>
                <li><strong>Phone Number:</strong> <?php echo $contact; ?></li>
                <li><strong>Your Email Address:</strong> <?php echo $email; ?></li>
                <li><strong>Product Your are Booking:</strong> <?php echo $product; ?></li>
                <li><strong>Amount :</strong> <?php echo $amount; ?></li>
                <li><strong>Description of you request:</strong> <?php echo $description; ?></li>
                <li><strong>When:</strong> <?php echo $duration; ?></li>
            </ul>
            
        </div>
        <?php
    }
    ?>
</div>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
