<?php

namespace FilippoToso\RChilli;

use GuzzleHttp\Client;

class RchilliClient
{
    protected const VERSION = '8.0.0';
    protected const URL = 'https://rest.rchilli.com/RChilliParser/Rchilli/parseResumeBinary';

    protected $userKey;
    protected $subUserId;

    /**
     * Create an instance of RchilliClient
     * @param mixed $userKey    Your user keyu
     * @param mixed $subUserId  Your sub user id
     * @return void 
     */
    public function __construct($userKey, $subUserId)
    {
        $this->userKey = $userKey;
        $this->subUserId = $subUserId;
    }

    /**
     * Parse a file
     *
     * @param string $path    Path of the file
     * @param string|null $filename   Optional alternative filename
     * @return void
     */
    public function parseFile($path, $filename = null)
    {
        $content = file_get_contents($path);
        $filename = $filename ?? basename($path);
        return $this->parseContent($content, $filename);
    }

    /**
     * Parsse content
     *
     * @param string $content   The binary content of the CV
     * @param string $filename  The name of the original file
     * @return void
     */
    public function parseContent($content, $filename)
    {
        $payload = [
            'filedata' => base64_encode($content),
            'filename' => $filename,
            'userkey' => $this->userKey,
            'version' => static::VERSION,
            'subuserid' => $this->subUserId,
        ];

        $client = new Client();

        $response = $client->request('POST', static::URL, [
            'json' => $payload,
        ]);

        return json_decode($response->getBody(), true);
    }
}
