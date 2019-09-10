<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        return view('projects.index', [
            'projects' => Project::with('image')->get(),
        ]);
    }

    public function showProject($project)
    {
        $view = "projects/$project";
        if (view()->exists($view)) {
            return view($view);
        }

        abort('404');
    }
}
