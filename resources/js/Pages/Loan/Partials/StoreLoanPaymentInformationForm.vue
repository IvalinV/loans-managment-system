<script setup>
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
defineProps({

});

const loans = usePage().props.loans;
const message = usePage().props.flash.message;

const form = useForm({
    loan_id: null,
    amount: null,
});

const storePayment = () => {
    form.post(route('loan.payment.store'), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
            if (form.errors.loan_id) {
                form.reset('loan_id');
                loan_id.value.focus();
            }
            if (form.errors.amount) {
                form.reset('amount');
                amount.value.focus();
            }
        },
    });
};
</script>

<template>
     <Head title="Loan" />
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Loan Information</h2>

            <p class="mt-1 text-sm text-gray-600">
                Create new payment for a loan
            </p>
        </header>

        <form @submit.prevent="storePayment" class="mt-6 space-y-6">
            <div>
                <InputLabel for="loan" value="Loan" />

                <select
                    id="loan"
                    class="mt-1 block w-full"
                    v-model="form.loan_id"
                    required
                    autofocus
                    autocomplete="name"
                >
                    <option v-for="(loan, index) in loans.data" :key="index" :value="loan.id">{{loan.uuid}}</option>
                </select>

                <InputError class="mt-2" :message="form.errors.loan_id" />
            </div>

            <div>
                <InputLabel for="amount" value="Amount" />

                <TextInput
                    id="amount"
                    type="number"
                    class="mt-1 block w-full"
                    v-model="form.amount"
                    required
                    autocomplete="amount"
                />

                <InputError class="mt-2" :message="form.errors.amount" />
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Create</PrimaryButton>

                <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                    <p v-if="message" class="text-sm text-gray-600">{{message}}</p>
                </Transition>
            </div>
        </form>
    </section>
</template>