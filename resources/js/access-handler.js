export function registerAccessHandler() {
    window.addEventListener('fetch-error', (event) => {
        handleAccessError(event.detail);
    });

    document.addEventListener('livewire:init', () => {
        Livewire.hook('request', ({ fail }) => {
            fail((response) => {
                handleAccessError(response);
            });
        });
    });
}

function handleAccessError(response) {
    if (!response) return;

    let data = null;

    try {
        data = response?.response?.data;
    } catch (e) {
        return;
    }

    if (response?.status !== 403 || data?.type !== 'subscription_required') {
        return;
    }

    window.Livewire.dispatch('openSubscriptionModal', data);
}