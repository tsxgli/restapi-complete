<?php
namespace Repositories;
use Models\Movie;
use PDO;
use PDOException;
use Repositories\Repository;


class MovieRepository extends Repository
{

    function getAll($offset = null, $limit = null)
    {
        try {
            $query = "SELECT * FROM Movie";
            if (isset($limit) && isset($offset)) {
                $query .= " LIMIT :limit OFFSET :offset ";
            }
            $stmt = $this->connection->prepare($query);
            if (isset($limit) && isset($offset)) {
                $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
                $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            }
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $movies = $stmt->fetchAll();

            return $movies;
        } catch (PDOException $e) {
            echo $e;
        }
    }
    function filterMovies($filter)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM Movie where genre = :filter");
            $stmt->bindValue(':filter', $filter);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $movies = $stmt->fetchAll();

            return $movies;

        } catch (PDOException $e) {
            echo $e;
        }
    }
    function getMovie($id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM Movie where _id = :id");
            $stmt->bindValue(':id', $id);
            $stmt->execute();


            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $movie = $stmt->fetchAll();

            return $movie;

        } catch (PDOException $e) {
            echo $e;
        }
    }

    function deleteMovie($id)
    {
        try {
            $stmt = $this->connection->prepare("Delete from Movie where _id=:id");
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function updateMovie($movie)
    {

        try {
            $stmt = $this->connection->prepare("UPDATE Movie SET title = :title, description = :description, 
                                    director = :director, dateProduced = :dateProduced, 
                                    genre = :genre, rating = :rating, price = :price WHERE _id = :id");
            $stmt->bindParam(':id', $movie->_id);
            $stmt->bindParam(':title', $movie->title);
            $stmt->bindParam(':description', $movie->description);
            $stmt->bindParam(':director', $movie->director);
            $stmt->bindParam(':dateProduced', $movie->dateProduced);
            $stmt->bindParam(':genre', $movie->genre);
            $stmt->bindParam(':rating', $movie->rating);
            $stmt->bindParam(':price', $movie->price);
            $stmt->execute();


        } catch (PDOException $e) {
            echo "Something went wrong updating the movies: " . $e;
        }
    }

    function addMovie($data)
    {
        try {
            $stmt = $this->connection->prepare('INSERT INTO Movie (title, director,description, genre, dateProduced, price,image, stock,rating) 
                                                    VALUES ( :title, :director,:description, :genre, :dateProduced, :price,:image, :stock,:rating);');

            $stmt->bindParam(':title', $data['title']);
            $stmt->bindParam(':director', $data['director']);
            $stmt->bindParam(':description', $data['description']);
            $stmt->bindParam(':genre', $data['genre']);
            $stmt->bindParam(':dateProduced', $data['dateProduced']);
            $stmt->bindParam(':price', $data['price']);
            $stmt->bindParam(':stock', $data['stock']);
            $stmt->bindParam(':rating', $data['rating']);
            $stmt->bindParam(':image', $data['image']);
            $stmt->execute();

        } catch (PDOException $e) {
            echo "Adding movie failed: " . $e->getMessage();
        }
    }

    function updateStock($id)
    {
        try {
            $stmt = $this->connection->prepare("UPDATE Movie SET stock = stock - 1  WHERE _id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Something went wrong updating the stock: " . $e;
        }
    }
}