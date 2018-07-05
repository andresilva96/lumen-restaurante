<?php

namespace App\Http\Controllers;

use App\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    use ApiControllerTrait;

    protected $model;
    protected $rules;
    protected $message;
    protected $relationships = ['address'];

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

    public function restaurantByUser()
    {
        $user = \JWTAuth::parseToken()->authenticate();
        $restaurant = $this->show($user->id);
        return response()->json($restaurant);
    }

    public function address(Request $request)
    {
        $user = \JWTAuth::parseToken()->authenticate();
        $restaurant = \App\User::find($user->id)->restaurant;

        $restaurant = $this->model->findOrFail($restaurant->id);
        $address = $restaurant->address;

        if (!$address) {
            $address = \App\Address::create($request->all());
        } else {
            $address->update($request->all());
        }
        $restaurant->address()->save($address);
        return response()->json($address);
    }
}