<?php
namespace Services;

use Repositories\OrderRepository;

class OrderService {

    private $repository;
    function __construct()
    {
        $this->repository = new OrderRepository();
    }
    public function insertOrder($order){
        $this->repository->insertOrder($order);
    }
    public function getAll() {
        return $this->repository->getAll();
    }
}