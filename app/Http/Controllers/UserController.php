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
        'email' => 'required',
        'password' => 'required|min:6'
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
}
