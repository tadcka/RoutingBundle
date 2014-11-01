<?php

/*
 * This file is part of the Tadcka package.
 *
 * (c) Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tadcka\Bundle\RoutingBundle\DependencyInjection\Compiler;

use Symfony\Component\Config\Resource\DirectoryResource;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Finder\Finder;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 11/1/14 12:13 PM
 */
class TranslatorConfigurationPass implements CompilerPassInterface
{

    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        $translator = $container->findDefinition('translator');
        if (!$translator) {
            return null;
        }

        $dir = null;
        if (class_exists('Tadcka\Component\Routing\Model\Route')) {
            $r = new \ReflectionClass('Tadcka\Component\Routing\Model\Route');

            $dir = dirname($r->getFilename()).'/../Resources/translations';
        }

        if ($dir) {
            $container->addResource(new DirectoryResource($dir));

            $finder = Finder::create()
                ->files()
                ->filter(function (\SplFileInfo $file) {
                        return 2 === substr_count($file->getBasename(), '.') && preg_match('/\.\w+$/', $file->getBasename());
                    })
                ->in($dir)
            ;

            foreach ($finder as $file) {
                // filename is domain.locale.format
                list($domain, $locale, $format) = explode('.', $file->getBasename(), 3);
                $translator->addMethodCall('addResource', array($format, (string) $file, $locale, $domain));
            }
        }
    }
}
