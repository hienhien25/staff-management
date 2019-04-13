<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckinRequest extends FormRequest
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
            'start_hour'=>'required',
            'finish_hour'=>'required'
        ];
    }
    public function messages()
    {
        return [
            'start_hour.required'=>'Bạn chưa điền thời gian bắt đầu làm việc !',
            'finish_hour.required'=>'Bạn chưa điền thời gian kết thúc !'
        ];
    }
}
