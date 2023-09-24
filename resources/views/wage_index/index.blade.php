<h1 class="mb-6 truncate text-md font-medium">
    Wage Index Custom Table
</h1>

<x-moonshine::table
    :columns="[
        '#', 'First', 'Last', 'Email'
    ]"
    :values="[
        [1, fake()->firstName(), fake()->lastName(), fake()->safeEmail()],
        [2, fake()->firstName(), fake()->lastName(), fake()->safeEmail()],
        [3, fake()->firstName(), fake()->lastName(), fake()->safeEmail()]
    ]"
/>
