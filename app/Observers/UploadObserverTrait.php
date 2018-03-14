<?php

namespace App\Observers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait UploadObserverTrait
{
    protected function sendFile($model)
    {
        $field = $this->field;
        if ($model->$field instanceof UploadedFile && $model->$field->isValid()) {
            $this->upload($model);
        }
    }

    protected function removeFile($model)
    {
        $field = $this->field;
        Storage::delete($this->path . $model->$field);
    }

    protected function updateFile($model)
    {
        $field = $this->field;
        if (is_a($model->$field, UploadedFile::class) && $model->$field->isValid()) {
            $previous_image = $model->getOriginal($field);
            $this->upload($model);

            Storage::delete($this->path . $previous_image);
        }
    }

    protected function upload($model)
    {
        $field = $this->field;
        // Gera nome randomico com extensao
        $extension = $model->$field->extension();
        $name = bin2hex(random_bytes(8));
        $name = $name . '.' . $extension;
        // Envia para a Amazon e depois atualiza
        $model->$field->storeAs($this->path, $name);
        $model->$field = $name;
    }
}