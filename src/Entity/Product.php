<?php

namespace App\Entity;

use Symfony\Component\Config\Definition\Exception\Exception;

class Product
{   const FOOD_PRODUCT = 'food';
    private $name;
    private $type;
    private $price;
    public function __construct($name, $type, $price)
    {
        $this->name = $name;
        $this->type = $type;
        $this->price = $price;
    }
    public function computeTVA()
    {
        if (self::FOOD_PRODUCT == $this->type) {
            return $this->price * 0.1;
        }
        if ($this->price < 0) {
            throw new Exception('The TVA cannot be negative.');
        }
        return $this->price * 0.01;
    }

}
