<?php
namespace App\Controller\Component;

require_once '../vendor/autoload.php';
use Cake\Controller\Component;
use Char0n\FFMpegPHP\Movie;
use Char0n\FFMpegPHP\Adapters\FFMpegMovie;


class FFMpegComponent extends Component{

    private  $movie ;

	public function __construct() {
    	//$this->movie = new \GChar0n\FFMpegPHP\Movie($url);
    }

    public function setMovie($path) 
     {
     	# code...
     	$this->movie = new FFMpegMovie($path); //new Movie($url);
     	return $this->movie;
     }


     //getFrameCount

}