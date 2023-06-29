<?php 
include("databases.php");

class settings {
    public $link;

    public function __construct() {
        $k = new db();
        $this->link = $k->getconnection();
        return $this->link;
    }

    public function addclient($tb1, $name, $contact, $email, $product, $amount, $description, $duration) {
        $sql = "INSERT INTO $tb1 (NAME, CONTACT, EMAIL, PRODUCT, AMOUNT, DESCRIPTION, DURATION) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $query = $this->link->prepare($sql);
        $query->execute([$name, $contact, $email, $product, $amount, $description, $duration]);
        return $query;
    }

    public function getclient() {
        $tbName = "client";
        $query = "SELECT * FROM $tbName";
        $result = $this->link->query($query);
        echo "<h1 align='center'><u>RECORDS OF CLIENTS</u></h1>";
        echo "<table align='center'>";
        echo "<tr><th>IDE</th><th>NAME</th><th>CONTACT</th><th>EMAIL</th><th>PRODUCT</th><th>AMOUNT</th><th>DESCRIPTION</th><th>DURATION</th><th colspan='2'>ACTION</th></tr>";
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>".$row['IDE']."</td>";
            echo "<td>".$row['NAME']."</td>";
            echo "<td>".$row['CONTACT']."</td>";
            echo "<td>".$row['EMAIL']."</td>";
            echo "<td>".$row['PRODUCT']."</td>";
            echo "<td>".$row['AMOUNT']."</td>";
            echo "<td>".$row['DESCRIPTION']."</td>";
            echo "<td>".$row['DURATION']."</td>";
            echo "<td><a href='delete.php?ID=".$row['IDE']."'>delete</a></td>";
            echo "<td><a href='update.php?ID=".$row['IDE']."'>update</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    }

    public function DeleteOneRow($tb1, $FLD, $ID) {
        $sql = "DELETE FROM `$tb1` WHERE `$FLD`=?";
        $query = $this->link->prepare($sql);
        $query->execute(array($ID));
        return $query;
    }

    public function ViewOneRow($tb1, $fld, $ID) {
        $sql = "SELECT * FROM `$tb1` WHERE `$fld`=?";
        $query = $this->link->prepare($sql);
        $query->execute(array($ID));
        return $query;
    }

     public function UpdateOneColumn($table, $column1, $column2, $column3, $column4, $column5, $column6, $column7, $value1, $value2, $value3, $value4, $value5, $value6, $value7, $id)
    {
        try {
            $sql = "UPDATE $table SET $column1 = ?, $column2 = ?, $column3 = ?, $column4 = ?, $column5 = ?, $column6 = ?, $column7 = ? WHERE IDE = ?";
            $stmt = $this->link->prepare($sql);
            $stmt->execute([$value1, $value2, $value3, $value4, $value5, $value6, $value7, $id]);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
