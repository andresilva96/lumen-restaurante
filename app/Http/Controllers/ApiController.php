<?php

namespace App\Http\Controllers;

trait ApiController
{
    public function index()
    {
        $result = $this->model->paginate();
        return response()->json($result);
    }
}