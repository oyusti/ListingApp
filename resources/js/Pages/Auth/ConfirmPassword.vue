<script setup>
    import Container from '../../components/Container.vue';
    import InputField from '../../components/InputField.vue';
    import BtnPrimary from '../../components/BtnPrimary.vue';
    import ErrorMessages from '../../components/ErrorMessages.vue'; 
    import { useForm } from '@inertiajs/vue3';

    const form = useForm({
        password : "",
    })

    const submit = () => {
        form.post(route("password.confirm"),{
            onFinish: () => form.reset(),
        });
    }
</script>

<template>
    <Head title="- Password Confirmation"/>
    <Container class=" w-1/2">

        <div class=" mb-8 text-center">
            <p>
                This is a secure area of the application. Please confirm your password before continuing.
            </p>
        </div>

        <!-- Errors  -->
         <ErrorMessages :errors="form.errors"/>

        <form @submit.prevent="submit" class="space-y-6">
            
            <InputField label="Password" icon="lock" placeholder="Enter your password" type="password" v-model="form.password" />

            <BtnPrimary :disabled="form.processing" class=" w-full">
                Confirm
            </BtnPrimary>
        </form>

    </Container>
</template>