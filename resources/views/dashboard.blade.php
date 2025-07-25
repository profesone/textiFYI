<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
                <div class="absolute inset-0 flex items-center justify-center text-2xl font-bold text-neutral-900 dark:text-neutral-100">
                    <h2>{{ $totalClients }} Clients</h2>
                </div>
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
                <div class="absolute inset-0 flex items-center justify-center text-2xl font-bold text-neutral-900 dark:text-neutral-100">
                    <h2>{{ $totalDispatches }} Dispatches</h2>
                </div>
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
                <div class="absolute inset-0 flex items-center justify-center text-2xl font-bold text-neutral-900 dark:text-neutral-100">
                    <h2>{{ $totalTextifyiNumbers }} TextiFYI #s</h2>
                </div>
            </div>
        </div>
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            @if ($totalContacts < 1)
                <div class="absolute inset-0 flex items-center justify-center text-2xl font-bold text-neutral-900 dark:text-neutral-100">
                    <h2>{{ $totalContacts }} Contacts</h2>
                </div>
            @else
                <div class="text-2xl font-bold text-neutral-900 dark:text-neutral-100">
                    <h2>{{ $totalContacts }} Contacts</h2>
                </div>
            @endif
        </div>
    </div>
</x-layouts.app>
