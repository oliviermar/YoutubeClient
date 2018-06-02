<?php

namespace Omar\YoutubeClient\Youtube;

use Omar\YoutubeClient\Google\GoogleClientnterface;

/**
 * Class Client
 *
 * @author Olivier Maréchal <o.marechal@icloud.com>
 */
class Client
{
    /** @var GoogleClientInterface */
    private $googeClient;

    /** @var \Google_Service_YouTube_ */
    private $client;

    /**
     * Client constructor
     *
     * @param GoogleClientInterface $googleCLient
     */
    public function __construct(GoogleClientInterface $googleClient)
    {
        $this->googleClient = $googleClient->getClient();
        $this->client = new \Google_Service_Client($googleClient);
    }
}
