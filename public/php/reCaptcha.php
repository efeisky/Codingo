<?php
function reCaptcha($response) {

    $fields = [
        'secret' => "6LdliGMjAAAAAMI5FF-Lx66JnG9U6SOPQxL5bB0S",
        'response' => $response
    ];
    $ch = curl_init("https://www.google.com/recaptcha/api/siteverify");
    curl_setopt($ch,CURLOPT_POST,true);
    curl_setopt_array($ch, [
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => http_build_query($fields),
        CURLOPT_RETURNTRANSFER => true
    ]);
    $result = curl_exec($ch);
    curl_close($ch);
    return json_decode($result, true);
}

if(!isset($_POST["g-recaptcha-response"]) || empty($_POST["g-recaptcha-response"])){

}else {
    $result = reCaptcha($_POST["g-recaptcha-response"]);
    if($result['success'] == true){
        $result = true;
    }else{
        $result = false;
    }
}
?>
