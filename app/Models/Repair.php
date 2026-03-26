<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Repair extends Model
{
    protected $fillable = [
        'user_id',                  // Técnico responsable
        'customer_name',            // Nombre del cliente
        'customer_phone',           // Teléfono del cliente
        'customer_email',           // Email del cliente
        'phone_brand',              // Marca del teléfono
        'phone_model',              // Modelo del teléfono
        'phone_color',              // Color del teléfono
        'problem_description',      // Descripción del problema
        'technical_notes',          // Notas técnicas durante la reparación
        'repair_cost',              // Costo de la reparación
        'entrada_date',             // Fecha y hora de ingreso del celular
        'reparado_date',            // Fecha y hora en que se marcó como reparado
        'salida_date',              // Fecha y hora de egreso del celular
        'status',                   // Estado (pendiente, en_reparacion, reparado, no_reparable, entregado)
        'observations',             // Observaciones adicionales
        'delivered_by',             // Usuario que entregó la reparación
    ];

    protected $casts = [
        'entrada_date' => 'datetime',
        'reparado_date' => 'datetime',
        'salida_date' => 'datetime',
        'repair_cost' => 'decimal:2',
    ];

    /**
     * Relación con el usuario (técnico original)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación con el usuario que entregó el equipo
     */
    public function deliveredBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'delivered_by');
    }
}
