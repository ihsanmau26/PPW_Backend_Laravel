<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PDFResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'diagnosis' => $this->diagnosis,
            'notes' => $this->notes,
            'checkup' => [
                'id' => $this->checkup->id,
                'checkup_type' => $this->checkup->checkup_type,
                'checkup_date' => $this->checkup->checkup_date,
                'notes' => $this->notes,
                'doctor' => [
                    'id' => $this->checkup->doctor->id,
                    'name' => $this->checkup->doctor->user->name,
                    'specialization' => $this->checkup->doctor->specialization,
                ],
                'patient' => [
                    'id' => $this->checkup->patient->id,
                    'name' => $this->checkup->patient->user->name,
                    'gender' => $this->checkup->patient->gender,
                    'age' => $this->checkup->patient->age,
                    'date_of_birth' => $this->checkup->patient->date_of_birth,
                ],
            ],
            'prescription' => [
                'id' => $this->prescription->id,
                'prescription_date' => $this->prescription->prescription_date,
                'prescriptionDetails' => $this->prescription->prescriptionDetails->map(function ($detail) {
                    return [
                        'medicine_name' => $detail->medicine->name,
                        'medicine_type' => $detail->medicine->type,
                        'medicine_description' => $detail->medicine->description,
                        'quantity' => $detail->quantity,
                        'instructions' => $detail->instructions,
                    ];
                }),
            ],
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
