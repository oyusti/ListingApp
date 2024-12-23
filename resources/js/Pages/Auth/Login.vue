<script setup>
    import Container from '../../components/Container.vue';
    import Title from '../../components/Title.vue';
    import TextLink from '../../components/TextLink.vue';
    import InputField from '../../components/InputField.vue';
    import BtnPrimary from '../../components/BtnPrimary.vue';
    import ErrorMessages from '../../components/ErrorMessages.vue';
    import CheckBox from '../../components/CheckBox.vue'; 
    import { useForm } from '@inertiajs/vue3';

    const form = useForm({
        email : "",
        password : "",
        remember: null
    })

    const submit = () => {
        form.post(route("login"),{
            onFinish: () => form.reset("password"),
        });
    }
</script>

<template>
    <Head title="- Login"/>
    <Container class=" w-1/2">

        <div class=" mb-8 text-center">
            <Title>
                Login to your Account
            </Title>
            <p>
                Need an account?
                <TextLink routeName="register" label="Register"/>
            </p>
        </div>

        <!-- Errors  -->
         <ErrorMessages :errors="form.errors">

         </ErrorMessages>

        <form @submit.prevent="submit" class="space-y-6">
            <InputField label="Email" icon="envelope" placeholder="Enter your email" v-model="form.email" />
            <InputField label="Password" icon="lock" placeholder="Enter your password" type="password" v-model="form.password" />
    
            <p class=" text-slate-500 text-sm dark:text-slate-400">
                By creating an account, your agree to our terms of Service and Privacy Policy
            </p>

            <div class="flex items-center justify-between">

                <CheckBox name="remember" v-model="form.remember">
                    Remember me
                </CheckBox>

                <TextLink routeName="home" label="Forgot Password?"/>

            </div>

            <BtnPrimary :disabled="form.processing" class=" w-full">
                Login
            </BtnPrimary>
        </form>

    </Container>
</template>