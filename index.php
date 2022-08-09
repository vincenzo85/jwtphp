require_once __DIR__ . './vendor/autoload.php';

$headers = array(
    'alg' => 'HS256', //alg is required
    'typ' => 'JWT'
);
date_default_timezone_set("UTC");
$time = time() - 30;
$exp = $time + 3600 * 2;

$sdk_key = ''; // your sdk
$sdk_secret = ''; // your secret
// anything that json serializable
$payload = array(
    'sdkKey' => $sdk_key,
    'mn' => $_POST['meetingNumber'], // meeting number that you send via post request
    'role' => $_POST['role'], // 0 partecipante 1 gestore via post request 
    'iat' => $time,
    'exp' => $exp,
    'appKey' => $sdk_key,
    'tokenExp' => $exp,
);

$key = $sdk_secret;

$jws = new \Gamegos\JWS\JWS();

// ENCODE
$jwsString = $jws->encode($headers, $payload, $key);

// VERIFY
//printf("verify: \n");
//print_r($jws->verify($t, $key));


$t = array ( 'signature' => $jwsString ); 

echo json_encode($t);
