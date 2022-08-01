<?php

namespace App\Http\Controllers;

use App\Enums\ProjectStatus;
use App\Http\Requests\CreateProjectRequest;
use App\Models\Client;
use App\Models\Member;
use App\Models\Payment;
use App\Models\Project;
use App\Models\ProjectMember;
use App\Services\ProjectService;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public $project;

    public function __construct(ProjectService $projectService)
    {
        $this->project = $projectService;
    }

    /**
     * show create project page to add project
     * 
     * @return void
     */
    public function showCreateProject()
    {
        $statuses = ProjectStatus::asSelectArray();

        $clients = Client::all();
        $projects = Project::all();
        $members = Member::all();

        return view('projects', compact('clients', 'projects', 'members', 'statuses')); //conpact('statuses')
    }

    /**
     * process add project request to add entry
     * 
     * @param CreateProjectRequest $request
     * @param Project $project
     */
    public function addProject(CreateProjectRequest $request, Project $project)
    {
        $this->project->create($request);

        return redirect()->route('add-project')->with('success', 'New project added successfully.');
    }

    /**
     * process delete project request to delete selected entry
     * 
     * @param Project $project
     */
    public function deleteProject(Project $project)
    {
        $this->project->delete($project);

        return redirect()->route('create-project')->with('success', 'Project deleted successfully.');
    }

    /**
     * show edit project page to update details
     * 
     * @param Project $project
     * @param Client $client
     * @param Member $member
     */
    public function editProject(Project $project, Client $clients, Member $members)
    {
        $statuses = ProjectStatus::asSelectArray();
        return view('projects-edit', compact('project', 'clients', 'members', 'statuses'));
    }

    /**
     * process updateproject request
     * 
     * @param CreateProjectRequest $request
     * @param Project $project
     */
    public function updateProject(CreateProjectRequest $request, Project $project)
    {
        $this->project->update($project, $request);

        return redirect()->route('create-project');
    }

    public function getAllProjects()
    {
        $projects = Project::all();

        return $projects;
    }
}
