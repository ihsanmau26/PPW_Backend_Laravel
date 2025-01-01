<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prescription PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            color: #000;
        }

        .header {
            text-align: center;
            position: relative;
            padding-left: 100px;
        }

        .header img {
            position: absolute;
            top: 0;
            left: 0;
            width: 80px;
            height: auto;
        }

        .header h1, .header p {
            margin: 5px 0;
            padding-left: 10px;
        }

        .section {
            margin: 20px 0;
        }

        .section h3 {
            margin-bottom: 10px;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .info-table th, .info-table td {
            padding: 5px;
            text-align: left;
            border: 1px solid #ddd;
        }

        .info-table th {
            width: 30%;
            background-color: #f4f4f4;
        }

        .prescription {
            margin-top: 10px;
        }

        .prescription p {
            margin: 5px 0;
        }

        .signature {
            text-align: right;
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <div class="page">
        <div class="header">
            <img src="{{ public_path('images/logo.png') }}" alt="Telkom Medika Logo">
            <h1>Telkom Medika</h1>
            <p>Gedung Business Center, Jl. Telekomunikasi, Sukapura, Dayeuhkolot, Bandung Regency, West Java 40257</p>
        </div>
        <div class="section">
            <h3>Copy of Prescription</h3>
            <table class="info-table">
                <tr>
                    <th>No.</th>
                    <td>{{ $resource['id'] }}</td>
                </tr>
                <tr>
                    <th>Doctor</th>
                    <td>Dr. {{ $resource['checkup']['doctor']['user']['name'] }} ({{ $resource['checkup']['doctor']['specialization'] }})</td>
                </tr>
                <tr>
                    <th>Patient</th>
                    <td>{{ $resource['checkup']['patient']['user']['name'] }} ({{ $resource['checkup']['patient']['age'] }} Tahun)</td>
                </tr>
            </table>
        </div>
        <div class="prescription">
            @foreach ($resource['prescription']['prescriptionDetails'] as $detail)
                <p>R/ {{ $detail['medicine']['name'] }} {{ $detail['medicine']['type'] }} - {{ $detail['quantity'] }} pcs</p>
                <p>S. {{ $detail['instructions'] }}</p>
            @endforeach
        </div>
        <div class="signature">
            <p>Telkom Medika</p>
            <br><br>
            <p>Dr. {{ $resource['checkup']['doctor']['user']['name'] }}</p>
        </div>
    </div>
</body>
</html>
