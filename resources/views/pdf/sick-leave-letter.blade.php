<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Certificate PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            line-height: 1.6;
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

        .content {
            margin-top: 50px;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .info-table th, .info-table td {
            padding: 5px;
            text-align: left;
        }

        .info-table th {
            width: 30%;
        }

        .signature {
            margin-top: 30px;
            text-align: right;
        }

        .signature p {
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('images/logo.png') }}" alt="Telkom Medika Logo">
        <h1>Telkom Medika</h1>
        <p>Gedung Business Center, Jl. Telekomunikasi, Sukapura, Dayeuhkolot, Bandung Regency, West Java 40257</p>
    </div>

    <div class="content">
        <h3 style="text-align: center;">SURAT KETERANGAN SAKIT</h3>
        <p style="text-align: center;">No. Peg. {{ $resource['id'] }}-{{ $resource['checkup']['id'] }}-{{ $resource['prescription']['id'] }} / {{ $resource['checkup']['checkup_date'] }}</p>

        <p>Yang bertanda tangan di bawah ini, <strong>Dr. {{ $resource['checkup']['doctor']['user']['name'] }}</strong> di Klinik Telkom Medika, menerangkan bahwa:</p>

        <table class="info-table">
            <tr>
                <th>Nama</th>
                <td>{{ $resource['checkup']['patient']['user']['name'] }}</td>
            </tr>
            <tr>
                <th>Tanggal Lahir</th>
                <td>{{ $resource['checkup']['patient']['date_of_birth'] }} ({{ $resource['checkup']['patient']['age'] }})</td>
            </tr>
            <tr>
                <th>Jenis Kelamin</th>
                <td>{{ $resource['checkup']['patient']['gender'] }}</td>
            </tr>
        </table>

        <p>Setelah dilakukan pemeriksaan, yang bersangkutan dalam keadaan sakit dan memerlukan istirahat selama 1-3 hari, terhitung sejak tanggal {{ $resource['checkup']['checkup_date'] }}.</p>

        <p>Demikian surat keterangan ini dibuat untuk dapat dipergunakan sebagaimana mestinya.</p>

        <div class="signature">
            <p>Bandung, {{ $resource['checkup']['checkup_date'] }}</p>
            <p>Telkom Medika</p>
            <br><br>
            <p>Dr. {{ $resource['checkup']['doctor']['user']['name'] }}</p>
        </div>
    </div>
</body>
</html>
