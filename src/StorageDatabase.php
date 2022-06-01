<?php

namespace Cart;

class StorageDatabase implements Storable{

    public $conn;

    public function __construct($c){
        $this->conn = $c;
        if($this->conn){
            $sql = "DELETE FROM Produits";
            $this->conn->query($sql);
        }
    }

    public function setValue(string $name, float $total):void{
        if($this->conn){
            $sql = "INSERT INTO Produits (name, total) VALUES ('$name', $total)";
            $this->conn->query($sql);
        }
    }
    public function total():float{
        if($this->conn){
            $sql = "SELECT SUM(total) as sum_total FROM Produits";
            $result = $this->conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                  $t = $row["sum_total"];
                }
              }
        }
        return round($t, $_ENV['PRECISION']) ;
    }

}