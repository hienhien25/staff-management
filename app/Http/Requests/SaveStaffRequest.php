<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveStaffRequest extends FormRequest
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
            'fullname'=>'required|min:2|max:50',
            'email'=>'required|email|min:8|max:255',
            'password'=>'required|min:8|max:30',
            'phone'=>'required|min:8|max:12',
            'address'=>'required',
            'larary'=>'required|number',
            'dob'=>'required'
        ];
    }
    public function messages()
    {
        return [
            
                'fullname.required'=>'Bạn chưa điền tên !',
                'fullname.min'=>'Vui lòng nhập tên từ 2 kí tự trở lên!',
                'fullname.max'=>'Tên dài không quá 50 kí tự!',
                'email.required'=>'Bạn chưa điền email !',
                'email.email'=>'Email của bạn không hợp lệ !',
                'email.min'=>'Vui lòng nhập email từ 8 kí tự trở lên !',
                'email.max'=>'Email dài không quá 255 kí tự',
                'password.required'=>'Bạn chưa nhập mật khẩu',
                'password.min'=>'Vui lòng nhập mật khẩu từ 8 kí tự trở lên !',
                'password.max'=>'Mật khẩu dài không quá 30 kí tự!',
                'phone.required'=>'Bạn chưa nhập SĐT !',
                'phone.min'=>'Vui lòng nhập mật khẩu từ 8 kí tự trở lên !',
                'phone.max'=>'Mật khẩu dài không quá 12 kí tự!',
                'address.required'=>'Bạn chưa nhập địa chỉ !',
                'larary.required'=>'Bạn chưa nhập lương !',
                'larary.number'=>'Vui lòng điền số !',
                'dob.required'=>'Bạn chưa điền ngày sinh !'
        ];
    }
}
