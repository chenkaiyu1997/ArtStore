<?php

/**
 * Created by PhpStorm.
 * User: justryit
 * Date: 16/6/1
 * Time: 12:17
 */
class ShoppingCart implements Serializable {
    
    public $items;
    
    public function __construct($items)
    {
        $this->items = $items;
    }

    public function serialize() {
        return serialize($this->items);
    }
    public function unserialize($serialized){
        $data = unserialize($serialized);
        $this->items = $data;
    }
}