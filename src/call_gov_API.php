<?php
require_once __DIR__ . '/../vendor/autoload.php';
use \ML\JsonLD\JsonLD;

function fetchAndSaveJsonLd() {
    $jsonLdUrl = 'https://api.dane.gov.pl/resources/54109,lista-imion-meskich-w-rejestrze-pesel-stan-na-19012023-imie-pierwsze/jsonld';

    $contextOptions = [
        'http' => [
            'method' => 'GET',
            'header' => "Accept: application/ld+json\r\n"
        ]
    ];
    $context = stream_context_create($contextOptions);

    $jsonLdData = @file_get_contents($jsonLdUrl, false, $context);
    if ($jsonLdData === false) {
        throw new Exception("Failed to fetch JSON-LD data from the API. Error: " . error_get_last()['message']);
    }

    // Save the raw JSON-LD data as a file
    $jsonFilePath = __DIR__ . '/raw.jsonld';
    if (@file_put_contents($jsonFilePath, $jsonLdData) === false) {
        throw new Exception("Failed to save raw JSON-LD data to {$jsonFilePath}. Error: " . error_get_last()['message']);
    }

    // Now process the JSON-LD data using the JsonLD library
    try {
        // Expand the JSON-LD document
        $expanded = JsonLD::expand($jsonFilePath);

        // Pretty-print the expanded JSON-LD data
        $prettyJson = JsonLD::toString($expanded, true);

        // Save the pretty-printed JSON-LD data
        $prettyJsonFilePath = __DIR__ . '/polishnames.json';
        if (@file_put_contents($prettyJsonFilePath, $prettyJson) === false) {
            throw new Exception("Failed to save pretty-printed JSON-LD data to {$prettyJsonFilePath}. Error: " . error_get_last()['message']);
        }

        echo "Extracted JSON-LD data successfully saved to {$prettyJsonFilePath}\n";
    } catch (\Exception $e) {
        throw new Exception("Error processing JSON-LD data: " . $e->getMessage());
    }
}

try {
    fetchAndSaveJsonLd();
} catch (Exception $e) {
    echo "An error occurred: " . $e->getMessage() . "\n";
}
