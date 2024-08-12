<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Modal from "@/Components/Modal.vue";
import {ref} from "vue";
import DangerButton from "@/Components/DangerButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import {router} from "@inertiajs/vue3";
import Menu from "@/Components/Menu.vue";
import CreateContact from "@/Pages/Contact/Partials/CreateContact.vue";
import EditContact from "@/Pages/Contact/Partials/EditContact.vue";


defineProps({
    contacts: Object,
    companies: Object
});

const confirmingContactDeletion = ref(false);
const confirmingContactEdit = ref(false);
const contactIdToDelete = ref(null);
const contactToEdit = ref(null);

const showDeleteModal = (id) => {
    contactIdToDelete.value = id;
    confirmingContactDeletion.value = true;
};
const showEditModal = (contact) => {
    contactToEdit.value = contact;
    confirmingContactEdit.value = true;
};

const deleteContact = () => {
    if (contactIdToDelete.value) {
        router.delete(`/contact/destroy/${contactIdToDelete.value}`, {
            onSuccess: () => closeModal(),
        })
    }
};

const confirmingContactCreate = ref(false);

const confirmCompanyCreate = () => {
    confirmingContactCreate.value = true;
};

const closeModal = () => {
    confirmingContactCreate.value = false;
    confirmingContactDeletion.value = false;
    confirmingContactEdit.value = false;
    contactIdToDelete.value = null;
    contactToEdit.value = null;

};


</script>

<template>
    <div class="flex flex-col items-center justify-center">
    <Menu></Menu>
    </div>
    <div class="p-4 sm:p-8  shadow sm:rounded-lg">
        <div class="flex justify-between">
            <div class="text-left text-black">Contatos</div>
            <div class="flex space-x-4">
                <div class="flex ">
                </div>
                <PrimaryButton @click="confirmCompanyCreate">Adicionar</PrimaryButton>
                <Modal :show="confirmingContactCreate" @close="closeModal">
                    <div class="p-6">
                        <CreateContact :companies="companies"></CreateContact>
                    </div>
                </Modal>
            </div>
        </div>

        <div class="flex w-full pt-2">
            <div class="relative overflow-x-auto w-full shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-center rtl:text-right text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                    <tr>
                        <th scope="col" class="px-3 py-4 text-black/50">ID</th>
                        <th scope="col" class="px-5 py-4 text-black/50">NAME</th>
                        <th scope="col" class="px-4 py-4 text-black/50">LAST NAME</th>
                        <th scope="col" class="px-4 py-4 text-black/50">AÇÃO</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="contact in contacts" class="bg-white border-b hover:bg-gray-50">
                        <td class="text-center px-6 py-4 font-medium  text-black-900">
                                {{ contact.ID }}
                        </td>
                        <td class="text-center px-6 py-4  text-black-900">{{ contact.NAME }}</td>
                        <td class="text-center px-6 py-4  text-black-900">{{ contact.LAST_NAME }}</td>
                        <td class="text-center px-6 py-4  text-black-900">
                            <div class="justify-between ">
                                <button
                                    class="inline-flex items-center px-2 py-1 bg-blue-800 hover:bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white  uppercase tracking-widest  focus:bg-green-700  active:bg-green-800  focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2  transition ease-in-out duration-150 mr-0.5"
                                    @click="showEditModal(contact)">
                                    <i class='bx bx-show text-base'></i>
                                </button>
                                <button
                                    class="inline-flex items-center px-2 py-1 bg-green-800 hover:bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white  uppercase tracking-widest  focus:bg-green-700  active:bg-green-800  focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2  transition ease-in-out duration-150 mr-0.5"
                                    @click="showEditModal(contact)">
                                    <i class='bx bxs-edit-alt text-base'></i>
                                </button>
                                <button
                                    class="inline-flex items-center px-2 py-1 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500  focus:bg-red-700  active:bg-red-800  focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150 mr-0.5"
                                    @click="showDeleteModal(contact.ID)">
                                    <i class='bx bxs-trash-alt text-base'></i>
                                </button>
                                <Modal :show="confirmingContactDeletion" @close="closeModal">
                                    <div class="p-6">
                                        <h2 class="text-lg font-medium text-gray-900">
                                            Você deseja remover esse contato ?
                                        </h2>


                                        <div class="mt-6 flex justify-end">
                                            <SecondaryButton @click="closeModal"> Cancelar</SecondaryButton>

                                            <DangerButton
                                                class="ms-3"
                                                @click="deleteContact"
                                            >
                                                Remover Contato
                                            </DangerButton>
                                        </div>
                                    </div>
                                </Modal>
                                <Modal :show="confirmingContactEdit" @close="closeModal">
                                    <div class="p-6">
                                        <EditContact :contact="contactToEdit" @close="closeModal"></EditContact>
                                    </div>
                                </Modal>
                            </div>

                        </td>
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
