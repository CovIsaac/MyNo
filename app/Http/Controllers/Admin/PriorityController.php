<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Priority; 
use App\Models\Project; // 1. Añade el modelo Project

class PriorityController extends Controller
{
    public function index()
    {
        // 2. Obtén las dos variables
        $priorities = Priority::orderBy('name')->get(); 
        $projects = Project::orderBy('name')->get(); // <--- AÑADE ESTA LÍNEA
        
        // 3. Pasa ambas variables a la vista
        return view('admin.priorities.index', compact('priorities', 'projects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:priorities',
        ]);

        Priority::create($request->all());

        return back()->with('success', '¡Prioridad creada con éxito!');
    }
}