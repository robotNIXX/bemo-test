<?php


namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Http\Requests\CardMoveRequest;
use App\Http\Requests\CardRequest;
use App\Repositories\CardsRepository;

class CardsController extends Controller
{
    protected $cardsRepository;

    public function __construct(CardsRepository $cardsRepository)
    {
        $this->cardsRepository = $cardsRepository;
    }

    public function store(CardRequest $request)
    {
        $data = $request->get('card');
        $max = $this->cardsRepository->max($data['column_id']);
        $data['weight'] = $max + 1;
        $card = $this->cardsRepository->create($data);

        return $card;
    }

    public function move($id, CardMoveRequest $request)
    {
        $columnId = $request->get('column_id');
        $weight = $this->cardsRepository->max($columnId) + 1;
        if ($request->get('weight')) {
            $weight = $request->get('weight');
        }

        $card = $this->cardsRepository->update(['weight' => $weight, $columnId => $columnId], $id);
    }
}
