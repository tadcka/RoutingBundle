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
use Tadcka\Bundle\RoutingBundle\Form\Util\LegacyFormHelper;
use Tadcka\Component\Routing\Model\Manager\RouteManagerInterface;
use TTadcka\Bundle\RoutingBundle\Form\DataTransformer\RouteChoiceTransformer;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 11/4/14 10:51 PM
 */
class RouteChoiceType extends AbstractType
{
    /**
     * @var RouteChoiceTransformer
     */
    private $routeChoiceTransformer;

    /**
     * @var RouteManagerInterface
     */
    private $routeManager;

    /**
     * @var string
     */
    private $routeClass;

    /**
     * Constructor.
     *
     * @param RouteChoiceTransformer $routeChoiceTransformer
     * @param RouteManagerInterface $routeManager
     * @param string $routeClass
     */
    public function __construct(
        RouteChoiceTransformer $routeChoiceTransformer,
        RouteManagerInterface $routeManager,
        $routeClass
    ) {
        $this->routeChoiceTransformer = $routeChoiceTransformer;
        $this->routeManager = $routeManager;
        $this->routeClass = $routeClass;
    }
    
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addModelTransformer($this->routeChoiceTransformer);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => $this->routeClass,
                'choices' => $this->getRoutes(),
                'empty_value' => 'form.route_choice.empty_value',
                'label' => 'form.route_choice.route_target',
                'translation_domain' => 'TadckaRouting',
            )
        );
    }

    /**
     * @return array
     */
    private function getRoutes()
    {
        $data = array();

        foreach ($this->routeManager->findAllNameAndPattern() as $row) {
            $data[$row['name']] = $row['route_pattern'];
        }

        return $data;
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\ChoiceType');
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
        return 'tadcka_route_choice';
    }
}
