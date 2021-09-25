<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StockProcessRequest extends FormRequest
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
            'stock_code'=>'required|unique:stocks',
            'purchase_price'=>'required',
            'purchase_date'=>'required',
            'amount'=>'required',
        ];
    }
}
