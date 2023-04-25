<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Table } from "@protonemedia/inertiajs-tables-laravel-query-builder";

defineProps(["user"])
</script>

<template>
    <Head title="Users" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Show Users
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white p-5 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg w-fit mx-auto flex flex-wrap sm:flex-nowrap gap-10">
                    <div class="p-6 bg-white border-b border-gray-200 border border-solid border-r !pr-10 sm:w-fit w-full">
                         <h3 class="text-3xl font-bold my-5">Dados do Usuário</h3>
                         <div class="user_description mb-10">
                            <p><strong>Nome:</strong> {{ user.name }}</p>
                            <p><strong>Email:</strong> {{ user.email }}</p>
                            <p><strong>Telefone:</strong> {{ user.phone }}</p>
                            <p><strong>Tipo:</strong> {{ user.type }}</p>
                         </div>
                    </div>
                    <div class="p-6 bg-white border-b border-gray-20">
                        <h3 class="text-3xl font-bold my-5">Perguntas</h3>
                        <div class="questions_item mb-5" v-for="question in user.questions">
                            <h4 class="text-xl font-bold">{{ question.question }}</h4>
                            <p>{{ question.answer }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
