@php
    $styles = [
        'success' => [
            'wrapper' => 'bg-emerald-50 border-emerald-100',
            'icon_bg' => 'bg-emerald-100/50',
            'icon_color' => 'text-emerald-600',
            'text' => 'text-emerald-900',
            'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'
        ],
        'error' => [
            'wrapper' => 'bg-rose-50 border-rose-100',
            'icon_bg' => 'bg-rose-100/50',
            'icon_color' => 'text-rose-600',
            'text' => 'text-rose-900',
            'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'
        ],
        'warning' => [
            'wrapper' => 'bg-amber-50 border-amber-100',
            'icon_bg' => 'bg-amber-100/50',
            'icon_color' => 'text-amber-600',
            'text' => 'text-amber-900',
            'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>'
        ],
        'info' => [
            'wrapper' => 'bg-blue-50 border-blue-100',
            'icon_bg' => 'bg-blue-100/50',
            'icon_color' => 'text-blue-600',
            'text' => 'text-blue-900',
            'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'
        ]
    ];
    
    $config = $styles[$type] ?? $styles['info'];
@endphp

<div class="mb-6 rounded-2xl border p-4 flex items-start gap-4 {{ $config['wrapper'] }} animate-fade-in-down">
    <div class="shrink-0 w-10 h-10 rounded-xl flex items-center justify-center {{ $config['icon_bg'] }} {{ $config['icon_color'] }}">
        {!! $config['icon'] !!}
    </div>
    <div class="flex-1 py-2">
        <p class="text-sm font-medium {{ $config['text'] }}">{{ $message }}</p>
    </div>
    <button onclick="this.parentElement.remove()" class="p-2 -mr-2 rounded-lg hover:bg-black/5 transition-colors {{ $config['text'] }}">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
    </button>
</div>
