<?php

namespace App\Http\Controllers;

use App\Restaurant;

class RestaurantController extends Controller
{
    use ApiController;

    protected $model;

    public function __construct(Restaurant $model)
    {
        $this->model = $model;
    }
}