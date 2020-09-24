<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    private $table = 'slider';
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
        $id = $this->id;
        $condThumb = 'bail|required|image|max:500';
        $condName = "bail|required|min:5|unique:$this->table,name";
        if(!empty($id)) {
            $condName .= ",$id";
            $condThumb = 'bail|image|max:500';
        }
        return [
            'name' => $condName,
            'description' => 'bail|required',
            'status' => 'bail|in:active,inactive',
            'link' => 'bail|required|url|min:5',
            'thumb' => $condThumb
        ];
    }
    public function messages()
    {
        return [
            // 'name.required' => 'Vui long nhap tieu de',
            // 'name.min' => ':input co it nhat :min ky tu'
        ];
    }
    public function attributes()
    {
        return [
            // 'description' => 'description:'
        ];
    }
}
