<?php
namespace Services;

use Repositories\MovieRepository;

class MovieService {

    private $repository;
    function __construct()
    {
        $this->repository = new MovieRepository();
    }
    public function getAll($offset = NULL, $limit = NULL) {
        return $this->repository->getAll($offset, $limit);
    }
    public function filterMovies(string $filter){
        return $this->repository->filterMovies($filter);
    }
    public function getMovie($id) {
        return $this->repository->getMovie($id);
    }
    public function deleteMovie($id){
       return $this->repository->deleteMovie($id);
    }
    public function updateMovie( $id,$title, $description, $genre, $rating, $dateProduced, $price, $director, $image)
    {
        $this->repository->updateMovie($id,$title, $description, $genre, $rating, $dateProduced, $price, $director, $image);
    }
    public function addMovie($data){
        $this->repository->addMovie($data);
    }
    public function updateStock($id){
        $this->repository->updateStock($id);
    }
}