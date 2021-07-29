<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Livewire\WithFileUploads;

class AdminEditProductComponent extends Component
{
    use WithFileUploads;

    public $product_id, $product_slug, $name, $slug, $short_description, $checkSlug,
            $description, $image, $newimage, $regular_price, $sale_price, $SKU, $featured,
            $category_id, $sel_categories=[], $quantity, $stock_status;
    public $pre_slug;

    public function mount($product_slug)
    {
        $this->pre_slug = $product_slug;
        $product = Product::where('slug', $product_slug)->first();
        $this->product_id           = $product->id;
        $this->name                 = $product->name;
        $this->slug                 = $product->slug;
        $this->short_description    = $product->short_description;
        $this->description          = $product->description;
        $this->regular_price        = $product->regular_price;
        $this->sale_price           = $product->sale_price;
        $this->SKU                  = $product->SKU;
        $this->stock_status         = $product->stock_status;
        $this->featured             = $product->featured;
        $this->quantity             = $product->quantity;
        $this->image                = $product->image;
        $this->category_id          = $product->category_id;
        $this->sel_categories       = $product->categories;

    }
    //genetate slug and check with Database
    public function generateSlug()
    {
        $this->slug     = Str::slug($this->name);
        $this->checkCat = Product::where('slug', $this->slug)->first();

        if ( '' == $this->slug  || $this->checkCat ) {
            return $this->checkSlug ='';
        }elseif( "" != $this->slug && ! $this->checkCat ){

            return $this->checkSlug ='avaiable';
        }
    }
    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name'                  => ['required', \Illuminate\Validation\Rule::unique('products')->ignore($this->product_id)],
            'slug'                  => ['required', \Illuminate\Validation\Rule::unique('products')->ignore($this->product_id)],
            'short_description'     => 'nullable',
            'description'           => 'required',
            'regular_price'         => 'required|numeric',
            'sale_price'            => 'nullable|numeric',
            'SKU'                   => ['required', \Illuminate\Validation\Rule::unique('products')->ignore($this->product_id)],
            'stock_status'          => 'required',
            'featured'              => 'required|numeric|min:0|max:1',
            'quantity'              => 'required|numeric',
            'newimage'              => 'nullable|mimes:png,jpg,jpeg,gif|image',
            'category_id'           => 'required|numeric|min:1',
            'sel_categories'         => ['required'],
        ]);
    }
    public function updateProduct()
    {
        $this->validate([
            'name'                  => ['required', \Illuminate\Validation\Rule::unique('products')->ignore($this->product_id)],
            'slug'                  => ['required', \Illuminate\Validation\Rule::unique('products')->ignore($this->product_id)],
            'short_description'     => 'nullable',
            'description'           => 'required',
            'regular_price'         => 'required',
            'sale_price'            => 'nullable',
            'SKU'                   => ['required', \Illuminate\Validation\Rule::unique('products')->ignore($this->product_id)],
            'stock_status'          => 'required',
            'featured'              => 'required|numeric|min:0|max:1',
            'quantity'              => 'required|numeric',
            'newimage'              => 'nullable|image|mimes:png,jpg,jpeg,gif',
            'category_id'           => 'required|numeric|min:1',
            'sel_categories'         => ['required'],
        ]);


        $product                    = Product::findOrFail($this->product_id);
        $product->name              = $this->name;
        $product->slug              = $this->slug;
        $product->short_description = $this->short_description;
        $product->description       = $this->description;
        $product->regular_price     = $this->regular_price;
        $product->sale_price        = $this->sale_price;
        $product->SKU               = $this->SKU;
        $product->stock_status      = $this->stock_status;
        $product->featured          = $this->featured;
        $product->quantity   = $this->quantity;
        $product->category_id = $this->category_id;
        $product->categories = $this->sel_categories;

        //Exist image than update of image data
        if ( $this->newimage ) {
            $imageName = Carbon::now()->timestamp . '.' . $this->newimage->extension();
            $product->image = $imageName;
        }


        //update data
        if ( $product->save() )
        {
            //update new image
            if ( $this->newimage ) {
                $this->newimage->storeAs('products', $imageName);
            }
            //Update products Categories in pvot table=product_category
            $product->categories()->sync($this->sel_categories);

            session()->flash('msg', 'Product has been updated!!!');
        }

    }
    public function render()
    {
        $product = Product::where('slug', $this->product_slug)->first();
        $categories = Category::all();
        return view('livewire.admin.admin-edit-product-component', compact('categories', 'product'))->layout('layouts.base');
    }
}
