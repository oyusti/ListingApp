<script setup>
    import Container from '../../components/Container.vue';
    import Title from '../../components/Title.vue';
    import TextLink from '../../components/TextLink.vue';
    import InputField from '../../components/InputField.vue';
    import BtnPrimary from '../../components/BtnPrimary.vue';
    import ErrorMessages from '../../components/ErrorMessages.vue';
    import { useForm } from '@inertiajs/vue3';

    const form = useForm({
        name : "",
        email : "",
        password : "",
        password_confirmation : "",
    })

    const submit = () => {
        form.post(route("register"),{
            onFinish: () => form.reset("password", "password_confirmation"),
        });
    }
</script>

<template>
    <Container class=" w-1/2">

        <div class=" mb-8 text-center">
            <Title>
                Register a new Acoount
            </Title>
            <p>
                Already have an account?
                <TextLink routeName="home" label="login"/>
            </p>
        </div>

        <!-- Errors  -->
         <ErrorMessages :errors="form.errors">

         </ErrorMessages>

        <form @submit.prevent="submit" class="space-y-6">
            <InputField label="Name" icon="user" placeholder="Enter your name" v-model="form.name" />
            <InputField label="Email" icon="envelope" placeholder="Enter your email" v-model="form.email" />
            <InputField label="Password" icon="lock" placeholder="Enter your password" type="password" v-model="form.password" />
            <InputField label="Confirm Password" icon="lock" placeholder="Confirm your password" type="password" v-model="form.password_confirmation" />

            <p class=" text-slate-500 text-sm dark:text-slate-400">
                By creating an account, your agree to our terms of Service and Privacy Policy
            </p>

            <BtnPrimary :disabled="form.processing" class=" w-full">
                Register
            </BtnPrimary>
        </form>

    </Container>
</template>