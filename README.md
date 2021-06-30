# RChilli Api

A simple client to parse resumes with rchilli.com

## Requirements

- PHP 5.6+
- guzzlehttp/guzzle 6.0+

## Installing

Use Composer to install it:

```
composer require filippo-toso/rchilli
```

## Using It

```
use FilippoToso\RChilli\RchilliClient;

// Create the client
$client = new RchilliClient('<Your User Key>', '<Your Sub User Id>');

// Parse file
$parsed = $client->parseFile('your-cv.pdf');

print_r($parsed);

// Parse binary content
$content = file_get_contents('binary-data.pdf');
$parsed = $client->parseContent($content, 'origina-filename.pdf);

print_r($parsed);
```
