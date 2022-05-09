<?php

namespace App\Repositories\ProductRepository;

interface IEloquentProductRepository
{
    public function listActive();

    public function showActive($id);
}
