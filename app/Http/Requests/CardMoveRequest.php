<?php


namespace App\Http\Requests;


class CardMoveRequest extends IRFormRequest
{
    public function rules()
    {
        return [
            'column_id' => 'exists:columns,id'
        ];
    }

    public function authorize()
    {
        return true;
    }

}
