<?php

namespace App\Http\Livewire;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Cart;
use App\Models\Category;

class ShopComponent extends Component
{
    public $sorting;
    public $productperpage;

    public function mount()
    {
        $this->sorting          = 'default';
        $this->productperpage   = 12;
    }
    public function store($priduct_id, $product_name, $product_price){
        Cart::add($priduct_id, $product_name, 1, $product_price)->associate('App\Models\Product');
        session()->flash('success_msg', 'Item has been added in Cart!');
        return redirect()->route('product.cart');
    }


    use WithPagination;
    
    public function render()
    {
        
        $categories = Category::all();
        
        if ($this->sorting =='date') {
            $products = Product::orderBy('created_at', 'DESC')->paginate($this->productperpage);
        }else if ($this->sorting =='price') {
            $products = Product::orderBy('regular_price', 'ASC')->paginate($this->productperpage);
        }else if ($this->sorting =='price-desc') {
            $products = Product::orderBy('regular_price', 'DESC')->paginate($this->productperpage);
        }else{
            $products = Product::paginate($this->productperpage);
        }
        
        return view('livewire.shop-component', compact('products', 'categories'))->layout('layouts.base');
    }
}
