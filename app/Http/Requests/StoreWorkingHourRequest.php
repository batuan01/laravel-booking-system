<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWorkingHourRequest extends FormRequest
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
            'staff_id' => 'required|exists:staff,id',
            'day_of_week' => 'required|integer|between:0,6',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
        ];
    }

    /**
     * Đảm bảo start_time < end_time — không thể validate 2 field cùng lúc
     * bằng rule đơn lẻ nên phải dùng withValidator() để so sánh thủ công.
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->start_time && $this->end_time && $this->start_time >= $this->end_time) {
                $validator->errors()->add('end_time', 'Giờ kết thúc phải sau giờ bắt đầu.');
            }
        });
    }
}
