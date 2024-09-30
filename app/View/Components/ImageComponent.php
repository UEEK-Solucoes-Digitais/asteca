<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ImageComponent extends Component
{
    public $image;
    public $webp;
    public $alt;
    public $customClass = "";
    public $customWidth;
    public $customHeight;

    public function __construct($image, $webp, $alt, $customClass, $customWidth, $customHeight)
    {
        $this->image = $image;
        $this->webp = $webp;
        $this->alt = $alt;
        $this->customClass = $customClass;
        $this->customWidth = $customWidth;
        $this->customHeight = $customHeight;
    }

    public function render()
    {
        return view('site.components.image_component');
    }
}
