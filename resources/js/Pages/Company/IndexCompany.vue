<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Modal from "@/Components/Modal.vue";
import {ref} from "vue";
import CreateCompany from "@/Pages/Company/Partials/CreateCompany.vue";
import DangerButton from "@/Components/DangerButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import {router} from "@inertiajs/vue3";
import EditCompany from "@/Pages/Company/Partials/EditCompany.vue";
import Menu from "@/Components/Menu.vue";


defineProps({
    companies: Object
});

const confirmingCompanyDeletion = ref(false);
const confirmingCompanyEdit = ref(false);
const companyIdToDelete = ref(null);
const companyToEdit = ref(null);

const showDeleteModal = (id) => {
    companyIdToDelete.value = id;
    confirmingCompanyDeletion.value = true;
};
const showEditModal = (company) => {
    companyToEdit.value = company;
    confirmingCompanyEdit.value = true;
    console.log(company);
};

const deleteCompany = () => {
    if (companyIdToDelete.value) {
        router.delete(`/company/destroy/${companyIdToDelete.value}`, {
            onSuccess: () => closeModal(),
        })
    }
};

const confirmingCompanyCreate = ref(false);

const confirmCompanyCreate = () => {
    confirmingCompanyCreate.value = true;
};

const closeModal = () => {
    confirmingCompanyCreate.value = false;
    confirmingCompanyDeletion.value = false;
    confirmingCompanyEdit.value = false;
    companyIdToDelete.value = null;
    companyToEdit.value = null;

};


</script>

<template>
    <div class="flex flex-col items-center justify-center">
        <Menu></Menu>
    </div>
    <div class="p-4 sm:p-8  shadow sm:rounded-lg">
        <div class="flex justify-between">
            <div class="text-left text-black">Empresas</div>
            <div class="flex space-x-4">
                <div class="flex ">
                </div>
                <PrimaryButton @click="confirmCompanyCreate">Adicionar</PrimaryButton>
                <Modal :show="confirmingCompanyCreate" @close="closeModal">
                    <div class="p-6">
                        <CreateCompany></CreateCompany>
                    </div>
                </Modal>
            </div>
        </div>

        <div class="flex w-full pt-2">
            <div class="relative overflow-x-auto w-full shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-center rtl:text-right text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-black/50">ID</th>
                        <th scope="col" class="px-8 py-4 text-black/50">Nome</th>
                        <th scope="col" class="px-4 py-4 text-black/50">AÇÃO</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="company in companies" class="bg-white border-b hover:bg-gray-50">
                        <td class="text-center px-6 py-4 font-medium  text-black-900">
                                {{ company.ID }}
                        </td>
                        <td class="text-center px-6 py-4  text-black-900">{{ company.TITLE }}</td>
                        <td class="text-center px-6 py-4  text-black-900">
                            <div class="justify-between ">
                                <button
                                    class="inline-flex items-center px-2 py-1 bg-blue-800 hover:bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white  uppercase tracking-widest  focus:bg-green-700  active:bg-green-800  focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2  transition ease-in-out duration-150 mr-0.5"
                                    @click="showEditModal(company)">
                                    <i class='bx bx-show text-base'></i>
                                </button>
                                <button
                                    class="inline-flex items-center px-2 py-1 bg-green-800 hover:bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white  uppercase tracking-widest  focus:bg-green-700  active:bg-green-800  focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2  transition ease-in-out duration-150 mr-0.5"
                                    @click="showEditModal(company)">
                                    <i class='bx bxs-edit-alt text-base'></i>
                                </button>
                                <button
                                    class="inline-flex items-center px-2 py-1 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500  focus:bg-red-700  active:bg-red-800  focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150 mr-0.5"
                                    @click="showDeleteModal(company.ID)">
                                    <i class='bx bxs-trash-alt text-base'></i>
                                </button>
                                <Modal :show="confirmingCompanyDeletion" @close="closeModal">
                                    <div class="p-6">
                                        <h2 class="text-lg font-medium text-gray-900">
                                            Você deseja remover essa empresa ?
                                        </h2>


                                        <div class="mt-6 flex justify-end">
                                            <SecondaryButton @click="closeModal"> Cancel</SecondaryButton>

                                            <DangerButton
                                                class="ms-3"
                                                @click="deleteCompany"
                                            >
                                                Remover Empresa
                                            </DangerButton>
                                        </div>
                                    </div>
                                </Modal>
                                <Modal :show="confirmingCompanyEdit" @close="closeModal">
                                    <div class="p-6">
                                        <EditCompany :company="companyToEdit" @close="closeModal"></EditCompany>
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
