<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Factura de Reparación #{{ $repair->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }
        .invoice-details, .customer-details, .device-details {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }
        .section-title {
            font-weight: bold;
            background-color: #f4f4f4;
            padding: 5px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .total-row {
            font-size: 16px;
            font-weight: bold;
        }
        .terms {
            margin-top: 40px;
            font-size: 11px;
            text-align: justify;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 12px;
        }
    </style>
</head>
<body>

<div class="header">
    <h1>Servicio Técnico - Reparación Celulares</h1>
    <p>Factura de Orden de Reparación #{{ str_pad($repair->id, 5, '0', STR_PAD_LEFT) }}</p>
    <p>Fecha de Ingreso: {{ $repair->entrada_date->format('d/m/Y H:i') }}</p>
    @if($repair->salida_date)
        <p>Fecha de Entrega: {{ $repair->salida_date->format('d/m/Y H:i') }}</p>
    @endif
</div>

<div class="section-title">Datos del Cliente</div>
<table class="customer-details">
    <tr>
        <th>Nombre:</th>
        <td>{{ $repair->customer_name }}</td>
        <th>Teléfono:</th>
        <td>{{ $repair->customer_phone ?? 'N/A' }}</td>
    </tr>
    <tr>
        <th>Email:</th>
        <td colspan="3">{{ $repair->customer_email ?? 'N/A' }}</td>
    </tr>
</table>

<div class="section-title">Datos del Equipo</div>
<table class="device-details">
    <tr>
        <th>Marca:</th>
        <td>{{ $repair->phone_brand }}</td>
        <th>Modelo:</th>
        <td>{{ $repair->phone_model }}</td>
    </tr>
    <tr>
        <th>Color:</th>
        <td>{{ $repair->phone_color ?? 'N/A' }}</td>
        <th>Estado:</th>
        <td>{{ strtoupper(str_replace('_', ' ', $repair->status)) }}</td>
    </tr>
</table>

<div class="section-title">Detalles de la Reparación</div>
<table>
    <tr>
        <th>Descripción del Problema:</th>
        <td>{{ $repair->problem_description }}</td>
    </tr>
    @if($repair->observations)
        <tr>
            <th>Observaciones:</th>
            <td>{{ $repair->observations }}</td>
        </tr>
    @endif
    <tr class="total-row">
        <th>Costo Total:</th>
        <td>${{ number_format($repair->repair_cost, 2) }}</td>
    </tr>
</table>

<div class="terms">
    <strong>Términos y Condiciones de Reparación:</strong>
    <p>1. Todo equipo ingresado a reparación será revisado minuciosamente. No nos responsabilizamos por fallas no declaradas al momento de ingreso.</p>
    <p>2. Pasados 30 días de la notificación de reparación terminada, si el equipo no es retirado, la empresa podrá disponer del mismo para cubrir gastos de reparación, piezas y almacenaje.</p>
    <p>3. La garantía de reparación cubre únicamente las refacciones instaladas y la mano de obra relacionada con el problema original, durante un periodo de 30 días a partir de la fecha de entrega.</p>
    <p>4. La pérdida de este documento no exime la revisión de la identificación oficial para entregar el equipo.</p>
</div>

<div class="footer">
    <p>Firma de Conformidad del Cliente: _________________________</p>
</div>

</body>
</html>
