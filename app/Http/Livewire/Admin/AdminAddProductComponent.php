<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Livewire\WithFileUploads;

class AdminAddProductComponent extends Component
{
    use WithFileUploads;

    public $name, $slug, $short_description, $checkSlug, $description, $image, $regular_price,
    $sale_price, $SKU, $featured, $category_id, $quantity, $stock_status;
    //poduct categories
    public $sel_categories =[], $no_of_products;
    //product categories for pvot table
    public $product_id, $categories_id;
    public function mount()
    {
        $this->stock_status = 'instock';
        $this->featured     = 0;
        $this->description  = $this->description;

    }
    //genetate slug and check with Database
    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);

        $this->checkCat = Product::where('slug', $this->slug)->first();
        if ('' == $this->slug  || $this->checkCat) {
            return $this->checkSlug ='';
        }
        elseif("" != $this->slug && ! $this->checkCat){

            return $this->checkSlug ='avaiable';
        }
    }
    //check live validation
    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required|unique:products',
            'slug' => 'required|unique:products',
            'short_description' => 'nullable',
            'description' => 'required',
            'regular_price' => 'required',
            'sale_price' => 'nullable',
            'SKU' => 'required|unique:products',
            'stock_status' => 'required',
            'featured' => 'required|numeric|min:0|max:1',
            'quantity' => 'required|numeric',
            'image' => 'nullable|image|mimes:png,jpg,jpeg',
            'category_id' => 'required|numeric|min:1',
            'sel_categories' => ['required'],
        ]);
}
        // public function validSubmit()
        // {

        // }

    public function storeProduct()
    {
        $this->validate([
            'name' => 'required|unique:products',
            'slug' => 'required|unique:products',
            'short_description' => 'nullable',
            'description' => 'required',
            'regular_price' => 'required',
            'sale_price' => 'nullable',
            'SKU' => 'required|unique:products',
            'stock_status' => 'required',
            'featured' => 'required|numeric|min:0|max:1',
            'quantity' => 'required|numeric',
            'image' => 'nullable|image|mimes:png,jpg,jpeg',
            'category_id' => 'required|numeric|min:1',
            'sel_categories' => ['required'],
        ]);


        $product = new Product;
        $product->name = $this->name;
        $product->slug = $this->slug;
        $product->short_description = $this->short_description;
        $product->description = $this->description;
        $product->regular_price = $this->regular_price;
        $product->sale_price = $this->sale_price;
        $product->SKU = $this->SKU;
        $product->stock_status = $this->stock_status;
        $product->featured = $this->featured;
        $product->quantity = $this->quantity;
        if ($this->image) {
            $imageName = $this->slug . Carbon::now()->timestamp . '.' . $this->image->extension();
            $product->image = $imageName;
        }
        $product->category_id = $this->category_id;
        $product->categories = implode(',', $this->sel_categories);
        if ($product->save()) {
            if ($this->image) {
                $this->image->storeAs('products', $imageName);
            }
            //Add products Categories in pvot table=product_category
            $categoryAttach = Product::findOrFail(Product::orderBy('id', 'DESC')->first()->id);
           //tag adding
           $categoryAttach->pro_categories()->sync($this->sel_categories);

            session()->flash('msg', 'Product has been added!!!');
        }

    }
    public function render()
    {
        $categories = Category::all();
        return view('livewire.admin.admin-add-product-component', compact('categories'))->layout('layouts.base');
    }
}
