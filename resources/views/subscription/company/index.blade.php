<x-layouts.auth>
    @push('scripts')
        <script src="{{ \App\Services\Subscription\Billing\PagSeguroService::sdkUrl() }}"></script>
    @endpush

    <livewire:subscription.sign-section-component />
</x-layouts.auth>
