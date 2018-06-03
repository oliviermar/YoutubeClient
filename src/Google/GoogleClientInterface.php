<?php

namespace Omar\YoutubeClient\Google;

use Omar\YoutubeClient\Google\ResourceOwner\OAuthResourceOwner;

/**
 * Interface GoogleClientInterface
 *
 * @author Olivier Maréchal <o.marechal@icloud.com>
 */
interface GoogleClientInterface
{
    /**
     * This method must return a Google client
     *
     * @return \Google_client
     */
    public function getClient(): \Google_client;

    /**
     * This method must return a uri for start Oauth2 process
     * In this case, the uri must redirect into google authentication form
     *
     * @param array $scope
     *
     * @return string
     */
    public function getAuthUrl(array $scope = []): string;

    /**
     * Send to google a code for authentication
     * With Google_client, use the method fetchAccessTokenWithAuthCode($code)
     * verify the access token with method verifyIdToken
     *
     * @param string $code
     *
     * @return OAuthResourceOwner
     */
    public function authorize(string $code): OAuthResourceOwner;
}
