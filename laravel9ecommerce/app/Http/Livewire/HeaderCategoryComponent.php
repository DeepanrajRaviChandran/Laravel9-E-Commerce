<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;

class HeaderCategoryComponent extends Component
{
    public function render()
    {
        $categories = Category::orderby('name', 'ASC')->get();


        return view('livewire.header-category-component', ['categories' => $categories]);
    }
}
