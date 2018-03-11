<?php

namespace App\Http\Controllers;

use App\Restaurant;

class RestaurantController extends Controller
{
    use ApiControllerTrait;

    protected $model;

    public function __construct(Restaurant $model)
    {
        $this->model = $model;
    }
}