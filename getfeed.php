<?php

  //https://github.com/J7mbo/twitter-api-php
  require_once("TwitterAPIExchange.php");
  require_once("config.php");
  $file_name = "cache.txt";
  $url = "https://api.twitter.com/1.1/search/tweets.json";
  $getField = "?q=%23Paris&result_type=recent";
  $requestMethod = "GET";

  $file_data = json_decode(file_get_contents($file_name));//faili sisu tagasi objektiks
  //võrdleme aega
  $delay = 10;//10sekundit
  //kas on möödunud vähem kui delayga määratud aeg
  if((strtotime(date("c")) - strtotime($file_data->date)) < $delay){
    //liiga vähe möödas
    echo json_encode($file_data);
    return;
  }

  $twitter = new TwitterAPIExchange($config);
  $dataFromAPI = $twitter->setGetfield($getField)
                         ->buildOauth($url, $requestMethod)
                         ->performRequest();

  //var_dump(json_decode($dataFromAPI)->statuses);
  $object = new stdClass();
  $object->date = date("c");
  $object->statuses = json_decode($dataFromAPI)->statuses;

  //lisan vanad mis jäänud teksti faili siia juurde
  foreach($file_data->statuses as $old_status){
    $exists = false;
    foreach($object->statuses as $new_status){
      //vaatame kas on olemas
      if($old_status->id == $new_status->id){$exists = true;}
    }
    if(!$exists){array_push($object->statuses, $old_status);}
  }
  //echo count($object->statuses);

  file_put_contents($file_name, json_encode($object));

  echo json_encode($object);

?>
