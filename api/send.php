<?php
    require 'db.php';

    $getkey = $con->query("select * from setting")->fetch_assoc();

    define('ONE_KEY',$getkey['one_key']);
    define('ONE_HASH',$getkey['one_hash']);



    $content = array(
        "en" => 'Titulo de la Notificacion'
    );

    $fields = array(
        'app_id' => ONE_KEY,
        'included_segments' => array('Active Users'),
        'data' => array('type' =>1),
        'contents' => $content
    );

    $fields = json_encode($fields);
    //print("\nJSON sent:\n");
    //print($fields);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
        'Authorization: Basic '.ONE_HASH));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

    $response = curl_exec($ch);
    curl_close($ch);

    $timestamp = date("Y-m-d H:i:s");
    $title = 'Notificación';
    $url = 'no_url';
    $msg = "our Store New Product Inserted";
    $con->query("insert into noti(`msg`,`date`,`title`,`img`)values('".$msg."','".$timestamp."','".$title."','".$url."')");

    return $response;

?>

