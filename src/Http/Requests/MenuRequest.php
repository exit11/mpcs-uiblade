<?php

namespace Exit11\UiBlade\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Mpcs\Core\Facades\Core;
use Mpcs\Core\Traits\RequestTrait;

class MenuRequest extends FormRequest
{
    use RequestTrait;

    public function rules()
    {
        $rules = $this->getRequestRules();
        if ($rules != null) {
            return $rules;
        }

        $id = $this->menu->id ?? "";
        $parentId = request()->parent_id ?? $this->parant_id;

        $rules = [
            'POST' => [
                'name' => 'required|max:255',
                'description' => 'max:512',
            ],
            'PUT' => [
                'name' => 'sometimes|required|max:255',
                'description' => 'max:512',
            ],
        ];

        return $rules[$this->method()] ?? [];
    }
}
