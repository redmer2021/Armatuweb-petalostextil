<?php

namespace App\Livewire\Componentes;

use Livewire\Attributes\On;
use Livewire\Component;

class Slider1 extends Component
{
    public $imagenes = [];
    public $renderizar = true;


    #[On('defRender')] 
    public function Renderizar($varRender){
        $this->renderizar = $varRender;
    }
    
    public function mount()
    {
        $this->imagenes = [
            asset('imgs/slider1.jpeg'),
            asset('imgs/slider2.jpeg'),
            asset('imgs/slider1.jpeg'),
            asset('imgs/slider2.jpeg'),
        ];
    }

    public function render()
    {
        return view('livewire.componentes.slider1');
    }
}
