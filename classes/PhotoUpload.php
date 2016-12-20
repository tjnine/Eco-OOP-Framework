<?php 

class PhotoUoload 
{

public  $_db,    
        $_data,
        $images = [],
        $imagePath = ""
        $imageDir = dirname(__FILE__) . "../uploads";

    public function __construct()
    {
        $this->_db = DB::getInstance();
        $this->_sessionName = Config::get('session/session_name');
        $this->_cookieName = Config::get('remember/cookie_name');

    }

    public function upload($images = []) 
    {
        foreach($_FILES["images"]["error"] as $key => $error) {
            if($error == UPLOAD_ERR_OK) {
                $tmp_name = $_FILES["images"]["tmp_name"][$key];
                $name = basename($_FILES["images"]["name"][$key];
                move_uploaded_file($tmp_name, "../uploads");
                Redirect::to('admin/index.php');
            } else {
                print_r($error);
            }
        }
    }


    public function check_file($imageCollection = [])
    {

    }

}

?>