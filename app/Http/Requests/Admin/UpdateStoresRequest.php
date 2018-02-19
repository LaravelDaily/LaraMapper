<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStoresRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            
            'categories.*' => 'exists:categories,id',
            'name' => 'max:255|required',
            'description' => 'required',
            'address_address'=>'required',
            'address_latitude'=>'required',
            'address_longitude'=>'required',
            'phone' => 'required|string',
        ];
    }
}
