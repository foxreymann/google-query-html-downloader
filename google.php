<?php

require 'vendor/autoload.php';
/*
$res = $client->request('GET', 'https://www.google.co.uk/search?q=google&start=10');
echo $res->getStatusCode();
// "200"
echo $res->getHeader('content-type');
// 'application/json; charset=utf8'
echo $res->getBody();
*/

# file_put_contents("output.html", fopen("https://www.crunchbase.com/organization/tesla-motors#/entity", 'r'));

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
