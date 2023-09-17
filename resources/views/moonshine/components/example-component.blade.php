<h1 class="mb-6 truncate text-md font-medium">
    {{ $element->label() }}
</h1>

<x-moonshine::table>
    <x-slot:tbody x-data="fetchUsers">
        <tr>
            <td x-show="users.length === 0"><x-moonshine::loader /></td>
        </tr>

        <template x-for="user in users" :key="user.id">
            <tr>
                <td x-text="user.email"></td>
            </tr>
        </template>
    
    </x-slot:tbody>
</x-moonshine::table>
