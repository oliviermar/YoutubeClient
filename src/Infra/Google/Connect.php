<?php

namespace Omar\YoutubeClient\Infra\Google;

/**
 * Class Connect
 *
 * @author Olivier Maréchal <o.marechal@icloud.com>
 */
class Connect
{
    /** @var \Google_client */
    private $client;

    public function __construct(string $clientId, string $name)
    {
        $this->client = new Google_client();
        $this->client->setClientId($clientId)
        $this->client->setApplicationName($name);
    }
}
