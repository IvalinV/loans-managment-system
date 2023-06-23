<script setup>

import { Link, useForm, usePage } from '@inertiajs/vue3';
import { Head } from '@inertiajs/vue3';
import StoreLoanInformationForm from './Partials/StoreLoanInformationForm.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';


defineProps({

});

</script>

<template>
     <Head title="Profile" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Loan</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <StoreLoanInformationForm
                        class="max-w-xl"
                    />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>