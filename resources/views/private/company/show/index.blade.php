<x-layouts.app>
    @push('scripts')
        <script src="{{ \App\Services\Subscription\Billing\PagSeguroService::sdkUrl() }}"></script>
    @endpush

    <livewire:private.company.company-show-component :company="$company" />
</x-layouts.app>
