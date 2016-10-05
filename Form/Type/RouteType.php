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
 * @since 7/2/14 10:51 PM
 */
class RouteType extends AbstractType
{
    /**
     * @var string
     */
    private $routeClass;

    /**
     * Constructor.
     *
     * @param string $routeClass
     */
    public function __construct($routeClass)
    {
        $this->routeClass = $routeClass;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'visible',
            LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\CheckboxType'),
            array(
                'label' => 'form.route.visible',
                'required' => false,
            )
        );

        $builder->add(
            'routePattern',
            LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\TextType'),
            array(
                'label' => 'form.route.pattern',
                'constraints' => array(new Assert\NotBlank()),
                'required' => false,
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => $this->routeClass,
                'translation_domain' => 'TadckaRouting',
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
        return 'tadcka_route';
    }
}
