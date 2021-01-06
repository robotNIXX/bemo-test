<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Column extends Model
{
    protected $table = 'columns';

    protected $fillable = [
        'title',
        'weight',
        'is_default'
    ];

    /**
     * Cards list
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cards()
    {
        return $this->hasMany(Card::class, 'column_id')->orderBy('weight', 'ASC');
    }
}
