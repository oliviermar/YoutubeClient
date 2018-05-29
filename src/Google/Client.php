<?php

namespace Omar\YoutubeClient\Google;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Omar\YoutubeClient\Google\Exception\InvalidRedirectPathException;

/**
 * Class Client
 *
 * @author Olivier Maréchal <o.marechal@icloud.com>
 */
class Client implements GoogleClientInterface
{
    /** @var \Google_client */
    private $client;

    /** @var array */
    protected $scope = [
        'email',
        \Google_Service_Youtube::YOUTUBE_FORCE_SSL,
        \Google_Service_Youtube::YOUTUBE_UPLOAD,
    ];

    /**
     * Connect constructor
     *
     * @param UrlGeneratorInterface $router
     * @param string                $clientId
     * @param string                $name
     * @param string                $redirectPath
     * @param array                 $scope
     */
    public function __construct(UrlGeneratorInterface $router, string $clientId, string $name, string $redirectPath, array $scope = [])
    {
        $this->client = new Google_client();
        $this->client->setClientId($clientId);
        $this->client->setApplicationName($name);
        $this->client->setDeveloperKey($clientId);
        $this->client->setRedirectUri($this->resolvePath($redirectPath));
        $this->client->setAccessType('offline');
        $this->client->setApprovalPrompt('force');
        $this->client->setState(uniqid());

        $this->scope = $scope;
    }

    /**
     * @return \Google_client
     */
    public function getClient(): \Google_client
    {
        return $this->client;
    }

    /**
     * @param array $scope
     *
     * @return string
     */
    protected function getAuthUrl(array $scope = []): string
    {
        return $this->client->createAuthUrl($this->getScope($scope));
    }

    /**
     * @param $code
     *
     * @throws \Exception
     * @return array
     */
    public function authorize(string $code): array
    {
        $authentication = $this->client->fetchAccessTokenWithAuthCode($code);
        if (array_key_exists('id_token', $authentication)) {
            $result = $this->client->verifyIdToken($authentication['id_token']);

            if ($result) {
                $this->client->setAccessToken($authentication);
            }

            return $result; // TODO Create object model GoogleAuthResponse
        }

        throw new \Exception('error'); // TODO get error for good redirection
    }

    /**
     * @param array $scope
     *
     * @return string
     */
    protected functon getScope(array $scope = []): string
    {
        if (count($scope) > 0) {
            return implode(' ', $scope);
        }

        return implode(' ', $this->scope);
    }

    /**
     * @param string $path
     *
     * @throw InvalidRedirectPathException
     *
     * @return string
     */
    private function resolvePath(string $path): string
    {
        if (filter_var($path, FILTER_VALIDATE_URL)) {
            return $path;
        }

        try {
            return $this->router->generate($path);
        } catch (RouteNotFoundException $e) {
            throw new InvalidRedirectPathException();
        }
    }
}
