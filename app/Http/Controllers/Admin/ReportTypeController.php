<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReportType; 
use App\Models\Project; // 1. Añade el modelo Project

class ReportTypeController extends Controller
{
    public function index()
    {
        // 2. Obtén las dos variables
        $reportTypes = ReportType::orderBy('name')->get();
        $projects = Project::orderBy('name')->get(); // <--- AÑADE ESTA LÍNEA
        
        // 3. Pasa ambas variables a la vista
        return view('admin.report-types.index', compact('reportTypes', 'projects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:report_types',
        ]);

        ReportType::create($request->all());

        return back()->with('success', '¡Tipo de reporte creado con éxito!');
    }
}