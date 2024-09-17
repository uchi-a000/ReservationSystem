<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShopRepRequest extends FormRequest
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
            'shop_name' => ['required', 'string', 'max:255'],
            'area' => ['required'],
            'genre' => ['required'],
            'description' => ['required', 'min:50', 'max:150'],
            'image' => ['required', 'image', 'max:2048'],
        ];
    }

    public function messages()
    {
        return [
            'shop_name.required' => '店舗名を入力してください',
            'shop_name.string' => '店舗名は文字列で入力してください',
            'shop_name.max' => '店舗名は255文字以下で入力してください',
            'area.required' => 'エリアを選択してください',
            'genre.required' => 'ジャンルを選択してください',
            'description.required' => '説明文を入力してください',
            'description.min' => '説明文は50文字以上で入力してください',
            'description.max' => '説明文は150文字以内で入力してください',
            'image.required' => '画像を添付してください',
            'image.image' => 'jpeg、png、jpg形式のファイルでなければなりません',
            'image.max' => 'ファイルサイズは2MBまでしか許可されません',
        ];
    }
}
