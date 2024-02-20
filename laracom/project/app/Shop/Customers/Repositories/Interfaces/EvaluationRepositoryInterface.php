<?php

namespace App\Repositories\Interfaces;

interface EvaluationRepositoryInterface
{
    public function all();

    public function findEvaluationById(int $id);

    public function createEvaluation(array $data);

    public function updateEvaluation(int $id, array $data);

    public function deleteEvaluation(int $id);
}
