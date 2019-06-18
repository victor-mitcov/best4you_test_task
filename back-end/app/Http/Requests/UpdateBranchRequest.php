<?php

namespace App\Http\Requests;

class UpdateBranchRequest extends ANotAuthorizedFormRequest
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
            'id' => 'required|integer'
        ];
    }
}
