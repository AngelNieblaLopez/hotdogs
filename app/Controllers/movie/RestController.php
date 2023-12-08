<?php

namespace App\Controllers\movie;

use CodeIgniter\RESTful\ResourceController;
use App\Models\ConfigModel;
use App\Models\AuthModel;
use App\Models\UserModel;
use App\Models\ClientModel;
use App\Models\FunctionModel;
use App\Models\MovieModel;
use Exception;

class RestController extends ResourceController
{

    protected $session;
    protected $db;
    protected $configModel;
    protected $movieModel;
    protected $functionModel;


    public function __construct()
    {
        helper(['form', 'url', 'session']);
        $this->session = \Config\Services::session();
        $this->db = \Config\Database::connect();
        $this->configModel = new ConfigModel();
        $this->movieModel = new MovieModel();
        $this->functionModel = new FunctionModel();
    }


    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function detail($id)
    {

        $movie = $this->movieModel
            ->select("movie.name AS movie_name, movie.description AS movie_description, category.name AS category_name, movie_clasification.name AS movie_clasification_name, category.description AS category_description, movie.image_url AS movie_image_url")
            ->join("category", "category.id = movie.category_id")
            ->join("movie_clasification", "movie_clasification.id = movie.movie_clasification_id")
            ->where("movie.status = 1")->find($id);

        $respuesta = [
            'error' => null,
            'message' => ['success' => 'Recurso obtenido satisfactoriamente'],
            'data' => $movie
        ];

        return $this->respond($respuesta, 200);
    }



    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function withFunction()
    {
        $functions = $this->functionModel
    
            ->select("movie.id, movie.duration AS movie_duration, movie.name AS movie_name, movie.description AS movie_description, category.name AS category_name, movie_clasification.name AS movie_clasification_name, category.description AS category_description, movie.image_url AS movie_image_url")
            ->join("movie", "movie.id = function.movie_id")
            ->join("category", "category.id = movie.category_id")
            ->join("movie_clasification", "movie_clasification.id = movie.movie_clasification_id")
            ->where("function.status = 1 AND DATE_ADD(function.start_date, INTERVAL movie.duration MINUTE) > NOW()")
            ->groupBy("movie.id")
            ->findAll();


        $httpCode = 200;
        $respuesta = [
            'error' => null,
            'message' => ['success' => 'Recurso obtenido satisfactoriamente'],
            'data' => $functions
        ];


        return $this->respond($respuesta, $httpCode);
    }
}
