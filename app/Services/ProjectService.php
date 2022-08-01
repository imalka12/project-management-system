<?php
namespace App\Services;

use App\Http\Requests\CreateProjectRequest;
use App\Models\Project;
use App\Models\ProjectMember;
use App\Repositories\ProjectRepository;

class ProjectService
{

    private $projectRepository;

    public function __construct(ProjectRepository $projectRepository) {
        $this->projectRepository = $projectRepository;
    }

    public function create(CreateProjectRequest $request): Project
    {
        $data = $request->validated();

        $project = $this->projectRepository->create($data);
        
        $members = array_map(function ($memberId) {
            $projectMember = new ProjectMember();
            $projectMember->member_id = $memberId;
            return $projectMember;
        }, $request['members']);

        $project->members()->saveMany($members);

        return $project;
    }

    public function delete(Project $project)
    {
        return $this->projectRepository->delete($project->id);
    }

    public function getProjectById($id)
    {
        return $this->projectRepository->getProjectById($id);
    }

    public function update(Project $project, CreateProjectRequest $request)
    {
        $data = $request->validated();
        return $this->projectRepository->update($project, $data);
    }

    
}