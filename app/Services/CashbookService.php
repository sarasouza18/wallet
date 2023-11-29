<?php

namespace App\Services;

use App\Repositories\Contracts\CashbookRepositoryContract;
use App\Services\Contracts\CashbookServiceContract;
use Illuminate\Database\Eloquent\Model;

class CashbookService implements CashbookServiceContract
{
    private CashbookRepositoryContract $cashbookRepository;

    public function __construct(CashbookRepositoryContract $cashbookRepository)
    {
        $this->cashbookRepository = $cashbookRepository;
    }

    public function store(array $data): Model
    {
        return $this->cashbookRepository->store($data);
    }
}
