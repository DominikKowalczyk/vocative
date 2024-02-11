<?php
require_once __DIR__ . '/../vendor/autoload.php';
use \ML\JsonLD\JsonLD;
use JsonStreamingParser\Listener\InMemoryListener;
use JsonStreamingParser\Parser;

class MyListener extends InMemoryListener {
    protected $tempFileName;

    public function __construct($tempFileName) {
        $this->tempFileName = $tempFileName;
    }

    public function processData($data) {
        // Convert the data to JSON and append it to the temporary file
        $jsonData = json_encode($data, JSON_UNESCAPED_SLASHES);
        file_put_contents($this->tempFileName, $jsonData, FILE_APPEND);
    }

    public function finalize() {
        // Perform final actions, such as closing the file or processing the collected data
    }
}

function fetchAndSaveJsonLd() {
    $jsonLdUrl = 'https://api.dane.gov.pl/resources/54109,lista-imion-meskich-w-rejestrze-pesel-stan-na-19012023-imie-pierwsze/jsonld';
    $tempFilePath = __DIR__ . '/temp.jsonld';

    $contextOptions = [
        'http' => [
            'method' => 'GET',
            'header' => "Accept: application/ld+json\r\n"
        ]
    ];
    $context = stream_context_create($contextOptions);

    $stream = fopen($jsonLdUrl, 'r', false, $context);
    if (!$stream) {
        throw new Exception("Failed to open stream to JSON-LD data.");
    }

    // Delete the temp file if it exists
    if (file_exists($tempFilePath)) {
        unlink($tempFilePath);
    }

    $listener = new MyListener($tempFilePath);
    try {
        $parser = new Parser($stream, $listener);
        $parser->parse();
        fclose($stream);
        
        // Finalize the listener processing
        $listener->finalize();

        // Now process the temp file with the JsonLD library
        // Expand the JSON-LD document
        $expanded = JsonLD::expand($tempFilePath);

        // Pretty-print the expanded JSON-LD data
        $prettyJson = JsonLD::toString($expanded, true);

        // Save the pretty-printed JSON-LD data
        $prettyJsonFilePath = __DIR__ . '/polishnames.json';
        if (@file_put_contents($prettyJsonFilePath, $prettyJson) === false) {
            throw new Exception("Failed to save pretty-printed JSON-LD data to {$prettyJsonFilePath}. Error: " . error_get_last()['message']);
        }

        echo "Extracted JSON-LD data successfully saved to {$prettyJsonFilePath}\n";
    } catch (Exception $e) {
        fclose($stream);
        throw $e;
    } finally {
        // Ensure the temporary file is deleted after processing
        if (file_exists($tempFilePath)) {
            unlink($tempFilePath);
        }
    }
}

try {
    fetchAndSaveJsonLd();
} catch (Exception $e) {
    echo "An error occurred: " . $e->getMessage() . "\n";
}