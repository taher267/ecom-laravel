<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Str;

class AdminAddCategoryComponent extends Component
{
    public $name, $slug, $check_cat, $confirmSlug, $checkCat, $slugYes, $slugNo;

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);

        $this->checkCat = Category::where('slug', $this->slug)->first();
        if ('' == $this->slug  || $this->checkCat) {
            return $this->slugYes ='';
        }
        elseif("" != $this->slug && ! $this->checkCat){

            return $this->slugYes ='avaiable';
        }
    }

    //live validation
    public function updated( $fields )
    {
        $this->validateOnly($fields, [
            'slug' => 'required|unique:categories',
            'name' => 'required|unique:categories',
        ]);
    }
    //Data add/store in DB
    public function storeCategory()
    {
        $this->validate([
            'slug' => 'required|unique:categories',
            'name' => 'required|unique:categories',
        ]);

        $category = new Category;
        $category->name = $this->name;
        $category->slug = $this->slug;
        if ($category->save()) {
            session()->flash('msg', 'Category has been added!!!');
        }

    }

    public function render()
    {
        return view('livewire.admin.admin-add-category-component')->layout('layouts.base');
    }
}
