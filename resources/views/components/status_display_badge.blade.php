<span class="badge badge-{{ $data?->status == \App\Enums\CommonStatus::Active ? 'success' : 'danger' }}">
    {{ data_get($status, $data?->status, '-') }}
</span>
