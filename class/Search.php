<?php
/**
 * Created by PhpStorm.
 * User: mayifan
 * Date: 2018/7/12
 * Time: 上午10:41
 */

namespace Astar;


class Search
{
    private $nodeObj = null;
    private $searchType = 'straight';
    private $openList = [];
    private $closeList = [];

    public function __construct($nodeObj, $searchType)
    {
        $this->nodeObj = $nodeObj;
        $this->searchType = $searchType;
    }

    /**
     * @param $start
     * @param $end
     * @param $closeList
     * @return array
     */
    public function search($start, $end, $closeList)
    {
        $result = [];
        $this->openList[] = $start;
        $this->closeList = $closeList;
        $current = $this->findWay($start, $end);
        if ($current !== $end) {
            return $result;
        }

        foreach ($this->getReversedPath($current) as $obj) {
            $result[] = [$obj->getY(),$obj->getX()];
        }
        array_pop($result);
        array_shift($result);
        return $result;
    }

    /**
     * @param $current
     * @param $end
     * @return mixed
     */
    public function findWay($current, $end)
    {
        while ($current !== $end) {
            $current = array_shift($this->openList); // 出栈
            $this->closeList[] = $current;
            $neighbors = $this->nodeObj->getNeighbors($current, $this->searchType); // 获取邻点
            foreach ($neighbors as $neighbor) {
                if (in_array($neighbor, $this->closeList)) {
                    continue;
                }
                $G = $current->getG() + 1; // 距离最小单元为1
                $visited = $neighbor->isVisited();
                if (!$visited || $G < $neighbor->getG()) {
                    $neighbor->visit();
                    $neighbor->setParent($current);
                    $neighbor->setH($this->calculateH($neighbor, $end));
                    $neighbor->setG($G);
                    $neighbor->setF($neighbor->getH() + $neighbor->getG());
                }
                if (!$visited) {
                    array_unshift($this->openList, $neighbor); // 入栈
                }
            }
            $this->sortOpenList(); // 根据F大小排序
        }
        return $current;
    }

    /**
     * @param $current
     * @return array
     */
    public function getReversedPath($current)
    {
        $result = [];
        while ($current->getParent()) {
            $result[] = $current;
            $current = $current->getParent();
        }
        $result[]=$current;
        return array_reverse($result);
    }

    /**
     * @param $point
     * @param $end
     * @return number
     */
    public function calculateH ($point, $end)
    {
        $x = abs($point->getX() - $end->getX());
        $y = abs($point->getY() - $end->getY());
        return $x + $y;
    }

    public function sortOpenList()
    {
        $sortArr = $index = [];
        $i = 0;
        foreach ($this->openList as $key => $value) {
            $sortArr[$key] = $value->getF();
            $index[] = $i++;
        }
        array_multisort($sortArr, SORT_ASC, $index, SORT_ASC, $this->openList);
    }
}