<?php

namespace Omar\YoutubeClient\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Bundle\FrameworkBundle\DependencyInjection\Configuration;
use Omar\YoutubeClient\Google\Client as GoogleClient;

/**
 * Class YoutubeClientExtension
 *
 * @author Olivier Maréchal <o.marechal@icloud.com>
 */
class YoutubeClientExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $googleClientDefinition = new Definition(
            GoogleClient::class,
            [
                new Reference('router'),
                $config['google']['client_id'],
                $config['google']['name'],
                $config['google']['redirect_uri'],
                $config['google']['scope'],
            ]
        );

        $googleClientDefinition->setPublic(true);
        $container->setDefinition(GoogleClient::class, $googleClientDefinition);
    }
}
