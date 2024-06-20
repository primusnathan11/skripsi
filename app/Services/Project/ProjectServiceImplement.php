<?php

namespace App\Services\Project;

use LaravelEasyRepository\Service;
use App\Repositories\Project\ProjectRepository;

class ProjectServiceImplement extends Service implements ProjectService
{

  /**
   * don't change $this->mainRepository variable name
   * because used in extends service class
   */
  protected $mainRepository;

  public function __construct(ProjectRepository $mainRepository)
  {
    $this->mainRepository = $mainRepository;
  }

  public function getProjectsUser($user_id)
  {
    $projects = $this->mainRepository->getProjectPerUser($user_id);
    $data = [];

    foreach ($projects as $key => $p) {
      $data[] = [
        'id' => $p->id,
        'name' => $p->name,
        'description' => $p->description,
        'photo' => $p->photo,
        'partner_id' => $p->partner->id,
        'partner_name' => $p->partner->name,
        'planting_date' => date("Y-m-d", strtotime($p->planting_date)),
      ];
    }

    return $data;
  }

  public function getDetailProject($project_id)
  {
    $project = $this->mainRepository->getDetailProject($project_id);
    return $data = [
      'id' => $project->id,
      'name' => $project->name,
      'description' => $project->description,
      'partner_id' => $project->partner->id,
      'partner_name' => $project->partner->name,
      'planting_date' => date("Y-m-d", strtotime($project->planting_date)),
      'address' => $project->address,
      'photo' => $project->photo,
      'tree_total' => $project->tree_total,
    ];
  }
}
