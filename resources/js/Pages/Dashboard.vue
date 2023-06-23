<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';
import { onMounted, toRaw } from 'vue';

const loans = usePage().props.loans;
onMounted(() => {
})
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Loans</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> -->
                    <table cclass="w-max divide-y divide-white border">
                        <thead class="border border-gray-200">
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left border">
                                    <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Holder Name</span>
                                </th>
                                <th class="px-6 py-3 bg-gray-50 text-left border">
                                    <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Total Amount</span>
                                </th>
                                <th class="px-6 py-3 bg-gray-50 text-left border">
                                    <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Deadline</span>
                                </th>
                                <th class="px-6 py-3 bg-gray-50 text-left border">
                                    <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Мonthly installment</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="border border-grey-800">
                            <tr v-for="(loan, index) in loans.data" :key="index">
                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900 border">{{ loan.holder }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900 border">{{ loan.total_amount }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900 border">{{ loan.deadline }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900 border">{{ loan.monthly_installment }}</td>
                            </tr>
                        </tbody>
                    </table>
                <!-- </div> -->
            </div>
        </div>
    </AuthenticatedLayout>
</template>
