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
            $query = "INSERT INTO Orders (userId, dateOrdered, movieId) VALUES (:userId, :dateOrdered, :movieId)";

            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(':movieId', $order->getMovieID());
            $stmt->bindValue(':dateOrdered', $order->getDateOrdered());
            $stmt->bindValue(':userId', $order->getUserID());
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e;
        }
    }
    function getAll()
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM Orders");
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Order');
            $movies = $stmt->fetchAll();

            return $movies;

        } catch (PDOException $e) {
            echo $e;
        }
    }
}