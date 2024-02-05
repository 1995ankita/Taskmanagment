<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [

            'folder_id' => 'required|exists:folders,id',
            'name' => 'required|string',
            'display_name' => 'required|string',
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
            // 'extension' => 'required|string',
            // 'path' => 'required|string',
            'permissions' => 'required|array', // Assuming permissions are passed as an array
            'permissions.*' => 'exists:permissions,id', // Assuming permissions are checked against an existing "permissions" table
        ];
    }
}
