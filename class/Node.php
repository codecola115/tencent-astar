<?php
/**
 * Created by PhpStorm.
 * User: mayifan
 * Date: 2018/7/12
 * Time: 下午3:35
 */

namespace Astar;


class Node
{
    private $x = 0;
    private $y = 0;
    private $parent = null;
    private $visited = false;

    private $G = 0;
    private $H = 0;
    private $F = 0;

    public function __construct($y, $x)
    {
        $this->x = (int)$x;
        $this->y = (int)$y;
    }

    public function visit()
    {
        $this->visited = true;
    }

    public function isVisited()
    {
        return $this->visited === true;
    }

    /**
     * @param $parent
     */
    public function setParent($parent)
    {
        $this->parent = $parent;
    }

    /**
     * @return object
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @return int
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * @return int
     */
    public function getY()
    {
        return $this->y;
    }

    /**
     * @param $G
     */
    public function setG($G)
    {
        $this->G = $G;
    }

    /**
     * @return int
     */
    public function getG()
    {
        return $this->G;
    }

    /**
     * @param $H
     */
    public function setH($H)
    {
        $this->H = $H;
    }

    /**
     * @return int
     */
    public function getH()
    {
        return $this->H;
    }

    /**
     * @param $F
     */
    public function setF($F)
    {
        $this->F = $F;
    }

    /**
     * @return int
     */
    public function getF()
    {
        return $this->F;
    }
}