<?php

function getActorsBornOnSameDay($birthdate) {
    echo "birthdate";

    // IMDb API endpoint for fetching actors born on the same day
    $list_born_today_url = "https://online-movie-database.p.rapidapi.com/actors/list-born-today" . urlencode($birthdate);

    // Set up cURL to make the HTTP request
    $curl = curl_init();

    // Set the cURL options
    curl_setopt_array($curl, array(
        CURLOPT_URL => $list_born_today_url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTPHEADER => array(
            'X-RapidAPI-Host: online-movie-database.p.rapidapi.com',
            'X-RapidAPI-Key: 4a282da450mshb4996e19c8edd67p1e3360jsn8b782ea05fc6'
        )
    ));

    // Execute the cURL request
    $response = curl_exec($curl);

    echo $response;

    // Check for errors
    if ($response === false) {
        // Handle cURL error
        $error_message = curl_error($curl);
        // You can log or display the error message
        return "Error: " . $error_message;
    }

    

    // Close cURL
    curl_close($curl);

    // Decode the JSON response
    $data = json_decode($response, true);

    // Check if data is valid
    if (!$data || !isset($data['d'])) {
        return "No actors found.";
    }

    // Extract the actors from the data
    $actor_ids = $data['d'];

    // IMDb API endpoint for fetching actor details by ID
    $get_bio_url = 'https://online-movie-database.p.rapidapi.com/actors/get-bio';

    $actor_names = array();

    // Loop through each actor ID
    foreach ($actor_ids as $actor_id) {
        // Set up cURL to make the HTTP request
        $curl = curl_init();

        // Set the cURL options
        curl_setopt_array($curl, array(
            CURLOPT_URL => $get_bio_url . '?actor=' . $actor_id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTPHEADER => array(
                'X-RapidAPI-Key: 4a282da450mshb4996e19c8edd67p1e3360jsn8b782ea05fc6',
                'X-RapidAPI-Host: online-movie-database.p.rapidapi.com'
            )
        ));

        // Execute the cURL request
        $response = curl_exec($curl);

        //decode theh JSON response
        $actor_data = json_decode($response, true);

        //check if data is valid
        if (!$actor_data && !isset($actor_data['name'])) {
            $actor_names[] = $actor_data['name'];
        }

        // Close cURL
        curl_close($curl);
    }

    return $actor_names;


    }

?>
