<?php

namespace Repositories;

use PDO;
use PDOException;
use Repositories\Repository;


class OrderRepository extends Repository
{
    function insertOrder($order)
    {
        try {
            $query = "INSERT INTO Orders (userID, dateOrdered, movieID) VALUES (:userId, :dateOrdered, :movieId)";

            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(':movieId', $order->movieID);
            $stmt->bindValue(':dateOrdered', $order->dateOrdered);
            $stmt->bindValue(':userId', $order->userID);
            $stmt->execute();

            $newOrderId= $this->connection->lastInsertId(); 
            return $this->getOne($newOrderId);
        } catch (PDOException $e) {
            echo $e;
        }
    }
    function getAll()
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM Orders");
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Models\Order');
            $movies = $stmt->fetchAll();

            return $movies;

        } catch (PDOException $e) {
            echo $e;
        }
    }
    public function getOne($id){
        try {
            $stmt = $this->connection->prepare("SELECT * FROM Orders where _id = :id");
            $stmt->bindValue(':id', $id);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Models\Order');
            $order = $stmt->fetchAll();

            return $order;

        } catch (PDOException $e) {
            echo $e;
        }
    }
}