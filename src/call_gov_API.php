<?php
use GuzzleHttp\Client;

// Create a new Guzzle client
$client = new Client([
    // Base URI is used with relative requests
    'base_uri' => 'https://api.dane.gov.pl/1.4/'
]);

// Define the endpoint you want to access
$endpoint = 'resources/54109/data'; // Example endpoint for tabular data

try {
    // Send a GET request to the API
    $response = $client->request('GET', $endpoint);

    // Get the status code of the response
    $statusCode = $response->getStatusCode();

    // Get the body of the response
    $body = $response->getBody()->getContents();

    // Decode the JSON response
    $data = json_decode($body, true);

    // Now you can process the data as needed
    // ...

} catch (\GuzzleHttp\Exception\RequestException $e) {
    // Handle exceptions if any
    echo "Error: " . $e->getMessage();
}
?>
