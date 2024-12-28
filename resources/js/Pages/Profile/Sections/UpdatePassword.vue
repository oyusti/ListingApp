<script setup>
import Container from '../../../components/Container.vue';
import Title from '../../../components/Title.vue';
import InputField from '../../../components/InputField.vue';
import BtnPrimary from '../../../components/BtnPrimary.vue';
import ErrorMessages  from '../../../components/ErrorMessages.vue';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    current_password:'',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.put(route('profile.password'),{
        onSuccess: () => form.reset(),
        onError: () => form.reset(),
        preserveScroll: true,
    });
};

</script>

<template>
    <Container class=" mb-6">

        <div class=" mb-6">
            <Title>Update Password</Title>
            <p>
                Ensure your account is using a long, random password to stay secure.
            </p>
        </div>

        <errorMessages :errors="form.errors" />

        <form class=" space-y-6" @submit.prevent="submit">
            <InputField label="Currrent Password" type="password" icon="key" class=" w-1/2" placeholder="Enter your current password" v-model="form.current_password" />
            <InputField label="New Password" type="password" icon="key" class=" w-1/2" placeholder="Enter your new password" v-model="form.password" />
            <InputField label="Confirm Password" type="password" icon="key" class=" w-1/2" placeholder="Enter the same new password" v-model="form.password_confirmation" />
            
            <p v-if="form.recentlySuccessful" class=" text-green-500 font-medium">Saved!</p>

            <BtnPrimary :disabled="form.processing">Save</BtnPrimary>

        </form>

    </Container>
</template>