<a href="{{ $href }}"
   class="block rounded-lg px-3 py-2 text-sm {{ request()->url() === $href || ($active ?? false) ? 'bg-indigo-600 text-white' : 'text-slate-300 hover:bg-slate-800' }}">
    {{ $label }}
</a>
