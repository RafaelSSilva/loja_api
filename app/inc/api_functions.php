<?php 
function api_request($endpoint, $method = 'GET', $variables = []) {
    $client = curl_init(); //inicia sessão     
    $url    = API_BASE_URL; //define a URL
    
    switch($method) {
        case 'GET':
            $url .= "?endpoint=$endpoint";
        
            if (!empty($variables)) 
                $url .= "&".http_build_query($variables);          
            break;
        case 'POST':
            $list_params[CURLOPT_POSTFIELDS]  = array_merge(['endpoint' => $endpoint], $variables);
            break;

    }

    
    $list_params[CURLOPT_CUSTOMREQUEST]  = $method;
    $list_params[CURLOPT_URL]            = $url;
    $list_params[CURLOPT_RETURNTRANSFER] = TRUE;


    curl_setopt_array($client, $list_params);
    $response = curl_exec($client);

    return json_decode($response, TRUE);         
}