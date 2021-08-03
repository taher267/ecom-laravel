<?php

namespace App\Http\Livewire;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Cart;
use App\Models\Category;

class ShopComponent extends Component
{
    public $sorting, $productperpage, $min_price, $max_price, $price_range, $min_value, $max_value;

    public function mount()
    {
        $this->sorting          = 'default';
        $this->productperpage   = 12;
        $this->min_price        = 1;
        $this->max_price        = 1000;
        $this->price_range      = 80;
    }
    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'min_price' => 'required|numeric|min:1',
            'max_price' => 'required|numeric|gt:min_price',
        ]);
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
            $products = Product::whereBetween('regular_price', [$this->min_price, $this->max_price])->orderBy('created_at', 'DESC')->paginate($this->productperpage);
        }else if ($this->sorting =='price') {
            $products = Product::whereBetween('regular_price', [$this->min_price, $this->max_price])->orderBy('regular_price', 'ASC')->paginate($this->productperpage);
        }else if ($this->sorting =='price-desc') {
            $products = Product::whereBetween('regular_price', [$this->min_price, $this->max_price])->orderBy('regular_price', 'DESC')->paginate($this->productperpage);
        }else{
            $products = Product::whereBetween('regular_price', [$this->min_price, $this->max_price])->paginate($this->productperpage);
        }

        return view('livewire.shop-component', compact('products', 'categories'))->layout('layouts.base');
    }
}
