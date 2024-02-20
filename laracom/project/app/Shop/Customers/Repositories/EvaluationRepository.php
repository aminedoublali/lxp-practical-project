<?php

namespace App\Repositories;

use App\Repositories\Interfaces\EvaluationRepositoryInterface;
use App\Shop\Products\Evaluation;

class EvaluationRepository implements EvaluationRepositoryInterface
{
    public function all()
    {
        return Evaluation::all();
    }

    public function findEvaluationById(int $id)
    {
        return Evaluation::find($id);
    }

    public function createEvaluation(array $data)
    {
        return Evaluation::create($data);
    }

    public function updateEvaluation(int $id, array $data)
    {
        $evaluation = $this->findEvaluationById($id);
        $evaluation->update($data);
        return $evaluation;
    }

    public function deleteEvaluation(int $id)
    {
        $evaluation = $this->findEvaluationById($id);
        $evaluation->delete();
        return $evaluation;
    }
}
