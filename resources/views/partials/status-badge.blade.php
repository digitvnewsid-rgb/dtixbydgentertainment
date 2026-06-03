@php
    $colors = [
        'draft' => 'bg-slate-100 text-slate-700',
        'published' => 'bg-green-100 text-green-700',
        'closed' => 'bg-amber-100 text-amber-800',
        'cancelled' => 'bg-red-100 text-red-700',
        'active' => 'bg-green-100 text-green-700',
        'inactive' => 'bg-slate-100 text-slate-600',
        'sold_out' => 'bg-orange-100 text-orange-800',
    ];
    $class = $colors[$status] ?? 'bg-slate-100 text-slate-700';
@endphp
<span class="inline-flex rounded-full px-2 py-1 text-xs font-medium {{ $class }}">{{ str_replace('_', ' ', $status) }}</span>
