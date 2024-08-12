<script setup>

import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import {router, useForm} from "@inertiajs/vue3";
import Checkbox from "@/Components/Checkbox.vue";

const props = defineProps({
    contact: Object
});

const form = useForm({
    name: props.contact.NAME || '',
    last_name: props.contact.LAST_NAME || '',

});
const emit = defineEmits(['close']);
const submit = () => {
    router.put(`/contact/update/${props.contact.ID}`, form, {
        onSuccess: () => emit('close'),
    });
}
</script>

<template>
    <form @submit.prevent="submit">
        <div class="flex flex-col gap-4">
            <div>
                <InputLabel for="name" value="Name"/>
                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />
                <InputError class="mt-2" :message="form.errors.name"/>
            </div>

            <div>
                <InputLabel for="last_name" value="Last Name"/>
                <TextInput
                    id="last_name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.last_name"
                    required
                    autofocus
                    autocomplete="last_name"
                />
                <InputError class="mt-2" :message="form.errors.last_name"/>
            </div>


            <div>
                <InputLabel for="companies" value="Companies"/>
                <div v-for="company in companies" :key="company.ID" class="flex items-center">
                    <label class="flex items-center">
                        <Checkbox
                            :id="`company_${company.ID}`"
                            :value="company.ID"
                            v-model:checked="form.selectedCompanies" />
                        <span class="ms-2 text-sm text-gray-600">{{ company.TITLE }}</span>
                    </label>
                    <InputError class="mt-2" :message="form.errors.selectedCompanies"/>
                </div>

            </div>

        </div>

        <div class="flex items-center justify-end mt-4">
            <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Cadastrar
            </PrimaryButton>
        </div>
    </form>
</template>

<style scoped>

</style>
