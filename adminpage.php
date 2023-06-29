<?php
include("databases.php");

$username = 'anne_K';
$password = '1.2_3anne_mpao';

session_start();

if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])) {
    // If the client has not provided credentials, send a 401 Unauthorized response
    header('WWW-Authenticate: Basic realm="My API"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'You must provide authentication credentials';
    exit;
}

// Check if the provided credentials are valid
if ($_SERVER['PHP_AUTH_USER'] !== $username || $_SERVER['PHP_AUTH_PW'] !== $password) {
    // If the credentials are not valid, send a 401 Unauthorized response
    header('WWW-Authenticate: Basic realm="My API"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'Invalid authentication credentials';
    exit;
}

class Settings {
    public $link;

    public function __construct() {
        $k = new db();
        $this->link = $k->getconnection();
        return $this->link;
    }

   public function addclient($tb1, $name, $contact, $email, $product, $amount, $description, $duration) {
        $tb1 = "INSERT INTO $tb1 (NAME,CONTACT,EMAIL,PRODUCT,AMOUNT,DESCRIPTION,DURATION) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $query = $this->link->prepare($tb1);
        $query->execute([$name, $contact, $email, $product, $amount, $description, $duration]);
        return $query;
    }

    public function getclient() {
        $tbName = "client";
        $query = "SELECT * FROM $tbName";
        $result = $this->link->query($query);

        echo "<h1 align='center'><u>RECORDS OF CLIENTS</u></h1>";
        echo "<div class='responsive-table'><table align='center'>";
        echo "<tr><th>ID</th><th>NAME</th><th>CONTACT</th><th>EMAIL</th><th>PRODUCT</th><th>AMOUNT</th><th>DESCRIPTION</th><th>DURATION</th><th colspan='2'>ACTION</th></tr>";

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>". $row['IDE']."</td>";
            echo "<td>" . $row['NAME'] . "</td>";
            echo "<td>" . $row['CONTACT'] . "</td>";
            echo "<td>" . $row['EMAIL'] . "</td>";
            echo "<td>" . $row['PRODUCT'] . "</td>";
            echo "<td>" . $row['AMOUNT'] . "</td>";
            echo "<td>" . $row['DESCRIPTION'] . "</td>";
            echo "<td>" . $row['DURATION'] . "</td>";
            echo "<td><a href='delete.php?ID=" . $row['IDE'] . "'>delete</a></td>";
            echo "<td><a href='update.php?ID=" . $row['IDE'] . "'>update</a></td>";
            echo "</tr>";
        }

        echo "</div></table>";
    }

    public function DeleteOneRow($tb1, $FLD, $ID) {
        $sql = "DELETE FROM `$tb1` WHERE `$FLD`=?";
        $query = $this->link->prepare($sql);
        $query->execute(array($ID));
        return $query;
    }

    public function ViewOneRow($tb1, $fld, $ID) {
        $sql = "SELECT * FROM  `$tb1` WHERE `$fld`=?";
        $query = $this->link->prepare($sql);
        $query->execute(array($ID));
        return $query;
    }

    public function UpdateOneColumn($tb1, $fld1, $fld2, $value, $id) {
        $sql = "UPDATE `$tb1` SET `$fld1`=? WHERE `$fld2`=?";
        $query = $this->link->prepare($sql);
        $query->execute(array($value, $id));
        return $query;
    }
}


$settings = new Settings();

// Check if the user is authenticated before accessing the resource
if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])) {
    $authenticated = ($_SERVER['PHP_AUTH_USER'] === $username && $_SERVER['PHP_AUTH_PW'] === $password);
    if (!$authenticated) {
        // If the credentials are not valid, send a 401 Unauthorized response
        header('WWW-Authenticate: Basic realm="My API"');
        header('HTTP/1.0 401 Unauthorized');
        echo 'Invalid authentication credentials';
        exit;
    }
}

$settings = new Settings();

// Check if the user is authenticated before accessing the resource
if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) {
    $authenticated = true;
} else {
    $authenticated = false;
}

if (!$authenticated) {
    // If the user is not authenticated, start a new session and set the authenticated flag
    $_SESSION['authenticated'] = true;
} else {
    // If the user is already authenticated, check if the session has expired
    $sessionExpiration =1; // Session expiration time in minutes
    $lastActivity = isset($_SESSION['last_activity']) ? $_SESSION['last_activity'] : 0;

    if (time() - $lastActivity > $sessionExpiration * 60) {
        // If the session has expired, destroy the session and prompt for credentials again
        session_destroy();
        session_start();
        $_SESSION['authenticated'] = false;
        header('WWW-Authenticate: Basic realm="My API"');
        header('HTTP/1.0 401 Unauthorized');
        echo 'Session expired. Please provide authentication credentials again.';
        exit;
    }
}

$_SESSION['last_activity'] = time();

$settings->getclient();
?>

<!DOCTYPE html>
<html>
<head>
    <title>ANNE</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
        <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'flexslider-icon';
  src: url('../fonts/flexslider-icon.eot');
  src: url('../fonts/flexslider-icon.eot?#iefix') format('embedded-opentype'), url('../fonts/flexslider-icon.woff') format('woff'), url('../fonts/flexslider-icon.ttf') format('truetype'), url('../fonts/flexslider-icon.svg#flexslider-icon') format('svg');
  font-weight: normal;
  font-style: normal;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border: 2px;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        td:first-child {
            font-weight: bold;
        }

        .responsive-table {
            overflow-x: auto;
        }

        /* Media queries */
        @media screen and (max-width: 768px) {
            th, td {
                font-size:12px;
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

        }
    </style>
</head>
<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <!-- Your HTML content here -->

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
</html>
