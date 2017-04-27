<?php

require 'vendor/autoload.php';

function queryGoogle($query, $noOfPages, $filePath) {
  $client = new GuzzleHttp\Client();
  $fp = fopen($filePath, "w");
  $query = urlencode($query);
  $baseUrl = "https://www.google.co.uk/search?q=%s&start=%d";

  for ($i = 0; $i < $noOfPages; $i++) {
    $url = sprintf($baseUrl, $query, $i * 10);
    $res = $client->request('GET', $url);
    fwrite($fp, $res->getBody());
  }

  fclose($fp);
}

queryGoogle('fox reymann', 3, "fox.html");
queryGoogle('test&*(string', 5, "test_string.html");
