<?php

namespace App\Http\Livewire;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Cart;
use App\Models\Category;

class CategoryComponent extends Component
{
    public $sorting;
    public $productperpage;
    public $category_slug;
    public $list;

    public function mount($category_slug)
    {
        $this->sorting          = 'default';
        $this->productperpage   = 12;
        $this->category_slug    = $category_slug;
    }
    public function store($priduct_id, $product_name, $product_price){
        Cart::add($priduct_id, $product_name, 1, $product_price)->associate('App\Models\Product');
        session()->flash('success_msg', 'Item has been added in Cart!');
        return redirect()->route('product.cart');
    }

    public function list($list)
    {
        $this->list = $list;
        session()->flash('msg', 'List mode Active');
        // return redirect()->route('product.category');
    }


    use WithPagination;
    
    public function render()
    {
        $categories     = Category::all();
        $category       = Category::where('slug', $this->category_slug)->first();
        $category_name  = $category->name;

        if ($this->sorting =='date') {
            $products = Product::where('category_id', $category->id)->orderBy('created_at', 'DESC')->paginate($this->productperpage);
        }
        else if ($this->sorting =='price') {
            $products = Product::where('category_id', $category->id)->orderBy('regular_price', 'ASC')->paginate($this->productperpage);
        }
        else if ($this->sorting =='price-desc') {
            $products = Product::where('category_id', $category->id)->orderBy('regular_price', 'DESC')->paginate($this->productperpage);
        }
        else{
            $products = Product::where('category_id', $category->id)->paginate($this->productperpage);
        }
        
        return view('livewire.category-component', compact('products', 'categories', 'category_name'))->layout('layouts.base');
    }
}


// namespace App\Http\Livewire;

// use Livewire\Component;

// class CategoryComponent extends Component
// {
//     public function render()
//     {
//         return view('livewire.category-component');
//     }
// }