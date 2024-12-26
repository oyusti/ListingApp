<script setup>
import Container from '../../components/Container.vue';
import InputField from '../../components/InputField.vue';
import BtnPrimary from '../../components/BtnPrimary.vue';
import ErrorMessages from '../../components/ErrorMessages.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    token : String,
    email : String
})

const form = useForm({
    token : props.token,
    email : props.email,
    password : "",
    password_confirmation : ""
})

const submit = () => {
    form.post(route("password.update"),{
        onFinish: () => form.reset("password", "password_confirmation"),
    });
}

</script>

<template>
    <Head title="- Reset Password"/>
    <Container class=" w-1/2">

        <div class=" mb-8 text-center">
            <title>
                Reset your Password
            </title>
        </div>

        <!-- Errors  -->
         <ErrorMessages :errors="form.errors"/>

        <form @submit.prevent="submit" class="space-y-6">
            <InputField label="Email" icon="envelope" placeholder="Enter your email" v-model="form.email" />
            <InputField label="Password" icon="lock" placeholder="Enter your password" type="password" v-model="form.password" />
            <InputField label="Confirm Password" icon="lock" placeholder="Enter your password" type="password" v-model="form.password_confirmation" />

            <BtnPrimary :disabled="form.processing" class=" w-full">
                Reset Password
            </BtnPrimary>
        </form>

    </Container>
</template>