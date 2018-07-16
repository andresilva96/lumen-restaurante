<?php

namespace App\Http\Controllers;

use App\RestaurantPhoto;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;

class RestaurantPhotosController extends Controller
{
    use ApiControllerTrait;

    protected $model;
    protected $rules = [
        'url' => 'required',
        'restaurant_id' => 'required'
    ];
    protected $messages = [
        'required' => ':attribute é obrigatório',
    ];

    public function __construct(RestaurantPhoto $model)
    {
        $this->model = $model;
    }

    private function getIdRestaurant()
    {
        $user = \JWTAuth::parseToken()->authenticate();
        $restaurant = \App\User::find($user->id)->restaurant;
        return $restaurant->id;
    }

    public function index(Request $request)
    {
        $results =  $this->model
            ->where('restaurant_id', $this->getIdRestaurant())
            ->get();
        
        return response()->json($results);
    }
}
