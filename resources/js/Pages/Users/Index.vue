<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
// import { Head } from '@inertiajs/inertia-vue3';
import { Head } from '@inertiajs/vue3';
import { Table } from "@protonemedia/inertiajs-tables-laravel-query-builder";

defineProps(["users"])
</script>

<template>
    <Head title="Users" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Users
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                         <h3 class="text-2xl text-center">Lista de Usuarios</h3>
                         <Table :resource="users">
                            <template #cell(actions)="{ item: user }">
                                <a :href="`/users/${user.id}`" class="rounded-lg bg-blue-500 text-white py-2 px-4">
                                    Abrir
                                </a>
                            </template>
                        </Table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
