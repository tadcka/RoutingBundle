<?php

/*
 * This file is part of the Tadcka package.
 *
 * (c) Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tadcka\Bundle\RoutingBundle\Doctrine\EntityManager;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Tadcka\Component\Routing\Model\Manager\RouteManager as BaseRouteManager;
use Tadcka\Component\Routing\Model\RouteInterface;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 7/1/14 11:10 PM
 */
class RouteManager extends BaseRouteManager
{
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @var EntityRepository
     */
    protected $repository;

    /**
     * @var string
     */
    protected $class;

    /**
     * Constructor.
     *
     * @param EntityManager $em
     * @param string $class
     */
    public function __construct(EntityManager $em, $class)
    {
        $this->em = $em;
        $this->repository = $em->getRepository($class);
        $this->class = $em->getClassMetadata($class)->name;
    }

    /**
     * {@inheritdoc}
     */
    public function findByName($name)
    {
        return $this->repository->findOneBy(array('name' => $name));
    }

    /**
     * {@inheritdoc}
     */
    public function findByNames(array $names)
    {
        return $this->repository->findBy(array('name' => $names));
    }

    /**
     * {@inheritdoc}
     */
    public function findByRoutePattern($routePattern)
    {
        return $this->repository->findOneBy(array('routePattern' => $routePattern));
    }

    /**
     * {@inheritdoc}
     */
    public function findByRoutePatterns(array $routePatterns)
    {
        return $this->repository->findBy(array('routePattern' => $routePatterns));
    }

    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return $this->repository->findAll();
    }

    /**
     * {@inheritdoc}
     */
    public function add(RouteInterface $route, $save = false)
    {
        $this->em->persist($route);
        if (true === $save) {
            $this->save();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function remove(RouteInterface $route, $save = false)
    {
        $this->em->remove($route);
        if (true === $save) {
            $this->save();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function save()
    {
        $this->em->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function clear()
    {
        $this->em->clear($this->getClass());
    }

    /**
     * {@inheritdoc}
     */
    public function getClass()
    {
        return $this->class;
    }
}
