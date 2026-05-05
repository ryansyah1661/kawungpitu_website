<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            padding: 30px;
            border: 1px solid #f0f0f0;
            border-radius: 12px;
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
        }

        .header {
            border-bottom: 3px solid #800000;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }

        .header h2 {
            color: #800000;
            margin: 0;
            text-transform: uppercase;
            font-size: 20px;
        }

        .info-row {
            margin-bottom: 15px;
        }

        .label {
            font-weight: bold;
            color: #800000;
            display: block;
            font-size: 13px;
            text-transform: uppercase;
        }

        .value {
            font-size: 16px;
            color: #444;
        }

        .content-box {
            background: #fdfdfd;
            padding: 20px;
            border-radius: 8px;
            border-left: 4px solid #800000;
            margin-top: 20px;
        }

        .footer {
            margin-top: 30px;
            font-size: 11px;
            color: #999;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>Pesan Kontak Baru - Kawung Pitu</h2>
        </div>

        <div class="info-row">
            <span class="label">Nama Pengirim:</span>
            <span class="value">{{ $contactMessage->name }}</span>
        </div>

        <div class="info-row">
            <span class="label">Alamat Email:</span>
            <span class="value">{{ $contactMessage->email }}</span>
        </div>

        <div class="info-row">
            <span class="label">Subjek:</span>
            <span class="value">{{ $contactMessage->subject }}</span>
        </div>

        <div class="content-box">
            <span class="label" style="margin-bottom: 10px;">Isi Pesan:</span>
            <p style="margin: 0; white-space: pre-wrap;">{{ $contactMessage->message }}</p>
        </div>

        <div class="footer">
            <hr style="border: 0; border-top: 1px solid #eee; margin-bottom: 15px;">
            <p>Email ini dikirim otomatis oleh sistem Kawung Pitu Institute karena adanya pesan masuk melalui formulir
                kontak.</p>
        </div>
    </div>
</body>

</html>
