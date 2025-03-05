<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use Illuminate\Http\Request;
use PDF; // Import the PDF facade

class ReportController extends Controller
{
    public function generateGradesReport()
    {
        // Fetch grades data
        $grades = Grade::with(['student', 'subject'])->get();

        // Generate PDF
        $pdf = PDF::loadView('reports.grades', compact('grades'));

        // Download the PDF
        return $pdf->download('grades_report.pdf');
    }
} 