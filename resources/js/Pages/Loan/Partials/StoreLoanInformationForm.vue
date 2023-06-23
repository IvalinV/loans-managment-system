<script setup>
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
defineProps({

});

const user = usePage().props.auth.user;
const message = usePage().props.flash.message;

const form = useForm({
    name: user.name,
    total_amount: null,
    deadline: 1
});
</script>

<template>
     <Head title="Loan" />
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Loan Information</h2>

            <p class="mt-1 text-sm text-gray-600">
                Create new loan
            </p>
        </header>

        <form @submit.prevent="form.post(route('loan.store'))" class="mt-6 space-y-6">
            <div>
                <InputLabel for="name" value="Name" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div>
                <InputLabel for="amount" value="Amount" />

                <TextInput
                    id="amount"
                    type="number"
                    class="mt-1 block w-full"
                    v-model="form.total_amount"
                    required
                    autocomplete="total_amount"
                />

                <InputError class="mt-2" :message="form.errors.total_amount" />
            </div>
            <div>
                <InputLabel for="deadline" value="Deadline in months" />

                <TextInput
                    id="deadline"
                    type="number"
                    class="mt-1 block w-full"
                    v-model="form.deadline"
                    required
                    min="1"
                    max="12"
                    autocomplete="deadline"
                />

                <InputError class="mt-2" :message="form.errors.deadline" />
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