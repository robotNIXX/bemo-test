<?php


namespace App\Repositories;


use App\Models\Column;
use Prettus\Repository\Eloquent\BaseRepository;

class ColumnsRepository extends BaseRepository
{
    public function model()
    {
        return Column::class;
    }

}
