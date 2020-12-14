<?php

namespace App\Models;


class Cart 
{
    public $items = null;
    public $totalPrice = 0 ;
    public $totalQuantity = 0;

    public function __construct($cart) {
        if($cart) {
            $this->items = $cart->items;
            $this->totalPrice = $cart->totalPrice;
            $this->totalQuantity = $cart->totalQuantity;
        }
    }
    public function AddToCart($item , $id)
    {
        //new item
        $newItem = ['quantity' => 0,'price'=> $item->price,'itemInfo' => $item];
        if($this->$items){
            if(array_key_exists($id,$items)) {
                $newItem = $items[$id];
            }
        }
        $newItem['quantity']++;
        $newItem['price'] = $newItem['quantity'] * $item->price;
        $this->items[$id] = $newItem;
        $this->totalPrice += $newItem->price ; 
        $this->totalQuantity++;  
    }
}
