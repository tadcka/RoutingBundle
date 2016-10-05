<?php

/*
 * This file is part of the Tadcka package.
 *
 * (c) Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tadcka\Bundle\RoutingBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Tadcka\Bundle\RoutingBundle\Form\Util\LegacyFormHelper;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 11/1/14 3:56 PM
 */
class RedirectRouteType extends AbstractType
{
    /**
     * @var string
     */
    private $redirectRouteClass;

    /**
     * Constructor.
     *
     * @param string $redirectRouteClass
     */
    public function __construct($redirectRouteClass)
    {
        $this->redirectRouteClass = $redirectRouteClass;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'permanent',
            LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\CheckboxType'),
            array(
                'label' => 'form.redirect_route.permanent',
                'required' => false
            )
        );

        $builder->add(
            'uri',
            LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\TextType'),
            array(
                'label' => 'form.redirect_route.uri',
                'constraints' => array(new Assert\Url()),
                'required' => false,
            )
        );

        $builder->add(
            'routeName',
            LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\TextType'),
            array(
                'label' => 'form.redirect_route.route_name',
                'required' => false,
            )
        );

        if ($options['use_route_target']) {
            $builder->add(
                'routeTarget',
                LegacyFormHelper::getType('Tadcka\Bundle\RoutingBundle\Form\Type\RouteChoiceType'),
                array(
                    'required' => false,
                )
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => $this->redirectRouteClass,
                'translation_domain' => 'TadckaRouting',
                'use_route_target' => true,
            )
        );
    }

    /**
     * BC for SF < 3.0
     *
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->getBlockPrefix();
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'tadcka_redirect_route';
    }
}
