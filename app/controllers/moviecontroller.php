<?php
namespace Controllers;

use Exception;
use Firebase\JWT\JWT;
use Services\MovieService;

class MovieController extends Controller
{
    private $movieservice;

    function __construct()
    {
        $this->movieservice = new MovieService();
    }
    public function getAll()
    {
        // $token = $this->checkForJwt();
        // if (!$token){
        //     return; 
        // }
        $offset = NULL;
        $limit = NULL;

        if (isset($_GET["offset"]) && is_numeric($_GET["offset"])) {
            $offset = $_GET["offset"];
        }
        if (isset($_GET["limit"]) && is_numeric($_GET["limit"])) {
            $limit = $_GET["limit"];
        }

        $movies = $this->movieservice->getAll($offset, $limit);
        $this->respond($movies);
    }

    public function getGenre(string $filter)
    {
        $model = $this->movieservice->filterMovies($filter);
        $this->respond($model);

    }
    public function getMovie($id)
    {
        $movie = $this->movieservice->getMovie($id);
        if (!$movie) {
            $this->respondWithError(404, "Product not found");
            return;
        }
        $this->respond($movie);
    }

    public function manageMovies()
    {
        $model = $this->movieservice->getAll();
        require __DIR__ . '/../views/admin/moviesmanagement.php';
    }
    public function deleteMovie($id)
    {
        try {
            $token = $this->checkForJwt();
            if (!$token) {
                return;
            }
            $movie = $this->movieservice->deleteMovie($id);
            if(!$movie){
                $this->respondWithError(404, "Movie not found");
                return;
            }
            $this->respondWithCode(200, "Movie deleted");
        } catch (Exception $e) {
            $this->respondWithError(500, $e->getMessage());
        }
    }

    public function editMovie()
    {
        $id = $_GET['id'];
        $model = $this->movieservice->getMovie($id);
        require __DIR__ . '/../views/admin/editmovie.php';
    }

    public function addMovieToCart()
    {
        $movieId = $_GET['id'];
        $movie = $this->movieservice->getMovie($movieId);

        $_SESSION['cartItems'] = $movie;

    }
    public function updateMovie()
    {
        try {
            $token = $this->checkForJwt();
            if (!$token) {
                return;
            }
            $movie = $this->createObjectFromPostedJson("Models\\Movie");
            $movie = $this->movieservice->updateMovie($movie);
        } catch (Exception $e) {
            $this->respondWithError(500, $e->getMessage());
        }


    }

    public function addMovie()
    {
        // A list of permitted file extensions
        if (isset($_POST['addMovieBtn'])) {
            $newImageName = $this->movePicture($_FILES['addImage']);
            $data = array(
                'title' => htmlspecialchars($_POST['addTitle']),
                'description' => (htmlspecialchars($_POST['addDescription'])),
                'dateProduced' => htmlspecialchars($_POST['addDateProduced']),
                'director' => htmlspecialchars($_POST['addDirector']),
                'genre' => htmlspecialchars($_POST['addGenre']),
                'rating' => htmlspecialchars($_POST['addRating']),
                'price' => htmlspecialchars($_POST['addPrice']),
                'image' => ($newImageName),
                'stock' => (100),
            );
            $this->movieservice->addMovie($data);
            echo "<script>location.href='/admin/managemovies'</script>";
            //exit;
        }

    }
    public function movePicture($imageName)
    {
        $fileName = $imageName['name'];
        $tempName = $imageName['tmp_name'];
        $ext = pathinfo($fileName, PATHINFO_EXTENSION);
        $newImageName = uniqid() . '.' . $ext;

        if (isset($fileName)) {
            if (!empty($fileName)) {
                $location = "images/";
                if (move_uploaded_file($tempName, $location . $newImageName)) {
                    echo 'File Uploaded';
                }
            }
        }
        return $newImageName;
    }
}