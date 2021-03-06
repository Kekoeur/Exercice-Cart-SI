<?php

namespace Cart;

abstract class Product implements Productable{

    public function __construct(
        private string $name,
        private float $price,
        )
    {
        
    }

    public function getName():string{

        return $this->name;
    }

    public function setName(string $name):self{

        $this->name = $name;

        return $this;
    }
    public function getPrice():float{

        return $this->price;
    }

    public function setPrice(float $price):self{
        
       $this->price = round( $price, Productable::PRECISION) ;

        return $this;
    }
}