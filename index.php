<html>
<head>
</head>

<body>
  <form action="index.php" method="post">
      <input type="text" name="country" placeholder="Country"/>
      <input type="text" name="city" placeholder="City"/>
      <input type="text" name="street" placeholder="Street"/>
      <input type="number" name="zip" placeholder="Zip"/>
      <button type="submit" name="submit">Get Latitude / Longtitude</button>
  </form>

<?php
  if (isset($_POST['submit'])) {

      $country = str_replace(" ","",$_POST['country']);
      $city = str_replace(" ","",$_POST['city']);
      $street = str_replace(" ","",$_POST['street']);

      $serching = $city."+".$street."+".$_POST['zip'];
      $url = "http://maps.google.com/maps/api/geocode/json?address=$serching&sensor=false&region=$country";

      $ch = curl_init();
  		curl_setopt($ch, CURLOPT_URL, $url);
  		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  		curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
  		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  		$response = curl_exec($ch);
  		curl_close($ch);
  		$response_a = json_decode($response);
  		echo $lat = $response_a->results[0]->geometry->location->lat;
  		echo "<br />";
  		echo $long = $response_a->results[0]->geometry->location->lng;

  	}
?>

</body>


</html>
