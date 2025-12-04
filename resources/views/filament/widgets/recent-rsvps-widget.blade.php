<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            Recent RSVPs
        </x-slot>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead>
                    <tr class="bg-gray-50 dark:bg-gray-800">
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-300">Guest</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-300">Attendance</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-300">Guests</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse ($this->getRecentRsvps() as $rsvp)
                        <tr>
                            {{-- Column 1: Name + Email --}}
                            <td class="px-4 py-3">
                                <div class="font-medium text-gray-900 dark:text-gray-100">
                                    {{ $rsvp->name }}
                                </div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ $rsvp->email }}
                                </div>
                            </td>

                            {{-- Column 2: Attendance Badge --}}
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 rounded-full text-xs font-medium
                                    {{ $rsvp->attendance === 'yes'
                                        ? 'bg-success-100 text-success-800 dark:bg-success-900 dark:text-success-200'
                                        : 'bg-danger-100 text-danger-800 dark:bg-danger-900 dark:text-danger-200' }}">
                                    {{ $rsvp->attendance === 'yes' ? 'Attending' : 'Not Attending' }}
                                </span>
                            </td>

                            {{-- Column 3: Guest Count --}}
                            <td class="px-4 py-3 text-sm text-gray-900 dark:text-gray-100 whitespace-nowrap">
                                {{ $rsvp->guests }} {{ Str::plural('guest', $rsvp->guests) }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-4 py-6 text-center text-gray-500 dark:text-gray-400">
                                No RSVPs yet
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
