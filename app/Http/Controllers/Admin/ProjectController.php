<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project; // Importa el modelo

class ProjectController extends Controller
{
    // Muestra la vista con el formulario y la lista
    public function index()
    {
        $projects = Project::orderBy('name')->get();
        return view('admin.projects.index', compact('projects'));
    }

    // Guarda el nuevo proyecto
    public function store(Request $request)
    {
        // Validación
        $request->validate([
            'name' => 'required|string|max:255|unique:projects',
            'description' => 'nullable|string',
        ]);

        // Creación
        Project::create($request->all());

        // Redirección
        return back()->with('success', '¡Proyecto creado con éxito!');
    }
}