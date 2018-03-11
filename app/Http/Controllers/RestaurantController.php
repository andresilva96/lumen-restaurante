<?php

namespace App\Http\Controllers;

use App\Restaurant;

class RestaurantController extends Controller
{
    use ApiControllerTrait;

    protected $model;
    protected $rules;
    protected $message;

    public function __construct(Restaurant $model)
    {
        $this->model = $model;
        $this->rules = [
            'name' => 'required|min:3',
            'description' => 'required'
        ];
        $this->message = [
            'required' => ':attribute é obrigatório.',
            'min' => ':attribute precisa de pelo menos :min caracteres.',
        ];
    }
}