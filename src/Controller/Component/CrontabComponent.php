<?php 
namespace App\Controller\Component;

use Cake\Controller\Component;

class CrontabComponent extends Component {
    
    // In this class, array instead of string would be the standard input / output format.
    
    // Legacy way to add a job:
    // $output = shell_exec('(crontab -l; echo "'.$job.'") | crontab -');
    
    public  function stringToArray($jobs = '') {
        $array = explode("\r\n", trim($jobs)); // trim() gets rid of the last \r\n
        foreach ($array as $key => $item) {
            if ($item == '') {
                unset($array[$key]);
            }
        }
        return $array;
    }
    
    public  function arrayToString($jobs = array()) {
        $string = implode("\r\n", $jobs);
        return $string;
    }
    
    public function getJobs() {
        $output = shell_exec('crontab -l');
        return self::stringToArray($output);
    }
    
    public  function saveJobs($jobs = array()) {
        $jobs = array_unique($jobs);
        $output = shell_exec('echo "'.self::arrayToString($jobs).'" | crontab -');
        return $output;	
    }
    
    public  function doesJobExist($job = '') {
        $jobs = self::getJobs();
        if (in_array($job, $jobs)) {
            return true;
        } else {
            return false;
        }
    }
    
    public  function addJob($job = '') {
        if (self::doesJobExist($job)) {
            return false;
        } else {
            $jobs = self::getJobs();
            $jobs[] = $job;
            $jobs = array_unique($jobs);
            return self::saveJobs($jobs);
        }
    }
    
    public  function removeJob($job = '') {
        if (self::doesJobExist($job)) {
            $jobs = self::getJobs();
            unset($jobs[array_search($job, $jobs)]);
            return self::saveJobs($jobs);
        } else {
            return false;
        }
    }
    
}