<?php

namespace Omar\YoutubeClient\Youtube;

use Omar\YoutubeClient\Google\GoogleClientInterface;

/**
 * Class Client
 *
 * @author Olivier Maréchal <o.marechal@icloud.com>
 */
class Client
{
    /** @var \Google_client */
    private $googleClient;

    /** @var \Google_Service_Youtube */
    private $client;

    /**
     * Client constructor
     *
     * @param GoogleClientInterface $googleClient
     */
    public function __construct(GoogleClientInterface $googleClient)
    {
        $this->googleClient = $googleClient->getClient();
        $this->client = new \Google_Service_Youtube($this->googleClient);
    }
}
