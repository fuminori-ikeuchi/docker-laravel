<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StockForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;                 // trueに変更（falseだとエラーになる）
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()                                     // フォームリクエスト(バリデーションルール)
    {
        return [
            'name' => 'required|string|max:50',                 // stock/registerのformのinputタグのname="name"のところ
            'price' => 'required|numeric|min:100',              // stock/registerのformのinputタグのname="price"のところ
        ];
    }

    public function messages()                                 // エラーメッセージ
    {
        return [
            'name.required' => '商品名を入力して下さい。',
            'name.max' => ':attributeは:max文字以下で入力して下さい。',
            'price.required' => '金額を入力して下さい。',
            'price.min' => ':attributeは:min円以上で入力して下さい。',
        ];
    }

    public function attributes()                              // 表示変更
    {
        return [
            'name' => '商品名',
            'price'  => '金額'
        ];
    }
}
