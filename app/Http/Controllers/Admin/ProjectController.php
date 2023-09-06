<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::orderBy('updated_at', 'DESC')->get();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $project = new Project();

        return view('admin.projects.create', compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|string|max:50|unique:projects',
                'description' => 'required|string',
                'cover_image' => 'nullable|url',
                'start_date' => 'required|date',
                'end_date' => 'nullable|date',
                'category' => 'required|string',
                'technologies' => 'required|string',
                'project_url' => 'nullable|url',
                'github_url' => 'nullable|url',
                'client' => 'nullable|string',
                'role' => 'required|string',
                'additional_notes' => 'nullable|string',
                'visibility' => 'required|boolean',
            ],
            [
                'title.required' => 'The title field is mandatory.',
                'title.max' => 'The title field cannot exceed 50 characters.',
                'title.unique' => 'The title field must be unique.',
                'description.required' => 'The description field is mandatory.',
                'cover_image.url' => 'The cover image must be a valid URL.',
                'start_date.required' => 'The start date field is mandatory.',
                'start_date.date' => 'The start date must be a valid date.',
                'end_date.date' => 'The end date must be a valid date.',
                'category.required' => 'The category field is mandatory.',
                'technologies.required' => 'The technologies field is mandatory.',
                'project_url.url' => 'The project URL must be a valid URL.',
                'github_url.url' => 'The GitHub URL must be a valid URL.',
                'role.required' => 'The role field is mandatory.',
                'visibility.required' => 'The visibility field is mandatory.',
            ]
        );

        $data = $request->all();

        $project = new Project();

        $project->fill($data);

        $project->save();

        return to_route('admin.projects.show', $project)->with('type', 'success')->with('message', 'Project successfully inserted');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => [
                'required',
                'string',
                'max:50',
                Rule::unique('projects')->ignore($project),
            ],
            'description' => 'required|string',
            'cover_image' => 'nullable|url',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'category' => 'required|string',
            'technologies' => 'required|string',
            'project_url' => 'nullable|url',
            'github_url' => 'nullable|url',
            'client' => 'nullable|string',
            'role' => 'required|string',
            'additional_notes' => 'nullable|string',
            'visibility' => 'required|boolean',
        ], [
            'title.required' => 'The title field is mandatory.',
            'title.max' => 'The title field cannot exceed 50 characters.',
            'title.unique' => 'The title field must be unique.',
            'description.required' => 'The description field is mandatory.',
            'cover_image.url' => 'The cover image must be a valid URL.',
            'start_date.required' => 'The start date field is mandatory.',
            'start_date.date' => 'The start date must be a valid date.',
            'end_date.date' => 'The end date must be a valid date.',
            'category.required' => 'The category field is mandatory.',
            'technologies.required' => 'The technologies field is mandatory.',
            'project_url.url' => 'The project URL must be a valid URL.',
            'github_url.url' => 'The GitHub URL must be a valid URL.',
            'role.required' => 'The role field is mandatory.',
            'visibility.required' => 'The visibility field is mandatory.',
        ]);

        $data = $request->all();

        $project->update($data);

        return to_route('admin.projects.show', $project)->with('type', 'success')->with('message', 'Project successfully modified');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return to_route('admin.projects.index')->with('type', 'success')->with('message', 'Project successfully deleted');
    }
}
