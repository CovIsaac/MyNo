<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ReportType;
use App\Models\Priority;
use App\Models\Report;
use Illuminate\Support\Facades\Auth; // Para saber qué usuario envía
use Illuminate\Support\Facades\Storage; // Para guardar el archivo

class ReportController extends Controller
{
    /**
     * Muestra el formulario de creación de reporte.
     */
    public function create()
    {
        // Obtenemos las opciones dinámicas de la BBDD
        $projects = Project::orderBy('name')->get(); // <--- ¡AQUÍ ESTÁ!
        $reportTypes = ReportType::orderBy('name')->get();
        $priorities = Priority::orderBy('id')->get(); 

        // Mandamos LAS TRES variables a la vista
        return view('reports.create', [
            'projects' => $projects,
            'reportTypes' => $reportTypes,
            'priorities' => $priorities,
        ]);
    }
    /**
     * Guarda el nuevo reporte en la BBDD.
     */
    public function store(Request $request)
    {
        // 1. Validación de datos
        $validatedData = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'report_type_id' => 'required|exists:report_types,id',
            'priority_id' => 'required|exists:priorities,id',
            'report_date' => 'required|date',
            'body' => 'required|string',
            'attachment' => 'nullable|file|mimes:pdf,docx,xlsx,jpg,png|max:5120', // Max 5MB
        ]);

        $filePath = null;

        // 2. Manejo del archivo adjunto (si existe)
        if ($request->hasFile('attachment')) {
            // Guarda el archivo en 'storage/app/public/attachments'
            // El resultado de 'store' es la ruta (ej. 'attachments/archivo.pdf')
            $filePath = $request->file('attachment')->store('attachments', 'public');
        }

        // 3. Creación del reporte
        Report::create([
            'user_id' => Auth::id(), // Asigna el ID del usuario autenticado
            'project_id' => $validatedData['project_id'],
            'report_type_id' => $validatedData['report_type_id'],
            'priority_id' => $validatedData['priority_id'],
            'report_date' => $validatedData['report_date'],
            'body' => $validatedData['body'],
            'attachment' => $filePath, // Guarda la ruta del archivo o null
        ]);

        // 4. Redirección
        // (Idealmente a un dashboard de 'Mis Reportes')
        return redirect()->route('dashboard')->with('success', '¡Reporte enviado con éxito!');
    }
}