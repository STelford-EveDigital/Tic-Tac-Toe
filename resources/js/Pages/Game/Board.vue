<script setup>
import { Head, router } from '@inertiajs/vue3';
import PageLink from '@/Components/PageLink.vue';
import BoardGrid from '@/Components/BoardGrid.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

defineProps({
    game: {
        type: Object,
        required: true,
    },
    player: {
        type: String,
        required: true
    },
    submissionRoute: {
        type: String,
        required: true
    }
});

function back() {
    router.get('/dashboard');
}
</script>

<template>
    <Head title="Home" />
    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
        <img
            id="background"
            class="absolute -left-20 top-0 max-w-[877px]"
            src="https://laravel.com/assets/img/welcome/background.svg"
        />
        <div
            class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white"
        >
            <div class="relative w-full max-w-2xl px-6">
                <main>
                    <div class="space-y-4 p-6 bg-white rounded-md shadow border">
                        <div class="flex justify-center">
                            <div class="grid grid-cols-3">
                                <BoardGrid v-for="section, key in game.board" 
                                    :section="key"
                                    :sectionValue="section"
                                    :player="player"
                                    :currentTurn="game.current_turn"
                                    :submissionRoute="submissionRoute"
                                />
                            </div>
                        </div>

                        <p class="text-left">
                            Current Turn: <span class="capitalize" v-text="game.current_turn"></span>
                        </p>
                        <SecondaryButton @click="back">Back</SecondaryButton>
                    </div>
                </main>
            </div>
        </div>
    </div>
</template>
