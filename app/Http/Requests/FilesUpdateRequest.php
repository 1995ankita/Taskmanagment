<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilesUpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [

            'folder_id' => 'required|exists:folders,id',
            'name' => 'required|string',
            'display_name' => 'required|string',
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
            // 'path' => 'required|string',
            // 'name' => 'required|string',
            // 'display_name' => 'required|string',
            // 'extension' => 'required|string',
            // 'permissions' => 'required|array', // Assuming permissions are passed as an array
            // 'permissions.*' => 'exists:permissions,id', // Assuming permissions are checked against an existing "permissions" table

        ];
    }
}
