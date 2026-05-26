<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Atur Ulang Kata Sandi</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f9;
            color: #333333;
            margin: 0;
            padding: 40px 20px;
        }

        .container {
            max-width: 550px;
            background: #ffffff;
            margin: 0 auto;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .header {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            color: #1a202c;
            margin-bottom: 25px;
            border-bottom: 2px solid #edf2f7;
            padding-bottom: 15px;
        }

        .content {
            font-size: 15px;
            line-height: 1.6;
            color: #4a5568;
        }

        .btn-container {
            text-align: center;
            margin: 30px 0;
        }

        .btn {
            background-color: #4a0e17;
            color: #ffffff !important;
            text-decoration: none;
            padding: 12px 35px;
            font-size: 15px;
            font-weight: bold;
            border-radius: 6px;
            display: inline-block;
        }

        .footer {
            font-size: 12px;
            color: #a0aec0;
            text-align: center;
            margin-top: 30px;
            border-top: 1px solid #edf2f7;
            padding-top: 15px;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="header">
            Kawungpitu Institute
        </div>

        <div class="content">
            <p>Halo <strong>{{ $name }}</strong>,</p>
            <p>Kami menerima permintaan untuk mengatur ulang kata sandi akun Anda di sistem Dashboard Admin Kawungpitu
                Institute.</p>

            <div class="btn-container">
                <a href="{{ $url }}" class="btn">Atur Ulang Kata Sandi</a>
            </div>

            <p>Tautan ini hanya akan berlaku selama 60 menit. Jika Anda tidak pernah meminta pengaturan ulang kata sandi
                ini, silakan abaikan pesan ini.</p>
        </div>

        <div class="footer">
            &copy; {{ date('Y') }} Kawungpitu Institute. All rights reserved.
        </div>
    </div>

</body>

</html>
