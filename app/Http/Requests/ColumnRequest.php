<?php


namespace App\Http\Requests;


class ColumnRequest extends IRFormRequest
{
    public function rules()
    {
        return [
            'column.title' => 'required|unique:columns,title'
        ];
    }

    public function authorize()
    {
        return true;
    }

}
