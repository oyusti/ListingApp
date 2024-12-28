<script setup>
import Container from '../../../components/Container.vue';
import Title from '../../../components/Title.vue';
import InputField from '../../../components/InputField.vue';
import BtnPrimary from '../../../components/BtnPrimary.vue';
import ErrorMessages  from '../../../components/ErrorMessages.vue';
import SessionMessages from '../../../components/SessionMessages.vue';
import { router, useForm } from '@inertiajs/vue3';

const props = defineProps({
        user: Object,
        status: String,
    });

const form = useForm({
    name: props.user.name,
    email: props.user.email,
});

const resendEmail = (e) => {
    router.post(route('verification.send'),{},{
        onStart: () => e.target.disabled = true,
        onFinish: () => e.target.disabled = false,
    });
};
</script>

<template>
    <Container class=" mb-6">

        <div class=" mb-6">
            <Title>Update Information</Title>
            <p>
                Update your profile information. You can update your name and email
            </p>
        </div>

        <errorMessages :errors="form.errors" />

        <form class=" space-y-6" @submit.prevent="form.patch(route('profile.info'))">
            <InputField label="Name" icon="id-badge" class=" w-1/2" placeholder="Enter your name" v-model="form.name" />
            <InputField label="Email" icon="at" class=" w-1/2" placeholder="Enter your email" v-model="form.email" />

            <div v-if="user.email_verified_at === null" class=" bg-red-100 text-red-700 p-4 rounded">

                <SessionMessages :status="status" />

                <p>Your email address is unverified
                    <button 
                        @click="resendEmail" 
                        class="text-indigo-500 hover:text-indigo-600 font-medium underline dark:text-indigo-400 dark:hover:text-indigo-500
                        disabled:text-slate-400 disabled:cursor-wait"
                    >
                        Click here to resend verification email
                    </button>
                </p>
                
            </div>

            <BtnPrimary :disabled="form.processing">Save</BtnPrimary>

        </form>

    </Container>
</template>