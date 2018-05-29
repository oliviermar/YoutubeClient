<?php

namespace Omar\YoutubeClient\Google\Exception;

/**
 * Class InvalidRedirectPathException
 *
 * @author Olivier Maréchal <o.marechal@icloud.com>
 */
class InvalidRedirectPathException extends \Exception
{
    protected $message = 'La route de redirection n\'a pas été trouver. Veuillez définir une url valide ou le nom d\'une route de votre application';
}
