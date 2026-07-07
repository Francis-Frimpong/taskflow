<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ProjectResource;
use App\Models\Project;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $projects = $request->user()->projects()->get();
        return ProjectResource::collection($projects);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $project = $request->user->projects()->create($request->only([
            'name', 'description', 'status',
        ]));

        return new ProjectResource($project);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
        return new ProjectResource($project);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        //
        $project->update($request->only([
            'name', 'description', 'status'
        ]));

        return new ProjectResource($project);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
        $project->delete($project);
        return response()->noContent();
    }
}
