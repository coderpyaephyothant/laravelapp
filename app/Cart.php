<?php
namespace App;


class Cart {

    public $items = null;
    public $totalPrice = 0;
    public $totalQuantity = 0;

    public function __construct($itemsInThe)
    {
        if($itemsInThe){
            $this->items = $itemsInThe->items;
            $this->totalPrice = $itemsInThe->totalPrice;
            $this->totalQuantity = $itemsInThe->totalQuantity;

        }
    }

    public function add($item,$id,$pizzazQuantity){
        $keep_items = [
            'item' => $item,
            'price' => $item->price - $item->discount_price,
            'quantity' => $pizzazQuantity,
        ];

        if ($this->items) {
            if (array_key_exists($id,$this->items)) {
                $keep = $this->items[$id];
                $this->totalQuantity +=$keep_items['quantity'] ;
                $this->totalPrice += $keep_items['price'];

                // dd($this->totalQuantity);
                $updatedQty = $keep['quantity'] += $keep_items['quantity'];
                $keep_items['quantity'] = $updatedQty;

                $keep_items['price'] = $keep_items['quantity'] * $keep_items['price'];
                // dd($keep_items['price']);
                $this->items[$id] = $keep_items;

                // dd($this);


            }else{
                // dd('others');
                $keep_items['quantity'] == 1 ? 1: $keep_items['quantity'];

                $keep_items['price'] = $keep_items['quantity'] * ($item->price - $item->discount_price);
                $this->items[$id] = $keep_items;
                $this->totalPrice += $keep_items['price'];
                $this->totalQuantity +=$keep_items['quantity'] ;
                // dd($this->items);
            };
        }else{
                $keep_items['quantity'] == 1 ? 1: $keep_items['quantity'];

                $keep_items['price'] = $keep_items['quantity'] * ($item->price - $item->discount_price);
                $this->items[$id] = $keep_items;
                $this->totalPrice += $keep_items['price'];
                $this->totalQuantity +=$keep_items['quantity'] ;
        }


    }

    public function update($id,$newQuantity,$product){
        // dd($product->price);
        if($this->items){
            if(array_key_exists($id,$this->items)){
                $this->totalQuantity = ($this->totalQuantity - $this->items[$id]['quantity']) + $newQuantity;
                $this->totalPrice = ($this->totalPrice - $this->items[$id]['price'])+( ($product->price - $product->discount_price) * $newQuantity);
                $this->items[$id]['quantity'] = $newQuantity;
                $this->items[$id]['price'] = $newQuantity * _($product->price - $product->discount_price);
            }
        }
    }

    public function remove($id,$product){

        if ($this->items) {
            if (array_key_exists($id,$this->items)) {

                // dd($this->totalPrice - $this->items[$id]['price']);
                $this->totalQuantity = $this->totalQuantity - $this->items[$id]['quantity'];
                $this->totalPrice = $this->totalPrice - $this->items[$id]['price'];
                unset($this->items[$id]);
            }

        }
    }


}
