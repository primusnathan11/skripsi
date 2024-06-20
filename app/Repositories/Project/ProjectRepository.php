<?php

namespace App\Repositories\Project;

use LaravelEasyRepository\Repository;
use Ramsey\Uuid\Type\Integer;

interface ProjectRepository extends Repository
{
    /**
     * Get Project using user_id
     *
     * @param Integer $user_id
     * @return object
     */
    public function getProjectPerUser($user_id);

    /**
     * Get project detail by id
     *
     * @param Integer $project_id
     * @return object
     */
    public function getDetailProject($project_id);
}
