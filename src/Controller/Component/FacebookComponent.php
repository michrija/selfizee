<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller\Component;
use Cake\Controller\Component;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

use \Facebook\Facebook;
/**
 * Description of FacebookComponent
 *
 * @author Brichard
 */
class FacebookComponent  extends Component {
    
    private $_fb;
    private $_tokenApp;
    
    public function __construct() {
        $this->_fb =  new Facebook([
                'app_id' => FB_API_ID,
                'app_secret' => FB_API_SECRET,
                'cookie' => true,
                'default_graph_version' => 'v2.12',
        ]);
    }
    
    public function setParameterApi($_api_id=FB_API_ID,$_api_secret=FB_API_SECRET,$_api_version='V2.7') {
         $this->_fb =  new Facebook([
                'app_id' => $_api_id,
                'app_secret' => $_api_secret,
                'cookie' => true,
                'default_graph_version' => $_api_version,
        ]);
        return $this;
    }
    public function getIsntanceFb() {
        return $this->_fb;
    }
    
    public function getAccessToken($_code,$_api_id=FB_API_ID,$_api_secret=FB_API_SECRET,$_uri_redirect=BASE_URL."facebook-pages/add"){
        
        //debug($_api_id);
        $args = array(
            'client_id' => $_api_id,
            'client_secret' => $_api_secret,
            "redirect_uri"=>$_uri_redirect,
            'code'=>$_code
        );
        ///die(BASE_URL."page-facebooks/add?");
        $ch = curl_init();
        $url = 'https://graph.facebook.com/oauth/access_token';
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
        
        $data = curl_exec($ch);
        //parse_str($data,$_array);
        return json_decode($data);
    }
    
    public function getMyAccount($_token_access,$_page_id) {
        try {
            $_res = $this->_fb->get('/me/accounts',$_token_access);  
            $_data = $_res->getDecodedBody();
            if (isset($_data['data'])) {
                foreach ($_data['data'] as $account) {
                  if ($_page_id == $account['id']) {
                      return $account;
                  }
                }
            }
        } catch (Exception $e){
            echo $e->getMessage();
        }
        die();
    }
    
    public function getMyAccountsComplete($_token_access) {
        try {
            $_res = $this->_fb->get('/me?fields=accounts,name',$_token_access);  
            $_data = $_res->getDecodedBody();
            if (isset($_data['accounts'])) {
                return $_data;
            }
        } catch (Exception $e){
            echo $e->getMessage();
        }
        return $_data;
        die();
    }
    
    public function getMyAccounts($_token_access) {
        try {
            $_res = $this->_fb->get('/me/accounts',$_token_access);  
            $_data = $_res->getDecodedBody();
            if (isset($_data['data'])) {
                return $_data['data'];
            }
        } catch (Exception $e){
            echo $e->getMessage();
        }
        die();
    }
    
     public function addAlbum($_token_access,$_page_id,$_name,$_description) {
        try {
            $_res = $this->_fb->post("/$_page_id/albums",["name"=>$_name,
                                    "message"=>$_description,
                                    "place"=>$_page_id],$_token_access);  
           // $_data = $_res->getDecodedBody();
           return $_res->getDecodedBody();
            
        } catch (Exception $e){
            echo $e->getMessage();
            die();
        }
        die();
    }
    
    public function shareInMyPage($_token_access,$_page_id,$_message,$_url,$_album_id=0,$_id_place=0) {
         try {
                $_attachment = array(
                        'message' => $_message,
                        'url' => $_url,
                        
                        );
                if($_id_place !=="NULL"){
                    $_attachment['place']=$_id_place;
                }
                $_place = $_album_id>0?$_album_id.'/photos':$_page_id.'/photos';
               //var_dump($_attachment,"/$_place");die();
                $_result = $this->_fb->sendRequest('post',"/$_place",  $_attachment,$_token_access);
                return $_result->getDecodedBody();
            }catch(\Facebook\Exceptions\FacebookResponseException $e) {
                echo '<pre>';
                    print_r($e->getMessage());
                echo '</pre>';
        }
    }



    public function postImage($_token_access,$_page_id,$_message,$_url,$_album_id=0) {
        try {
                $_attachment = array(
                        'url' => $_url,
                        'published'=>true
                );
                //var_dump($_attachment);
                $_place = $_album_id>0?$_album_id.'/photos':$_page_id.'/photos';
                //debug($_place);
                $_result = $this->_fb->sendRequest('post',"/$_place",  $_attachment,$_token_access);
                return $_result->getDecodedBody();
            }catch(\Facebook\Exceptions\FacebookResponseException $e) {
                echo 'LINE '.__LINE__;
                    print_r($e->getMessage());
                echo '</pre>';

        }
    }
      public function shareFeed($_token_access,$_page_id,$_attachment) {
         try {
                $_result = $this->_fb->post("/$_page_id/feed",  $_attachment,$_token_access);
                return $_result->getDecodedBody();
            }catch(\Facebook\Exceptions\FacebookResponseException $e) {
                echo 'LINE '.__LINE__;
                    print_r($e->getMessage());
                echo '</pre>';
        }
    }

    public function deleteMyPostFeed($_token_access,$_post_id) {
        try {
            $_result = $this->_fb->delete("/$_post_id",array(),$_token_access);
            return $_result->getDecodedBody();
        }catch(\Facebook\Exceptions\FacebookResponseException $e) {
            echo 'LINE '.__LINE__;
            print_r($e->getMessage());
            echo '</pre>';
        }
        die();
    }

    /*
     * @$_obj_id int {id_photo|id_album|id_page}
     */
    public function getLikes($_token_access=null,$_obj_id=0,$_next=false,$_previous=false,$_limit=1){
        if(is_null($_token_access)) $_token_access= $this->getTokenApp ();
         try {
              if($_next){
                     $_result = $this->_fb->get("/".$_obj_id."/likes?limit=$_limit&after=$_next",$_token_access);
                     $_result = $_result->getDecodedBody();
                }elseif($_previous){
                    $_result = $this->_fb->get("/$_url_comment/likes?limit=$_limit&before=$_previous",$_token_access);
                }else{
                        $_result = $this->_fb->get("/$_obj_id/likes?summary=true&limit=$_limit",$_token_access);
                        $_result = $_result->getDecodedBody();
                }                
//                $_result = $this->_fb->get("/$_obj_id/likes",$_token_access);
//                return $_result->getDecodedBody();
            return $_result;
            }catch(\Facebook\Exceptions\FacebookResponseException $e) {
                echo '<pre>';
                    print_r($e->getMessage());
                echo '</pre>';
        }
    }
    /*
     * @$_obj_id int {id_page}
     */
    public function getFanCount($_token_access=null,$_obj_id=0){
        if(is_null($_token_access)) $_token_access= $this->getTokenApp ();
         try {
                $_result = $this->_fb->get("/".$_obj_id."?fields=fan_count,name",$_token_access);
                $_result = $_result->getDecodedBody();
                return $_result;
            }catch(\Facebook\Exceptions\FacebookResponseException $e) {
                return NULL;
//                echo '<pre>';
//                    print_r($e->getMessage());
//                echo '</pre>';
        }
    }

    /*
     * @$_obj_id int {id_photo|id_album|id_page}
     */
    public function getShared($_token_access,$_obj_id=0) {
        $ch = curl_init();
        $url = 'https://graph.facebook.com/v2.7/'.$_obj_id."?access_token=$_token_access&fields=shares";
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //curl_setopt($ch, CURLOPT_POST, true);
        //curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
        $json = curl_exec($ch);
        $data = json_decode($json, true);
       // var_dump($url,$data);die();
        //parse_str($data,$_array);
        if(isset($data['shares']))
            return $data['shares']['count'];

        return 0;

    }
    public function getSharesCountFromPostForShowing( $current_post_id,$_token_access){
        
        $current_url  = 'https://graph.facebook.com/v2.7/' . $current_post_id;
        $current_url .= '?access_token=' . $_token_access;
        $current_url .= '&fields=shares';

        $json = file_get_contents( $current_url );
        $data = json_decode($json, true);
        
        var_dump($data);die();
        return $data['shares']['count'];
        //$full_shares = isset($full_shares)?$full_shares:'?';
        
        return $full_shares;
    }
    
    public function getAlbumListe($_token_access,$_obj_id=0,$_next=false,$_previous=false,$_limit=2) {
         try {
                if($_next){
                     $json = file_get_contents( $current_url );
                     $data = json_decode($json, true);
                     die(debug($data));
                }elseif($_previous){
                    $_result = $this->_fb->get("/$_obj_id/albums?limit=$_limit",$_token_access);
                }else{
                    $_result = $this->_fb->get("/$_obj_id/albums?fields=description,name&limit=$_limit",$_token_access);
                }
                return $_result->getDecodedBody();
            }catch(\Facebook\Exceptions\FacebookResponseException $e) {
                echo '<pre>';
                    print_r($e->getMessage());
                echo '</pre>';
        }
    }
    
    public function getCommentsByUrl($_url_comment,$_obj_id=0,$_next=false,$_previous=false,$_limit=1) {
        $_token_access = $this->getTokenApp();
        try {
                if($_next){
                     $_result = $this->_fb->get("/".$_obj_id."/comments?limit=$_limit&after=$_next",$_token_access);
                     $_result = $_result->getDecodedBody();
                    $_result['obj_id'] = $_obj_id;
                }elseif($_previous){
                    $_result = $this->_fb->get("/$_url_comment/comments?limit=$_limit",$_token_access);
                }else{
                    $_resultPictureComment = $this->_fb->get("/$_url_comment?fields=og_object{engagement,likes.summary(true).limit(0)}",$_token_access);
                    $_resultPictureComment = $_resultPictureComment->getDecodedBody();
                    if(isset($_resultPictureComment['og_object'])){
                        //debug($_resultPictureComment);die();
                        $_result = $this->_fb->get("/".$_resultPictureComment['og_object']['id']."/comments?limit=$_limit",$_token_access);
                        $_result = $_result->getDecodedBody();
                        $_result['obj_id'] = $_resultPictureComment['og_object']['id'];
                        $_result['other_data'] = $_resultPictureComment;
                    }else{
                        return [];
                    }
                }                
                
                
                return $_result;
            }catch(\Facebook\Exceptions\FacebookResponseException $e) {
                echo '<pre>';
                    print_r($e->getMessage());
                echo '</pre>';
        }
    }
    
      public function getCommentsByIdPost($_obj_id=0,$_next=false,$_previous=false,$_limit=1) {
        $_token_access = $this->getTokenApp();
        try {
                if($_next){
                     $_result = $this->_fb->get("/".$_obj_id."/comments?limit=$_limit&after=$_next",$_token_access);
                     $_result = $_result->getDecodedBody();
                }elseif($_previous){
                    $_result = $this->_fb->get("/$_url_comment/comments?limit=$_limit",$_token_access);
                }else{
                        $_result = $this->_fb->get("/$_obj_id/comments?limit=$_limit",$_token_access);
                        $_result = $_result->getDecodedBody();
                }                
                
                
                return $_result;
            }catch(\Facebook\Exceptions\FacebookResponseException $e) {
                echo '<pre>';
                    print_r($e->getMessage());
                echo '</pre>';
        }
    }
    
  /*  public function getShared($_url_comment,$_obj_id=0,$_next=false,$_previous=false,$_limit=1) {
        $_token_access = $this->getTokenApp();
        try {
                if($_next){
                     $_result = $this->_fb->get("/".$_obj_id."/comments?limit=$_limit&after=$_next",$_token_access);
                     $_result = $_result->getDecodedBody();
                    $_result['obj_id'] = $_obj_id;
                }elseif($_previous){
                    $_result = $this->_fb->get("/$_url_comment/comments?limit=$_limit",$_token_access);
                }else{
                    $_resultPictureComment = $this->_fb->get("/$_url_comment",$_token_access);
                    $_resultPictureComment = $_resultPictureComment->getDecodedBody();
                    if(isset($_resultPictureComment['og_object'])){
                        $_result = $this->_fb->get("/".$_resultPictureComment['og_object']['id']."/comments?limit=$_limit",$_token_access);
                        $_result = $_result->getDecodedBody();
                        $_result['obj_id'] = $_resultPictureComment['og_object']['id'];
                    }else{
                        return [];
                    }
                }                
                
                
                return $_result;
            }catch(\Facebook\Exceptions\FacebookResponseException $e) {
                echo '<pre>';
                    print_r($e->getMessage());
                echo '</pre>';
        }
    }*/
    
    public function getTokenApp() {
        $_directory = new Folder(WWW_ROOT.'certificat/');
        $_files = $_directory->find('token-app.fb');
        if(!empty($_files)){
            $_file = new File($_directory->pwd() . DS . $_files[0]);
            $_content =  trim($_file->read());
            $_file->close(); 
            return $_content;
        }
        $_result= file_get_contents("https://graph.facebook.com/oauth/access_token?client_id=".FB_API_ID."&client_secret=".FB_API_SECRET.
                "&grant_type=client_credentials&redirect_uri=".FB_API_URL_SITE."/facebook-pages/add");
        $_file = new File(WWW_ROOT.'certificat/token-app.fb', true, 0644);
        $_file->write(str_replace("access_token=", "", $_result));
        $_file->close(); 
        die();
        return str_replace("access_token=", "", $_result);
    }
    public function checkAcessToken($_token_access,$_obj_id=0) {
        try{
            $_result = $this->_fb->get("/".$_obj_id."?fields=name",$_token_access);
            $_result = $_result->getDecodedBody();
            return $_result;
        }catch(\Facebook\Exceptions\FacebookResponseException $e) {
                /*secho '<pre>';
                    print_r($e->getMessage());
                echo '</pre>';*/
                return false;
        }
    }

    /**
     * recuperation amis d'un utilisateur
     * @param null $_token_access
     * @param int $_obj_id
     * @return array|\Facebook\FacebookResponse|null
     */
    public function getFriends($_token_access,$_obj_id=0,$_next=false,$_previous=false,$_limit=100) {

        try {
             if($_next){
                $_result = $this->_fb->get("/".$_obj_id."/taggable_friends?fields=name,id&limit=$_limit&after=$_next",$_token_access);
                $_result = $_result->getDecodedBody();
            }elseif($_previous){
                $_result = $this->_fb->get("/$_obj_id/taggable_friends?fields=name,id&fields=name,id&limit=$_limit",$_token_access);
            }else{
                $_result = $this->_fb->get("/$_obj_id/taggable_friends?fields=name,id&limit=$_limit",$_token_access);
                $_result = $_result->getDecodedBody();
            }
            return $_result;
            return $_result;
        }catch(\Facebook\Exceptions\FacebookResponseException $e) {
           // echo '<pre>';
            //print_r($e->getMessage());
           // echo '</pre>';
            return ["data"=>[$e->getMessage()]];
        }
    }
    /**
     * recherche
     * @param null $_token_access
     * @param string $_q
     * @param int $_offset
     * @param boolean|string $_previous
     * @param string $$_type = {user,group,page,event}
     * @param int $_limit
     * @return array|\Facebook\FacebookResponse|null
     */
    public function search($_token_access,$_q="Brandeet",$_offset=0,$_previous=false,$_type='user',$_limit=100) {

        try {

            $_result = $this->_fb->get("/search?q=$_q&type=$_type&limit=$_limit&offset=$_offset",$_token_access);
            $_result = $_result->getDecodedBody();

            return $_result;
        }catch(\Facebook\Exceptions\FacebookResponseException $e) {
           // echo '<pre>';
            //print_r($e->getMessage());
           // echo '</pre>';
            return ["data"=>[$e->getMessage()]];
        }
    }
}
