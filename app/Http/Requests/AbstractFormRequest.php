<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Database\Eloquent\Model;

class AbstractFormRequest extends FormRequest
{
    public function setPropertyFromModel(Model $model)
    {
        foreach (array_keys($this->rules()) as $name) {
            if (isset($model->$name)) {
                $this->$name = $model->$name;
            }
        }
    }

    public function setModelFromFormRequest(Model $model, array $exceptProperties = [])
    {
        foreach (array_keys($this->rules()) as $name) {
            if (!in_array($name, $exceptProperties)) {
                $model->$name = $this->$name;
            }
        }

        return $model;
    }
}
