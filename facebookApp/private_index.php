<?php
session_start();
// created using this tutorial: http://www.devils-heaven.com/facebook-php-sdk-5-tutorial/
// and this: https://developers.facebook.com/docs/php/howto/example_facebook_login
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Include the required dependencies.
require_once(__DIR__.'/php-graph-sdk-5.0.0/src/Facebook/autoload.php');
require_once(__DIR__.'/appeniFacebookClass.php');


// Set the default parameters
$fb = new fbRequest([
  'app_id' => '1767155500278948',
  'app_secret' => 'bacdd79f839aad7d257f27fac8e49742',
  'default_graph_version' => 'v2.5',
]);

// Retrieves the access token for use with API calls
$accessToken = $_SESSION['fb_access_token'];

// echo "<pre>".print_r($_SERVER, true)."</pre>";

// creates a string of objects to pass into the get field
$fbObject = '/me?fields=id,name,email,likes';

// Get the profile
try {
       // Returns a `Facebook\FacebookResponse` object
       $fbResponse = $fb->response($fbObject, $accessToken);
}
catch(Facebook\Exceptions\FacebookResponseException $e) {
       echo 'Graph returned an error: ' . $e->getMessage();
       exit;
}
catch(Facebook\Exceptions\FacebookSDKException $e) {
       echo 'Facebook SDK returned an error: ' . $e->getMessage();
       exit;
}

//returns user data
$user = $fbResponse->getGraphUser();


echo '<h3>Profile Data</h3>';
echo 'Name: ' . $user['name'].'</br></br>';
echo 'Email: ' . $user['email'].'</br></br>';
echo 'User ID: ' . $user['id'].'</br></br>';

//returns a value indicating whether or not the user has liked $targetLike
?>

        <form method = "post" action = "results.php">
          <h2>Enter the Page ID below to see if the user likes it</h2>
            <input type = "text" name = "page_ID" placeholder="Page ID">
            <input type = "submit">
        </form>
<p>Facebook does not allow checking to see if a user has shared a page.</p>
        <?php
// echo "<pre>";
// print_r($user['likes']);
// echo "</pre>";
// sample page returns true: 1779888972228000



//returns a value indicating whether or not the user has shared $targetShare
// $targetShare = '';
//
// echo '<h2>Has the User shared the page'.$targetShare.'?<h2>';
//   echo '<h4>'.$doesLike.'</h4>';



?>
