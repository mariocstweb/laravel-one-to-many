<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $project = new Project();
        $types = Type::select('label', 'id')->get();
        return view('admin.projects.create', compact('project', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'programming_language' => 'required|string|max:255',
            'image' => 'nullable',
            'content' => 'required|string',
            'type_id' => 'nullable|exists:types,id'
        ]);

        $data = $request->all();
        $project = new Project();
        $project->fill($data);
        $project->slug = Str::slug($project->title);

        if (Arr::exists($data, 'image')) {
            $img_url = Storage::putFile('project_image', $data['image']);
            $project->image = $img_url;
        }

        $project->save();

        return to_route('admin.projects.show', $project)
            ->with('type', 'success')
            ->with('message', 'Progetto creato con successo!');
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

        $types = Type::select('label', 'id')->get();
        return view('admin.projects.edit', compact('project', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => ['required', 'string', Rule::unique('projects')->ignore($project->id)],
            'image' => 'nullable',
            'programming_language' => 'required|string|max:255',
            'content' => 'required|string'
        ]);

        $data = $request->all();

        if (Arr::exists($data, 'image')) {
            if ($project->image) Storage::delete($project->image);
            $img_url = Storage::putFile('project_image', $data['image']);
            $project->image = $img_url;
        }

        $project->update($data);


        return to_route('admin.projects.show', $project->id)
            ->with('type', 'success')
            ->with('message', "Progetto modificato correttamente.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return to_route('admin.projects.index')
            ->with('type', 'success')
            ->with('message', 'Hai spostato il progetto nel cestino');
    }


    // SOFT DELETS

    public function trash()
    {
        $projects = Project::onlyTrashed()->get();
        return view('admin.projects.trash', compact('projects'));
    }

    public function restore(Project $project)
    {

        $project->restore();
        return to_route('admin.projects.trash')
            ->with('type', 'success')
            ->with('message', 'Hai ripristinato con successo il progetto');
    }

    public function drop(Project $project)
    {
        if ($project->image) Storage::delete($project->image);
        $project->forceDelete();
        return to_route('admin.projects.trash')
            ->with('type', 'danger')
            ->with('message', 'Hai eliminato definitivamente il progetto');;
    }
}
