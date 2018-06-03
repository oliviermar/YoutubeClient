<?php

namespace Omar\YoutubeClient\Google\ResourceOwner;

/**
 * Class OAuthResourceOwner
 *
 * @author Olivier Maréchal <o.marechal@icloud.com>
 */
class OAuthResourceOwner
{
    /** @var array */
    protected $paths = [
        'id' => 'sub',
        'email' => 'email',
        'firstname' => 'given_name',
        'lastname' => 'family_name',
    ];

    /** @var array */
    protected $googleDataResponse;

    /**
     * OAuthResourceOwner Constructor
     *
     * @param array $googleDataResponse
     */
    public function __construct(array $googleDataResponse)
    {
        $this->googleDataResponse = $googleDataResponse;
    }

    /**
     * @param string $name
     *
     * @throws \Exception // TODO Create custom exception
     * @return mixed
     */
    public function get($name)
    {
        if (!array_key_exists($name, $this->paths)) {
            throw new \Exception(
                sprintf(
                    'key "%s" was not found in the mapped paths. You should check in your google connet configuration if you have correctly defined a mapped paths',
                    $name
                )
            );
        }

        if (!array_key_exists($this->paths[$name], $this->googleDataResponse)) {
            throw new \Exception(
                sprintf(
                    'key "%s" was not found in the google connect response',
                    $this->paths[$name]
                )
            );
        }

        return $this->googleDataResponse[$this->paths[$name]];
    }

    /**
     * This method is a helper for debug loggin with google, not realy use
     *
     * @return array
     */
    public function getConnectDataResponse(): array
    {
        return $this->googleDataResponse;
    }

    /**
     * @param array $paths
     *
     * @return OAuthResourceOwner
     */
    public function setPaths(array $paths): OauthResourceOwner
    {
        $this->paths = $paths;

        return $this;
    }
}
