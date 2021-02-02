<?php


ini_set("log_errors", 1);
ini_set("error_log", "./error.log");

include 'onesignal_config.php';


class OneSignal{
	private $app_id;
	private $auth_key;
	public function __construct($app_id, $auth_key){
		$this->app_id = $app_id;
		$this->auth_key = $auth_key;
	}
    public function singleMessage($title, $content, $url, $userid, $lang = 'en'){



        $content = array(
            "en" => $content
        );

        $fields = array(
            'app_id' => $this->app_id,
            'include_player_ids' => array($userid),
            'data' => array("foo" => "bar", "cat_id"=> "1010101010"),
            'headings'=> array("en" => $title),
            'contents' => $content
        );

        $fields = json_encode($fields);
        print("\nJSON sent:\n");


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
            'Authorization: Basic '.$this->auth_key));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);
        return $response;

    }

    public function sendMessage($title, $content, $url, $lang = 'en'){



        $content = array(
            "en" => $content
        );

        $fields = array(
            'app_id' => $this->app_id,
            'included_segments' => array('Active Users'),
            'data' => array("foo" => "bar", "cat_id"=> "1010101010"),
            'headings'=> array("en" => $title),
            'contents' => $content
        );

        $fields = json_encode($fields);


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
            'Authorization: Basic '.$this->auth_key));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);
        return $response;





	}	

}

if(isset($_POST['send'])) {
	
		$on = new OneSignal($app_id, $auth_key);
		$title 	 = $_POST['title'];
		$content = $_POST['content'];
		$url = $_POST['url'];



		$res = $on->sendMessage($title, $content, $url , $lang = 'en');
		$book = json_decode($res, true);
		if ($book['recipients']>0){
            require 'db.php';
            $timestamp = date("Y-m-d H:i:s");
            $con->query("insert into noti(`msg`,`date`,`title`,`img`)values('".$content."','".$timestamp."','".$title."','".$url."')");
        }


    echo $book['recipients'];
		
}
if(isset($_POST['single'])) {

    $on = new OneSignal($app_id, $auth_key);

    $title = $_POST['title'];
    $content = $_POST['content'];
    $url = $_POST['url'];
    $userid = $_POST['devicesid'];
    $res = $on->singleMessage($title, $content, $url, $userid, $lang = 'en');

    $book = json_decode($res, true);
    echo $book['recipients'];

}