<?php

namespace App\Http\Controllers;

trait ApiControllerTrait
{
    public function index()
    {
        $result = $this->model->paginate();
        return response()->json($result);
    }
}