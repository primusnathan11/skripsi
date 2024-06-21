<?php

namespace App\Repositories\Tree;

use App\Models\Tree;
use Illuminate\Support\Facades\DB;
use LaravelEasyRepository\Implementations\Eloquent;

class TreeRepositoryImplement extends Eloquent implements TreeRepository
{

    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Model|mixed $model;
     */
    protected $model;

    public function __construct(Tree $model)
    {
        $this->model = $model;
    }
 
    public function getAvailableTreeFromOffset(float $offset): array
    {
        $userTrees = [];

        $tenYearAgo = date('Y-m-d', strtotime('-10 year'));

        $getTree = $this->model::select(['trees.*', 'tree_types.name AS tree_type_name', 'tree_types.sequestration', DB::raw('COUNT(user_trees.user_tree_sequestration) as user_sequastration'), DB::raw('IF( ISNULL(SUM( user_trees.user_tree_sequestration )),tree_types.sequestration,tree_types.sequestration - SUM( user_trees.user_tree_sequestration )) as remaining_sequastration')])
            ->join('tree_types', 'tree_types.id', '=', 'trees.type_id')
            ->join('user_trees', 'user_trees.id', '=', 'trees.id', 'left')
            ->where('trees.planting_date', '<=', $tenYearAgo)
            ->groupBy('trees.id')
            ->orderBy('trees.id', 'ASC')
            ->having('remaining_sequastration', '>=', $offset)
            ->limit(1)
            ->get();

        foreach ($getTree as $tree) {
            $userTrees[] = [
                'tree_id' => $tree->id,
                'code' => $tree->code,
                'user_tree_sequestration' => $offset,
            ];
        }

        return $userTrees;
    }
}
