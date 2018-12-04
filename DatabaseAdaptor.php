<?php

class DatabaseAdaptor {
    private $DB; // The instance variable used in every method
    // Connect to an existing data based named 'first'
    public function __construct() {
        $dataBase = 'mysql:dbname=movieReviews;charset=utf8;host=127.0.0.1';
        $user = 'root';
        $password ='';
        try {
            $this->DB = new PDO ( $dataBase, $user, $password );
            $this->DB->setAttribute ( PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION );
        } catch ( PDOException $e ) {
            echo ('Error establishing Connection');
            exit ();
        }
    }
    
    public function checkForUsername($username){
        $stmt = $this->DB->prepare( "SELECT username FROM userdata where username = '" . $username . "'");
        $stmt->execute ();
        return $stmt->fetchAll( PDO::FETCH_ASSOC );
    }
    public function insertNewUser($username , $password){
        $stmt = $this->DB->prepare("insert into userdata (username, password) values ('" . $username . "' , '" . $password . "')");
        $stmt->execute();
    }
    
    public function checkUserCredentials($username, $password){
        $stmt = $this->DB->prepare("select password from userdata where username = ('" . $username ."')");
        $stmt->execute();
        $arr = $stmt->fetchAll( PDO::FETCH_ASSOC );
        return $arr[0]["password"] == $password;
    }
    
    public function getMyReviews($username){
        $stmt = $this->DB->prepare("SELECT movieData.movieTitle, reviewData.reviewText
                                    FROM movieData
                                    JOIN reviewData ON movieData.movieID = reviewData.movieID AND reviewData.username = '".$_SESSION["user"]."';");
        $stmt->execute();
        $arr = $stmt->fetchAll( PDO::FETCH_ASSOC );
        return json_encode($arr);
    }
    
    public function getMovieList(){
        $titles = $this->DB->prepare("SELECT movieTitle FROM moviedata");
        $titles->execute();
        $arr = $titles->fetchAll( PDO::FETCH_ASSOC );
        echo json_encode($arr);
    }
    
    public function insertNewMovie($movieTitle){
        $check = $this->DB->prepare("select movieTitle from moviedata where movietitle = ('" . $movieTitle . "')");
        $check->execute();
        $arr = $check->fetchAll( PDO:: FETCH_ASSOC );
        if(count($arr) > 0){
            $stmt = $this->DB->prepare("insert into moviedata (movieTitle) values ('" . $movieTitle . "')");
            $stmt->execute();
        }
    }
    
    public function createNewReview($movieID, $reviewText, $username, $date, $time){
        $stmt = $this->DB->prepare("insert into reviewdata (movieID, reviewText, username, date, time) values ('" . $movieID . "' , '" . $reviewText . "' , '" . $username . "' , '" . $date . "' , '" . $time . "')");
        $stmt->execute();
    }
    
    
    
}

