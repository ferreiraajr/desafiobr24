<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import {router, useForm} from "@inertiajs/vue3";
import InputLabel from "@/Components/InputLabel.vue";

const form = useForm({
    title: '',
    email: '',

});
const submit = () => {
    router.post('/company/store', form,{
        onSuccess: () => closeModal(),
    })
};
</script>

<template>
    <div class="p-6">
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
                    Cadastrar
                </PrimaryButton>
            </div>
        </form>
    </div>
</template>

<style scoped>

</style>
