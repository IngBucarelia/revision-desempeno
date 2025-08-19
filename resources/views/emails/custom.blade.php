<!DOCTYPE html>
<html>
<head>
    <title>{{ $subject ?? 'Mensaje' }}</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background-color: #f8f9fa; padding: 15px; text-align: center; }
        .content { padding: 20px; background-color: #fff; }
        .footer { margin-top: 20px; font-size: 12px; color: #6c757d; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Mensaje Revisión de Desempeño</h2>
        </div>
        
        <div class="content">
            <p><strong>Remitente:</strong> {{ $sender }}</p>
            <p><strong>Mensaje:</strong></p>
           <p style="white-space: pre-line;">
    {{ $content }}
</p>

        </div>
        
        <div class="footer">
            <p>Este mensaje fue enviado a través de nuestro sistema.</p>
        </div>
    </div>
</body>
</html>