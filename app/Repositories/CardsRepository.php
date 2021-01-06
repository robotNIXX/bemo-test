<?php


namespace App\Repositories;


use App\Models\Card;
use Prettus\Repository\Eloquent\BaseRepository;

class CardsRepository extends BaseRepository
{
    public function model()
    {
        return Card::class;
    }

    public function max($columnId) {
        return $this->model->where('column_id', $columnId)->max('weight');
    }

}
