<?php

namespace App\Http\Livewire;

use App\Services\GalleryScanner;
use Livewire\Component;



class GalleryLightbox extends Component
{
    public $categories = [];

    public function mount(GalleryScanner $categoryScanner)
    {
        $this->categories = $categoryScanner->scanCategories();
    }

    public function render()
    {
        return view('livewire.gallery-lightbox');
    }
}
