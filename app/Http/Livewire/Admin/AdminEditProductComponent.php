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
            $description, $image, $newimage, $images, $newImages, $regular_price, $sale_price, $SKU, $featured,
            $category_id, $sel_categories=[], $quantity, $stock_status, $updated_id;

    public function mount($product_slug)
    {
        $product                    = Product::where('slug', $product_slug)->first();
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
        $this->images               = explode(',', $product->images);
        $this->category_id          = $product->category_id;
        $this->sel_categories       = $product->pro_categories;

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
            'newimage'              => 'image|mimes:png,jpg,jpeg|nullable',
            'category_id'           => 'required|numeric|min:1',
            // 'sel_categories.*'        => 'required',
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
            // 'sel_categories.*'        => ['required'|'numeric'],
        ]);


        $product                    = Product::findOrFail($this->product_id);
        $product->name              = $this->name;
        $product->slug              = $this->slug;
        $this->updated_id           = $this->product_id;
        $product->short_description = $this->short_description;
        $product->description       = $this->description;
        $product->regular_price     = $this->regular_price;
        $product->sale_price        = $this->sale_price;
        $product->SKU               = $this->SKU;
        $product->stock_status      = $this->stock_status;
        $product->featured          = $this->featured;
        $product->quantity   = $this->quantity;
        // $product->category_id = $this->category_id;
        // $product->categories = $this->sel_categories;

        //Exist image than update of image data
        if ( $this->newimage ) {
            $imageName      = Carbon::now()->timestamp . '.' . $this->newimage->extension();
            $product->image = $imageName;
        }
        //Is exist data of new product gallery images
        if ( $this->newImages) {
            $newImagesName = '';
            foreach ($this->newImages as $key => $image) {
                $newImgName         = $this->slug . '-' . $key. '-' . Carbon::now()->timestamp . '.' . $image->extension();
                $newImagesName     = $newImagesName . $newImgName. ',';
            }
            $product->images = $newImagesName;

        }

        //update data
        if ( $product->save() )
        {
            //update new image
            if ( $this->newimage ) {
                $this->newimage->storeAs( 'products', $imageName );
            }

             /**
             * If exist product Gallery Images
             */
            if ($this->newImages) {
                //Delete Old data
                if ( Storage::disk('local')->exists( "products/$product->slug" ) ) {
                   Storage::disk('local')->deleteDirectory( "products/$product->slug" );
                }
                //Update new data
                foreach ($this->newImages as $key => $image) {
                    $imagesName = $this->slug . '-' . $key. '-' . Carbon::now()->timestamp . '.' . $image->extension();
                    $image->storeAs( 'products/'.$this->slug, $imagesName );
                }
            }
            //Update products Categories in pvot table=product_category
            // $product->pro_categories()->sync($this->sel_categories);

            session()->flash('msg', 'Product has been updated!!!');
            return redirect()->to('/admin/product/edit/'. $this->slug);
        }

    }

    protected function cleanupOldUploads()
    {

        $storage = Storage::disk('local');
        foreach ($storage->allFiles('livewire-tmp') as $filePathname) {
            $yesterdaysStamp = now()->subMinutes(5)->timestamp;
            if ($yesterdaysStamp > $storage->lastModified($filePathname)) {
                $storage->delete($filePathname);
            }
        }
    }

    public function render()
    {
        $product = Product::where( 'slug', $this->product_slug )->first();
        $categories = Category::all();
        return view('livewire.admin.admin-edit-product-component', compact('categories'))->layout('layouts.dashboard');
    }
}
