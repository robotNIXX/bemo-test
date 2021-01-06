<?php


namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Http\Requests\CardMoveRequest;
use App\Http\Requests\CardRequest;
use App\Repositories\CardsRepository;
use App\Repositories\ColumnsRepository;

class CardsController extends Controller
{
    protected $cardsRepository;
    protected $columnsRepository;

    public function __construct(CardsRepository $cardsRepository, ColumnsRepository $columnsRepository)
    {
        $this->cardsRepository = $cardsRepository;
        $this->columnsRepository = $columnsRepository;
    }

    public function store(CardRequest $request)
    {
        $data = $request->get('card');
        $max = $this->cardsRepository->max($data['column_id']);
        $data['weight'] = $max + 1;
        $card = $this->cardsRepository->create($data);

        return $card;
    }

    public function update($id, CardMoveRequest $request)
    {
        $card = $this->cardsRepository->findByField('id', $id)->first();
        if ($request->get('column_id')) {
            $columnId = $request->get('column_id');
            $newWeight = $card->weight;
            $cards = $this->cardsRepository->findWhere([['weight', '>', $newWeight], 'column_id' => $columnId]);
            if (count($cards) > 0) {
                foreach ($cards as $item) {
                    $this->cardsRepository->update(['weight' => $item->weight - 1], $item->id);
                }
            }
            $weight = $this->cardsRepository->max($columnId) + 1;
            if ($request->get('weight')) {
                $weight = $request->get('weight');
            }

            $card = $this->cardsRepository->update(['weight' => $weight, 'column_id' => $columnId], $id);
        }
        if ($request->get('weight')) {
            $weight = $request->get('weight');
            $prevCard = $this->cardsRepository->findWhere(['weight' => $weight, 'column_id' => $card->column_id])->first();
            $this->cardsRepository->update(['weight' => $card->weight], $prevCard->id);
            $card = $this->cardsRepository->update(['weight' => $request->get('weight')], $id);
        }

        return $this->columnsRepository->with(['cards'])->all();
    }
}
