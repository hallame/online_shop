<?php

namespace App\Models;
use Illuminate\Http\Request;

    class Cart{

        public $items = null;
        public $totalQty = 0;
        public $totalPrice = 0;


        public function __construct($oldCart){
            
            if($oldCart){
                $this->items = $oldCart->items;
                $this->totalQty = $oldCart->totalQty;
                $this->totalPrice = $oldCart->totalPrice;
            }

        }

        public function add($item){

            $storedItem = ['qty' => 0, 'product_id' => 0, 'product_name' => $item->product_name,
            'product_price' => $item->product_price, 'product_image' => $item->product_image, 'item' =>$item];

            if($this->items){
                if(array_key_exists($item->id, $this->items)){
                    $storedItem = $this->items[$item->id];
                }
            }

            $storedItem['qty']++;
            $storedItem['product_id'] = $item->id;
            $storedItem['product_name'] = $item->product_name;
            $storedItem['product_price'] = $item->product_price;
            $storedItem['product_image'] = $item->product_image;
            $this->totalQty++;
            $this->totalPrice += $item->product_price;
            $this->items[$item->id] = $storedItem;

        }

        public function updateQty($id, $qty){
            $this->totalQty -= $this->items[$id]['qty'];
            $this->totalPrice -= $this->items[$id]['product_price'] * $this->items[$id]['qty'];
            $this->items[$id]['qty'] = $qty;
            $this->totalQty += $qty;
            $this->totalPrice += $this->items[$id]['product_price'] * $qty;

        }

        public function removeItem($id){
            $this->totalQty -= $this->items[$id]['qty'];
            $this->totalPrice -= $this->items[$id]['product_price'] * $this->items[$id]['qty'];
            unset($this->items[$id]);
        }


    }

?>