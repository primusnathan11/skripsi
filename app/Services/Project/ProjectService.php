<?php

namespace App\Services\Project;

use LaravelEasyRepository\BaseService;
use Ramsey\Uuid\Type\Integer;

interface ProjectService extends BaseService
{
    /**
     * Get project list user
     *
     * @param Integer $user_id
     * @return array
     */
    public function getProjectsUser($user_id);

    /**
     * Get detail project
     *
     * @param Integer $project_id
     * @return array
     */
    public function getDetailProject($project_id);
}
