<?php

namespace Omar\YoutubeClient\Google;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

/**
 * Class Connect
 *
 * @author Olivier Maréchal <o.marechal@icloud.com>
 */
class Connect
{
    /** @var \Google_client */
    private $client;

    public function __construct(UrlGeneratorInterface $router, string $clientId, string $name, string $redirectPath)
    {
        $this->client = new Google_client();
        $this->client->setClientId($clientId);
        $this->client->setApplicationName($name);
        $this->client->setDeveloperKey($clientId);
        $this->client->setRedirectUri($this->resolvePath($redirectPath));
    }

    /**
     * @param string $path
     *
     * @throw \Exception TODO Change when specific exception was created
     * @return string
     */
    private function resolvePath(string $path)
    {
        if (filter_var($path, FILTER_VALIDATE_URL)) {
            return $path;
        }

        try {
            return $this->router->generate($path);
        } catch (RouteNotFoundException $e) {
            // TODO Create specific exception
        }
    }
}
