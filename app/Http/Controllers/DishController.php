<?php

namespace App\Http\Controllers;

use App\Dish;
use Laravel\Lumen\Routing\Controller;

class DishController extends Controller
{
    use ApiControllerTrait;

    protected $model;
    protected $rules = [
        'name' => 'required',
        'description' => 'required',
        'price' => 'required',
        'photo' => 'required',
        'restaurant_id' => 'required'
    ];
    protected $messages = [
        'required' => ':attribute é obrigatório',
        'min' => ':attribute precisa de pelo menos :min caracteres'
    ];

    public function __construct(Dish $model)
    {
        $this->model = $model;
    }
}
