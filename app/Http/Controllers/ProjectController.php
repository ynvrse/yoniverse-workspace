<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return Inertia::render('Dashboard', [
            'projects' => $projects
        ]);
    }

    public function update(Request $request, Project $project)
    {
        $validatedData = $request->validate([
            'status' => 'required|in:draft,in_progress,on_review,completed',
            // Tambahkan validasi lain sesuai kebutuhan
        ]);

        $project->update($validatedData);

        return redirect()->back();
    }

    public function updateOrder(Request $request)
    {
        $projectIds = $request->input('projectIds');

        foreach ($projectIds as $index => $id) {
            Project::where('id', $id)->update(['order' => $index]);
        }

        return response()->json(['message' => 'Urutan proyek berhasil diperbarui']);
    }
}
