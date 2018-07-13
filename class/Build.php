<?php
/**
 * Created by PhpStorm.
 * User: mayifan
 * Date: 2018/7/12
 * Time: 下午3:59
 */

namespace Astar;


class Build
{

    private $nodes = [];

    public function __construct($grid)
    {
        foreach ($grid as $y => $cols) {
            foreach ($cols as $x => $value) {
                 $this->nodes[$y][$x] = new Node($y, $x);
            }
        }
    }

    /**
     * @param $y
     * @param $x
     * @return bool
     */
    public function getPoint($y, $x)
    {
        return isset($this->nodes[$y][$x]) ? $this->nodes[$y][$x] : false;
    }

    /**
     * @param $node
     * @return array
     */
    public function getNeighbors($node, $searchType)
    {
        $result = [];
        $x = $node->getX();
        $y = $node->getY();

        $neighbourLocations = [
            [$y - 1, $x],
            [$y + 1, $x],
            [$y, $x - 1],
            [$y, $x + 1],
        ];

        if ($searchType == 'oblique') {
            $neighbourLocations[] = [$y - 1, $x - 1];
            $neighbourLocations[] = [$y + 1, $x - 1];
            $neighbourLocations[] = [$y - 1, $x + 1];
            $neighbourLocations[] = [$y + 1, $x + 1];
        }

        foreach ($neighbourLocations as $location) {
            list($y, $x) = $location;
            $node = $this->getPoint($y, $x);
            if ($node) {
                $result[] = $node;
            }

        }
        return $result;

    }
}