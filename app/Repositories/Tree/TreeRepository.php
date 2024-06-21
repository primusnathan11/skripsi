<?php

namespace App\Repositories\Tree;

use LaravelEasyRepository\Repository;
use PhpParser\Node\Expr\Cast\Double;

interface TreeRepository extends Repository
{

    /**
     * get available tree from total offset
     * @param float $offset
     * @return array 
     * @var $data[]['tree_id']
     * @var $data[]['code']
     * @var $data[]['user_tree_sequestration']
     */
    public function getAvailableTreeFromOffset(float $offset): array;
}
