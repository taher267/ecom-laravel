<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Str;

class AdminEditCategoryComponent extends Component
{
    public $name, $slug,  $category_slug, $category_id, $slugYes;

    public function mount($category_slug)
    {
        $this->category_slug    = $category_slug;
        $category               = Category::where('slug', $this->category_slug)->first();
        $this->category_id      = $category->id;
        $this->name             = $category->name;
        $this->slug             = $category->slug;
    }

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
    //update data of Category for DB
    public function updateCategory()
    {
        $this->validate([
            'slug' => 'required|unique:categories',
            'name' => 'required|unique:categories',
        ]);

        $category = Category::findOrFail($this->category_id);
        $category->name = $this->name;
        $category->slug = $this->slug;
        if ($category->save()) {
            session()->flash('msg', 'Category has been updated!!!');
        }

    }

    public function render()
    {
        return view('livewire.admin.admin-edit-category-component')->layout('layouts.base');
    }
}
