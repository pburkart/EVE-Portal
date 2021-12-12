<?php
  require "core/settings.php";
  require "core/Request.php";

  session_start();

  $conn = new mysqli($host, $username, $password, $database);

  if($conn->connect_error){
    die("Connection Failed: " . $conn->connect_error);
  } else {
    if(isset($_GET['code'])){
      $code = $_GET['code'];

      $url = "https://login.eveonline.com/v2/oauth/token";
      $header = "Authorization: Basic " . base64_encode($CLIENT_ID . ":" . $SECRET_KEY);
      $fields_string = "";
      $fields = array(
        'grant_type' => 'authorization_code',
        'code' => $code
      );

      foreach($fields as $key => $value){
        $fields_string .= $key . "=" . $value . "&";
      }
      rtrim($fields_string, "&");

      $resp = Request::POST($header, $url, $fields, $fields_string);

      $accessToken = $resp->access_token;
      $refreshToken = $resp->refresh_token;

      $url = "https://login.eveonline.com/oauth/verify";
      $header = "Authorization: Bearer " . $accessToken;

      $resp = Request::GET($header, $url);

      $characterID = $resp->CharacterID;
      $characterName = $resp->CharacterName;
      $expiresOn = $resp->ExpiresOn;

      $sql = "SELECT CharacterID FROM users WHERE CharacterID=$characterID;";
      $result = $conn->query($sql);

      if($result->num_rows > 0){
        $_SESSION['id'] = $characterID;
        $_SESSION['name'] = $characterName;
        $_SESSION['access_token'] = $accessToken;
      } else {
        $sql = "INSERT INTO users (CharacterID, CharacterName, ExpiresOn)
        VALUES ('$characterID', '$characterName', '$expiresOn')";
        if($conn->query($sql) === TRUE){
          $_SESSION['id'] = $characterID;
          $_SESSION['name'] = $characterName;
          $_SESSION['access_token'] = $accessToken;
        }
      }
      header("Location: index.php");
      die();
    } else {
      header("Location: login.php");
      die();
    }
  }
?>
