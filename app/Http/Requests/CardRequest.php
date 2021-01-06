<?php


namespace App\Http\Requests;


class CardRequest extends IRFormRequest
{
    public function rules()
    {
        return [
            'card.title' => 'required',
            'card.description' => 'required',
            'card.column_id' => 'required|exists:columns,id'
        ];
    }

    public function authorize()
    {
        return true;
    }

}
