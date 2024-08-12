<script setup>

import {Link} from "@inertiajs/vue3";
</script>

<template>
    <main class=" mt-6 flex gap-4">

        <Link
            :href="route('company.index')"
            class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
            <i class='bx bx-buildings text-5xl text-gray-900'></i>
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 ">Empresas</h5>
            <p class="font-normal text-gray-700">Faça o cadastro de suas empresas</p>
        </Link>
        <Link
            :href="route('contact.index')"
            class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
            <i class='bx bxs-contact text-5xl text-gray-900'></i>
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 ">Contatos</h5>
            <p class="font-normal text-gray-700">Faça o cadastro de seus contatos</p>
        </Link>
    </main>
</template>

<style scoped>

</style>
