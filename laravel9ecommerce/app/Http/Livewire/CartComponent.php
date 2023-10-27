<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Cart;

class CartComponent extends Component
{
    public function increaseQuantity($rowId)
    {
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty + 1;
        Cart::instance('cart')->update($rowId, $qty);
        $this->emitTo('cart-icon-component', 'refreshComponent');
    }

    public function decreaseQuantity($rowId)
    {
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty - 1;
        Cart::instance('cart')->update($rowId, $qty);
        $this->emitTo('cart-icon-component', 'refreshComponent');
    }

    public function delete($id)
    {
        Cart::instance('cart')->remove($id);
        session()->flash('success_message', 'Item Removed!');
        $this->emitTo('cart-icon-component', 'refreshComponent');
    }

    public function deleteAll()
    {
        Cart::instance('cart')->destroy();
        session()->flash('success_message', 'All Items Removed!');
        $this->emitTo('cart-icon-component', 'refreshComponent');
    }


    public function render()
    {
        return view('livewire.cart-component');
    }
}
