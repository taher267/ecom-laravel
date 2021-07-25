<?php

namespace App\Http\Livewire;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Cart;
use App\Models\Category;

class SearchComponent extends Component
{
    public $sorting;
    public $productperpage;
    public $search;
    public $product_cat;
    public $product_cat_id;

    public function mount()
    {
        $this->sorting          = 'default';
        $this->productperpage   = 12;
        $this->fill(request()->only('search', 'product_cat', 'product_cat_id'));
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
            $products = Product::where('name', 'like', '%'. $this->search.'%')->where('category_id', 'like', '%'. $this->product_cat_id. '%')->orderBy('created_at', 'DESC')->paginate($this->productperpage);
        }else if ($this->sorting =='price') {
            $products = Product::where('name', 'like', '%'. $this->search.'%')->where('category_id', 'like', '%'. $this->product_cat_id. '%')->orderBy('regular_price', 'ASC')->paginate($this->productperpage);
        }else if ($this->sorting =='price-desc') {
            $products = Product::where('name', 'like', '%'. $this->search.'%')->where('category_id', 'like', '%'. $this->product_cat_id. '%')->orderBy('regular_price', 'DESC')->paginate($this->productperpage);
        }else{
            $products = Product::where('name', 'like', '%'. $this->search.'%')->where('category_id', 'like', '%'. $this->product_cat_id. '%')->paginate($this->productperpage);
        }
        
        return view('livewire.search-component', compact('products', 'categories'))->layout('layouts.base');
    }
}
