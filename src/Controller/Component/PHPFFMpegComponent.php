<?php
namespace App\Controller\Component;

require_once '../vendor/autoload.php';
use Cake\Controller\Component;;
use FFMpeg\FFMpeg;


class PHPFFMpegComponent extends Component{

    private  $ffmpeg ;
    private  $movie ;

	public function __construct() {
    	//$this->movie = new \GChar0n\FFMpegPHP\Movie($url);
    }


    public function getFFMpeg() {

        $this->ffmpeg = \FFMpeg\FFMpeg::create([            
            'ffmpeg.binaries' => '/usr/bin/ffmpeg',
            'ffprobe.binaries' => '/usr/bin/ffprobe'
        ]);
        return $this->ffmpeg;
    }

    public function setMovie($path) {

        $ffmpeg = \FFMpeg\FFMpeg::create();
        $this->movie = $ffmpeg->open($path);
     	return $this->movie;
     }



     //getFrameCount

}