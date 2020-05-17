<?php

namespace Test\Unit;

use PHPUnit\Framework\TestCase;
use App\Connection;
use App\ShoppingCart\Cart;
use App\ShoppingCart\CartItem;
use App\ShoppingCart\CartIsEmptyException;

class CartTest extends TestCase
{
    /*protected function setUp(): void
    {
        $this->cart = new Cart();
        $this->conn = new Connection();
        $this->conn->createSchema();
    }

    protected function tearDown(): void
    {
        $this->conn->dropTable();
    }*/



    /**
     * @before
     */

    public function customSetUp()
    {
        $this->cart = new Cart();
        $this->conn = new Connection();
        $this->conn->createSchema();
    }

    /**
     * @after
     */
    public function customTearDown()
    {
        $this->conn->dropTable();
    }

    public function testItCreatesACart()
    {
        $item = createItem("Mouse", 20);
        $this->assertEquals(0, $this->cart->count());

        $this->cart->add($item);
        $this->assertEquals(1, $this->cart->count());
    }

    public function testItAddsMultiplesItems()
    {
        $items = [];
        $this->assertEquals(0, $this->cart->count());

        for($i = 1; $i <= 5; $i++) {
            array_push($items, new CartItem("Mouse", 20));
        }
        $this->cart->addItems($items);
        $this->assertEquals(count($items), $this->cart->count());
    }

    public function testIsEmpty()
    {
        $this->assertTrue($this->cart->isEmpty());
    }

    public function testItRemoveAnItem()
    {
        $item = new CartItem("Mouse", 20);
        $this->cart->add($item);
        $this->assertEquals(1, $this->cart->count());

        $this->cart->remove($item->id);
        $this->assertTrue($this->cart->isEmpty());
    }

    public function testItStoreAnCart()
    {
        $this->conn->insert($this->cart);
        $cart = $this->conn->get($this->cart->id);
        $this->assertEquals($cart->id, $this->cart->id);
    }

    public function testItThrowsAnEmptyException()
    {
        $this->expectException(CartIsEmptyException::class);
        $this->cart->getFirstItem();
    }
}