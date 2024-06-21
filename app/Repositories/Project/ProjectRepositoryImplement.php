<?php

namespace App\Repositories\Project;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Project;
use Illuminate\Support\Facades\DB;

class ProjectRepositoryImplement extends Eloquent implements ProjectRepository
{

    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Model|mixed $model;
     */
    protected $model;

    public function __construct(Project $model)
    {
        $this->model = $model;
    }

    public function getProjectPerUser($user_id)
    {
        return $this->model::with("partner")->where("user_id", $user_id)->orderBy('planting_date', 'asc')->getOrFail();
    }

    public function getDetailProject($project_id)
    {
        return $this->model::select(['projects.*', DB::raw('COUNT(trees.id) as tree_total')])
            ->join('tree_types', 'tree_types.project_id', '=', 'projects.id', 'left')
            ->join('trees', 'trees.type_id', '=', 'tree_types.id', 'left')
            ->groupBy('projects.id')
            ->where('projects.id', '=', $project_id)
            ->with('partner')
            ->firstOrFail();
    }
}
