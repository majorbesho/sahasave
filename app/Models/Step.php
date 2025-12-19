<?php
// app/Models/Step.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    use HasFactory;

    protected $fillable = [
        'phase_number',
        'phase_title',
        'phase_icon',
        'phase_color',
        'step_number',
        'step_title',
        'step_description',
        'step_benefit',
        'sort_order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('phase_number')
            ->orderBy('step_number')
            ->orderBy('sort_order');
    }
}
