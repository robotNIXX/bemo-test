<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $table = 'cards';

    protected $fillable = [
        'title',
        'description',
        'column_id',
        'weight'
    ];

    /**
     * Column
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function column()
    {
        return $this->belongsTo(Column::class, 'column_id');
    }
}
