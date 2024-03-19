<script setup>
import { computed, reactive } from 'vue';
import { Link, router } from '@inertiajs/vue3';

const props = defineProps({
    currentTurn: {
        type: String,
        required: true,
    },
    player: {
        type: String,
        required: true
    },
    section: {
        type: String,
        required: true
    },
    sectionValue: {
        type: String,
    },
    submissionRoute: {
        type: String
    }
});

const newTurn = computed(() =>
    props.player == 'crosses'
        ? 'flex items-center justify-center h-full w-full cursor-pointer text-4xl font-bold text-transparent hover:text-sky-500 transition duration-500 ease-in-out'
        : 'flex items-center justify-center h-full w-full cursor-pointer text-4xl font-bold text-transparent hover:text-green-500 transition duration-500 ease-in-out'
);

const placedTurn = computed(() => 
    props.sectionValue == 'x'
        ? 'flex items-center justify-center h-full w-full cursor-pointer text-4xl font-bold text-sky-500'
        : 'flex items-center justify-center h-full w-full cursor-pointer text-4xl font-bold text-green-500'
)

const form = reactive({
    boardSection: props.section,
    value: props.player == 'crosses' ? 'x' : 'o'
});

function submit() {
    router.post(props.submissionRoute, form);
}

</script>
<template>
    <div class="flex justify-center items-center h-32 w-32 border ">
        <div v-if="sectionValue != ''">
            <span :class="placedTurn" v-text="sectionValue"></span>
        </div>

        <form 
            v-if="currentTurn == player && sectionValue == ''"
            @submit.prevent="submit" 
            class="h-full w-full"
        >
            <input id="value" :value="player" class="hidden"/>
            <button :class="newTurn" type="submit" v-text="player == 'crosses' ? 'X' : '0'"></button>
        </form>
    </div>
</template>
