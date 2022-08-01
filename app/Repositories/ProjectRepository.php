<?php
namespace App\Repositories;

use App\Models\Project;
use App\Repositories\Contracts\ProjectRepositoryInterface;

class ProjectRepository implements ProjectRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function create(array $data): Project
    {
        return Project::create($data);
    }

    /**
     * @inheritDoc
     */
    public function getProjectById($id): Project
    {
        return Project::with('client')->where('id', $id)->first();
    }

    /**
     * @inheritDoc
     */
    public function delete($id): bool
    {
        return Project::whereId($id)->delete();
    }

    /**
     * @inheritDoc
     */
    public function update(Project $project, array $data): bool
    {
        return $project->update($data);
    }

}