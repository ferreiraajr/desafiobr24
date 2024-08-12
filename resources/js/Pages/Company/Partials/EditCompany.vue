<script setup>

import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import {router, useForm} from "@inertiajs/vue3";

const props = defineProps({
    company: Object
});

const form = useForm({
    title: props.company.TITLE || '',
    email: props.company.EMAIL || '',

});
const emit = defineEmits(['close']);
const submit = () => {
    router.put(`/company/update/${props.company.ID}`, form, {
        onSuccess: () => emit('close'),
    });
}
</script>

<template>
    <form @submit.prevent="submit">
        <div>
            <InputLabel for="title" value="Nome"/>
            <TextInput
                id="title"
                type="text"
                class="mt-1 block w-full"
                v-model="form.title"
                required
                autofocus
                autocomplete="title"
            />
            <InputError class="mt-2" :message="form.errors.title"/>

            <InputLabel for="email" value="Email"/>
            <TextInput
                id="email"
                type="email"
                class="mt-1 block w-full"
                v-model="form.email"
                required
                autofocus
                autocomplete="email"
            />
            <InputError class="mt-2" :message="form.errors.email"/>


        </div>

        <div class="flex items-center justify-end mt-4">
            <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Salvar
            </PrimaryButton>
        </div>
    </form>
</template>

<style scoped>

</style>
