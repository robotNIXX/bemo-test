<?php


namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Http\Requests\ColumnRequest;
use App\Repositories\ColumnsRepository;

class ColumnsController extends Controller
{
    protected $columnsRepository;

    public function __construct(ColumnsRepository $columnsRepository)
    {
        $this->columnsRepository = $columnsRepository;
    }

    public function index() {
        $columns = $this->columnsRepository->with(['cards'])->all();

        return $columns;
    }

    /**
     * @param ColumnRequest $request
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Support\Collection|mixed
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(ColumnRequest $request) {
        $column = $this->columnsRepository->create($request->get('column'));

        return $column;
    }
}
