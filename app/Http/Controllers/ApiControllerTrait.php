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
        $result = $this->model
            ->with($this->relationships())
            ->findOrFail($id);
        return response()->json($result);
    }

    protected function relationships()
    {
        if (isset($this->relationships)) {
            return $this->relationships;
        }
        return [];
    }

    public function insert(Request $request)
    {
        $this->validate($request, $this->rules ?? [], $this->message ?? []);
        $result = $this->model->create($request->all());
        return response()->json($result);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, $this->rules ?? [], $this->message ?? []);
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