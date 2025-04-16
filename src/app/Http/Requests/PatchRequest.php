<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatchRequest extends FormRequest
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
        $rules = [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0|max:10000',
            'seasons' => 'required|array',
            'seasons.*' => 'in:春,夏,秋,冬',
            'description' => 'required|string|max:120',
            'image' => 'required|image|mimes:jpeg,png|max:2048',
        ];
            // 新しい画像がアップロードされた場合のみバリデーションを適用
        if ($this->isMethod('patch') && !$this->hasFile('image')) {
            $rules['image'] = 'nullable'; // 画像がない場合はエラーを発生させない
        } else {
            $rules['image'] = 'required|image|mimes:jpeg,png|max:2048';
        }

        return $rules;
    }

        /**
     * Get custom error messages for validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => '商品名を入力してください',
            'price.required' => '値段を入力してください',
            'price.numeric' => '数値で入力してください',
            'price.min' => '0~10000円以内で入力してください',
            'price.max' => '0~10000円以内で入力してください',
            'seasons.required' => '季節を選択してください',
            'description.required' => '商品説明を入力してください',
            'description.max' => '120文字以内で入力してください',
            'image.required' => '商品画像を登録してください',
            'image.image' => '「.png」または「.jpeg」形式でアップロードしてください',
            'image.mimes' => '「.png」または「.jpeg」形式でアップロードしてください',
        ];
    }
}
