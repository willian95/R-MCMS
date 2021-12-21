<?php

namespace App\Http\Requests\ServiceImage;

use Illuminate\Foundation\Http\FormRequest;

class ServiceImageStoreRequest extends FormRequest
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
            "image1" => "required",
            "image2" => "required",
            "image3" => "required"
        ];
    }
}
