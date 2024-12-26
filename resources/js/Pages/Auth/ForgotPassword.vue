<script setup>
    import Container from '../../components/Container.vue';
    import InputField from '../../components/InputField.vue';
    import BtnPrimary from '../../components/BtnPrimary.vue';
    import ErrorMessages from '../../components/ErrorMessages.vue'; 
    import SessionMessages from '../../components/SessionMessages.vue';
    import { useForm } from '@inertiajs/vue3';

    const form = useForm({
        email : "",
    })

    defineProps({
        status: String
    })

    const submit = () => {
        form.post(route("password.email"));
    }
</script>

<template>
    <Head title="- Forgot Password"/>
    <Container class=" w-1/2">

        <div class=" mb-8 text-center">
            <p>
                Forgot your password? No problem. Just let us know your email address and we will you a password redet link taht will 
                allow you to choose a new one
            </p>
        </div>

        <!-- Errors  -->
         <ErrorMessages :errors="form.errors"/>

         <SessionMessages :status="status"/>
         

        <form @submit.prevent="submit" class="space-y-6">
            <InputField label="Email" icon="envelope" placeholder="Enter your email" v-model="form.email" />

            <BtnPrimary :disabled="form.processing" class=" w-full">
                Send Password Reset Link
            </BtnPrimary>
        </form>

    </Container>
</template>