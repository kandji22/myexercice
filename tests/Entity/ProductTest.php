<?php

namespace App\Tests\Entity;
use App\Entity\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase {
    public function testWithFood() {
        $product = new Product('mayname',Product::FOOD_PRODUCT,5);
        $this->assertSame($product->computeTVA(),0.5);
    }

    public function testWithNoFood() {
        $product2 = new Product('mayname','',5);
        $this->assertSame($product2->computeTVA(),0.05);
    }

    public function testException() {
        $product2 = new Product('mayname','',-5);
        $this->expectException('Exception');
        $product2->computeTVA();
    }
}