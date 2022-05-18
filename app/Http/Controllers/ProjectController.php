<?php

namespace App\Http\Controllers;

use App\Enums\ProjectStatus;
use App\Http\Requests\CreateProjectRequest;
use App\Models\Client;
use App\Models\Member;
use App\Models\Project;
use App\Models\ProjectMember;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    public function showCreateProject()
    {
        $statuses = ProjectStatus::asSelectArray();

        $clients = Client::all();
        $projects = Project::all();
        $members = Member::all();

        return view('projects', compact('clients', 'projects', 'members', 'statuses')); //conpact('statuses')
    }

    public function addProject(CreateProjectRequest $request, Project $project)
    {
        $data = $request->validated();
        $project = Project::create($data);

        $members = array_map(function ($memberId) {
            $projectMember = new ProjectMember();
            $projectMember->member_id = $memberId;
            return $projectMember;
        }, $data['members']);

        // dd($members);

        $project->members()->saveMany($members);

        return redirect()->route('add-project')->with('success', 'New project added successfully.');
    }

    public function deleteProject(Project $project)
    {
        $project->delete();

        return redirect()->route('create-project')->with('success', 'Project deleted successfully.');
    }

    public function editProject(Project $project, Client $clients, Member $members)
    {
        $statuses = ProjectStatus::asSelectArray();
        return view('projects-edit', compact('project', 'clients', 'members', 'statuses'));
    }

    public function updateProject(CreateProjectRequest $request, Project $project)
    {
        $project = Project::whereId($project->id)->first();
        $project->update([
            'name' => $request->get('name'),
            'status' => $request->get('status'),
            'start_date' => $request->get('start_date'),
            'end_date' => $request->get('end_date'),
            'amount' => $request->get('amount'),
            'client_id' => $request->get('client_id'),

        ]);

        return redirect()->route('create-project');
    }
}
