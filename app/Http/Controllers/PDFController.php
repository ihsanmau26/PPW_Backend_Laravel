<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CheckupHistory;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Resources\PDFResource;


class PDFController extends Controller
{
    public function prescriptionPDF($id)
    {
        $resource = CheckupHistory::with(['checkup.doctor.user', 'checkup.patient.user', 'prescription.prescriptionDetails.medicine'])->findOrFail($id);
        $resourceData = new PDFResource($resource);

        $pdf = Pdf::loadView('pdf.prescription', ['resource' => $resourceData]);
        return $pdf->download('checkup_history_' . $id . '.pdf');
    }

    public function sickLeaveLetterPDF($id)
    {
        $resource = CheckupHistory::with(['checkup.doctor.user', 'checkup.patient.user', 'prescription.prescriptionDetails.medicine'])->findOrFail($id);
        $resourceData = new PDFResource($resource);

        $pdf = Pdf::loadView('pdf.sick-leave-letter', ['resource' => $resourceData]);
        return $pdf->download('checkup_history_' . $id . '.pdf');
    }
}
