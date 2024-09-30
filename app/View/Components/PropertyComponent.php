<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PropertyComponent extends Component
{

    public $title;
    public $address;
    public $price;
    public $url;
    public $imageWebp;
    public $image;
    public $area;
    public $type;

    public function __construct($title, $address, $price, $url, $imageWebp, $image, $area, $type)
    {
        $this->title = $title;
        $this->address = $address;
        $this->price = $price;
        $this->url = $url;
        $this->imageWebp = $imageWebp;
        $this->image = $image;
        $this->area = $area;
        $this->type = $type;
    }

    public function render()
    {
        return view('site.components.property-component');
    }
}
