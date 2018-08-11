<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ApiControllerTrait;
use App\User;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;

class UserController extends Controller
{
    use ApiControllerTrait;

    protected $model;
    protected $rules = [
        'name' => 'required',
        'password' => 'min:6',
        'password_confirm' => 'same:password',
    ];
    protected $messages = [
        'required' => ':attribute é obrigatório',
        'min' => ':attribute precisa de pelo menos :min caracteres'
    ];
    protected $relationships = ['restaurant'];

    public function __construct(User $model, Request $request)
    {
        $request['password'] = app('hash')->make($request['password']);
        $this->model = $model;
    }

    public function updateUser(Request $request)
    {
        $user = \JWTAuth::parseToken()->authenticate();

        $result = $this->model->find($user->id);
        $result->update($request->all());
        return response()->json($result);
    }

    public function getUser()
    {
        $user = \JWTAuth::parseToken()->authenticate();
        return $this->show($user->id);
    }
}
