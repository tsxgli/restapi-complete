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

    function updateMovie($id, $title, $description, $genre, $rating, $dateProduced, $price, $director, $image)
    {

        try {
            $stmt = $this->connection->prepare("UPDATE Movie SET title = :title, description = :description, 
                                    director = :director, dateProduced = :dateProduced, 
                                    genre = :genre, image=:image,rating = :rating, price = :price WHERE _id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':director', $director);
            $stmt->bindParam(':dateProduced', $dateProduced);
            $stmt->bindParam(':genre', $genre);
            $stmt->bindParam(':rating', $rating);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':image', $image);
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