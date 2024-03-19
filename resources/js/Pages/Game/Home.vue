<script setup>
import { Head, useForm, router } from '@inertiajs/vue3';
import PageLink from '@/Components/PageLink.vue';
import Modal from '@/Components/Modal.vue';
import { ref, reactive } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const props = defineProps({
    roomRoute: {
        type: String,
        required: true,
    },
});
const modal = ref(false);
const form = reactive({
    roomCode: '',
});

const openModal = () => {
    modal.value = true;
}
function submit() {
    router.post(props.roomRoute, form);
}
const closeModal = () => {
    modal.value = false;

    form.reset();
};
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
                    <div class="flex flex-col items-center space-y-4 p-6 bg-white rounded-md shadow border">
                        <PageLink :href="route('game.create')">
                            Create Game
                        </PageLink>
                        <Button @click="openModal">Join Game</Button>

                        <Modal :show="modal" @close="closeModal">
                            <div class="p-6">
                                <h2 class="text-lg font-medium text-gray-900">
                                    Join Room?
                                </h2>

                                <p class="mt-1 text-sm text-gray-600">
                                    Enter the 6 character room code below. <br>
                                    Please note only two players can join a room.
                                </p>

                                <div class="mt-6">
                                    <InputLabel for="roomCode" value="Room Code" class="sr-only" />

                                    <TextInput
                                        id="roomCode"
                                        ref="roomCode"
                                        v-model="form.roomCode"
                                        type="text"
                                        class="mt-1 block w-3/4"
                                        placeholder="XXXXXX"
                                        @keyup.enter="submit"
                                    />
                                </div>

                                <div class="mt-6 flex justify-end">
                                    <SecondaryButton @click="closeModal"> Cancel </SecondaryButton>

                                    <PrimaryButton
                                        class="ms-3"
                                        :class="{ 'opacity-25': form.processing }"
                                        :disabled="form.processing"
                                        @click="submit"
                                    >
                                        Join Room
                                    </PrimaryButton>
                                </div>
                            </div>
                        </Modal>
                    </div>
                </main>
            </div>
        </div>
    </div>
</template>
