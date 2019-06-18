<?php

namespace App\Http\Requests;

class StoreBranchFormRequest extends ANotAuthorizedFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'parent_id' => 'required|integer'
        ];
    }
}
