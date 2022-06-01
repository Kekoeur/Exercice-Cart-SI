<?php

namespace Cart;

class StorageSession implements Storable{

    public function __construct()
    {
        if (!isset($_SESSION['panier'])) {
            $_SESSION['panier'] = [];
        }
    }

    public function setValue(string $name, float $total):void{

        if(array_key_exists($name, $_SESSION['panier'])){
            $_SESSION['panier'][$name] += $total;

            return;
        }

        $_SESSION['panier'][$name] = $total;

    }
    public function total():float{
        
        return round(  array_sum($_SESSION['panier']), $_ENV['PRECISION']) ;
    }

}