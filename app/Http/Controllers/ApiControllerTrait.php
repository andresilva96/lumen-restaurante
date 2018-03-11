<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

trait ApiControllerTrait
{
    public function index()
    {
        $result = $this->model->paginate();
        return response()->json($result);
    }

    public function show($id)
    {
        $result = $this->model->find($id);
        return response()->json($result);
    }

    public function insert(Request $request)
    {
        $result = $this->model->create($request->all());
        return response()->json($result);

    }

    public function update(Request $request, $id)
    {
        $result = $this->model->find($id);
        // precisa obter o objeto para atualizar
        $result->update($request->all());
        return response()->json($result);
    }

    public function delete($id)
    {
        $result = $this->model->find($id);
        // precisa obter o objeto para deletar
        $result->delete();
        return response()->json($result);
    }
}