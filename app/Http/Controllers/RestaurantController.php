<?php

namespace App\Http\Controllers;

use App\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    use ApiControllerTrait;

    protected $model;
    protected $relationships = ['address'];
    protected $rules = [
        'name' => 'required|min:3',
        'description' => 'required'
    ];
    protected $message = [
        'required' => ':attribute é obrigatório.',
        'min' => ':attribute precisa de pelo menos :min caracteres.',
    ];

    public function __construct(Restaurant $model, Request $request)
    {
        $user = \JWTAuth::parseToken()->authenticate();
        $request['user_id'] = $user->id;
        $this->model = $model;
    }

    private function getIdRestaurant()
    {
        $user = \JWTAuth::parseToken()->authenticate();
        $restaurant = \App\User::find($user->id)->restaurant;
        return $restaurant->id;
    }

    public function restaurantByUser()
    {
        $user = \JWTAuth::parseToken()->authenticate();
        $restaurant = $this->show($user->id);
        return response()->json($restaurant->original);
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

    public function upload(Request $request)
    {
        $data['photo'] = $request->file('photo');
        $result = $this->model->findOrFail($this->getIdRestaurant());
        $result->update($data);
        return response()->json($result);
    }
}