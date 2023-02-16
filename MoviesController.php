<?php
require_once "Crud.php";
require_once "DbConfig.php";


class MoviesController
{
    private $crud;

    public function __construct()
    {
        $this->crud=new Crud();
    }

    public function addMovie()
    {
        $movie_data = [
            'mv_title' => $_POST['mv_title'],
            'mv_year_released' => $_POST['mv_year_released'],
        ];
        $movie_id=$this->crud->create($movie_data,'movies');
        $movie_genres = isset($_POST['genres']) ? $_POST['genres'] : "";
        $this->createMovieGenres($movie_genres, $movie_id);
        $this->saveAndUploadCoverImage($movie_id);
       
    }

    public function createMovieGenres($movie_genres,$movie_id)
    {
        
        foreach($movie_genres as $key => $genre_id)
        {
            $movie_genres_arr = [
                'mvg_ref_genre' => $genre_id,
                'mvg_ref_movie' => $movie_id
            ];
            $this->crud->create($movie_genres_arr, 'mv_genres');
        }
    
    }

    public function getMovies()
    {
        //query statement
        $sql = "SELECT mv_id,mv_title, img_path,gnr_name,GROUP_CONCAT(gnr_name) genres,mv_year_released 
        FROM `movies` 
        LEFT JOIN mv_genres ON mvg_ref_movie = mv_id 
        LEFT JOIN genres ON mvg_ref_genre = gnr_id 
        LEFT jOIN images ON img_ref_movie = mv_id
        GROUP BY mv_id;";
        //call read method from crud to pass query statement
        $result = $this->crud->read($sql);
        return $result;
        //we need to get all columns from movies and genre
       
    }
    public function getMovie($mv_id)
    {
        //query statement
        $sql = "SELECT mv_id,mv_title, img_path,gnr_name,GROUP_CONCAT(gnr_name) genres,mv_year_released 
        FROM `movies` 
        LEFT JOIN mv_genres ON mvg_ref_movie = mv_id 
        LEFT JOIN genres ON mvg_ref_genre = gnr_id 
        LEFT jOIN images ON img_ref_movie = mv_id
        WHERE mv_id = $mv_id
        GROUP BY mv_id;";
        //call read method from crud to pass query statement
        $result = $this->crud->read($sql);
        return $result;
        //we need to get all columns from movies and genre
       
    }

    public function saveAndUploadCoverImage($movie_id)
    {
        $dir = "../images/movie_covers/movie_$movie_id"; 
        if (!file_exists($dir))
        {
            mkdir($dir, 0777, true);
        }

        $dir = $dir . "/" . basename($_FILES['cover_image']['name']);
        move_uploaded_file($_FILES['cover_image']['tmp_name'], $dir);
        $image_info = [
            'img_path' => str_replace('../','',$dir),
            'img_ref_movie' =>$movie_id
        ];
        $this->crud->create($image_info, 'images');

    }

}