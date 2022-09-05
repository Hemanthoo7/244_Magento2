<?php

session_start();
/*
 *  base url of the magento host
 */
$host = 'https://244magento.com/';

//unset($_SESSION['access_token']);
if (!isset($_SESSION['access_token'])) {
    echo 'Authenticating...<br>';
    /*
    * authentication details of the customer
    */
    $username = 'mysql';
    $password = 'i95dev';
    $postData['username'] = $username;
    $postData['password'] = $password;

    /*
     * init curl
     */
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $host.'rest/V1/integration/customer/token');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    /*
     * set content type and length
     */
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: '.strlen(json_encode($postData)),
        )
    );
    /*
     * setpost data
     */
    curl_setopt($ch, CURLOPT_POST, count($postData));
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
    $output = curl_exec($ch);
    curl_close($ch);
    /*
     * access token in json format
     */
    echo $output;
    $_SESSION['access_token'] = $output;
}
if (isset($_SESSION['access_token'])) {
    /*
    * create headers for authorization
    */
    $headers = array(
        'Authorization: Bearer '.json_decode($_SESSION['access_token']),
    );
    echo '<pre>';
    echo 'api call... with key: '.$_SESSION['access_token'].'<br><br><br>';
    $ch = curl_init();
    /*
    * set api resource url
    */
    curl_setopt($ch, CURLOPT_URL, $host.'rest/V1/TestApi/custom/me');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers
    );
    $output = curl_exec($ch);
    curl_close($ch);
    echo '<br>';
    $test = json_decode(rtrim($output, '[]'));
    echo '
        =========================RESPONSE================================<br>
        ';

    print_r($test);
}
exit(0);
