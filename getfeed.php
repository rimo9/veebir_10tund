<?php

  //https://github.com/J7mbo/twitter-api-php
  require_once("TwitterAPIExchange.php");
  require_once("config.php");
  $url = "https://api.twitter.com/1.1/search/tweets.json";
  $getField = "?q=%23Paris&result_type=recent";
  $requestMethod = "GET";

  $twitter = new TwitterAPIExchange($config);
  $dataFromAPI = $twitter->setGetfield($getField)
                         ->buildOauth($url, $requestMethod)
                         ->performRequest();

  echo $dataFromAPI;

?>
