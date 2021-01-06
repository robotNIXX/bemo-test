<?php


namespace App\Http\Requests;


class CardMoveRequest extends IRFormRequest
{
    public function rules()
    {
        return [
            'column_id' => 'required|exists:columns,id'
        ];
    }

    public function authorize()
    {
        return true;
    }

}
