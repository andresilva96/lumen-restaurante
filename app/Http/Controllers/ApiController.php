<?php

namespace App\Http\Controllers;

trait ApiController
{
    public function index()
    {
        $result = $this->model->paginator();
        return response()->json($result);
    }
}