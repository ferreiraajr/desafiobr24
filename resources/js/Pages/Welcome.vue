<script setup>
import { Head, Link } from '@inertiajs/vue3';
import Menu from "@/Components/Menu.vue";

</script>

<template>
    <Head title="Welcome" />
    <div class="text-black/50">
        <div
            class=" flex flex-col items-center justify-center selection:text-white"
        >
            <Menu></Menu>

        </div>
    </div>
</template>
