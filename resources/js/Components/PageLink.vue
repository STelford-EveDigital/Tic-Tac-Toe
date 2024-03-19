<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
});
const classes = 'border-b-2 border-transparent font-medium leading-5 text-gray-500 hover:text-sky-700 hover:border-sky-300 focus:outline-none transition duration-150 ease-in-out';

</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
