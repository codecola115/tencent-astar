<?php
/**
 * Created by PhpStorm.
 * User: mayifan
 * Date: 2018/7/11
 * Time: 下午5:10
 */


use Astar\Search;
use Astar\Build;

require_once 'class/Search.php';
require_once 'class/Build.php';
require_once 'class/Node.php';

$map = $_POST['map'];
$start = $_POST['start'];
$end = $_POST['end'];
$block = $_POST['block'];
$searchType = $_POST['searchType'];
$closeList = [];
$nodeObj = new Build($map); // 创建node对象集合
$searchObj = new Search($nodeObj, $searchType);

$start = $nodeObj->getPoint($start[0], $start[1]);
$end = $nodeObj->getPoint($end[0], $end[1]);

foreach ($block as $bp) {
    $closeList[] = $nodeObj->getPoint($bp[0], $bp[1]);
}

$result = $searchObj->search($start,$end, $closeList);
echo json_encode($result);

