<script setup>
import Container from '../../components/Container.vue';
import BtnPrimary from '../../components/BtnPrimary.vue';
import { useForm } from '@inertiajs/vue3';
import SessionMessages from '../../components/SessionMessages.vue';

const form = useForm({});

defineProps({
    status: String,
});

const submit = () => {
    form.post(route('verification.send'));
};

</script>

<template>
    <Head title="- Email Verification" />

    <Container>
        <div class="flex justify-center">
            <div class="w-full lg:w-1/2">
                    <h1 class="text-2xl font-bold mb-6">Verify Email</h1>
                    <div class="mb-4 text-sm">
                        Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.
                    </div>

                    <SessionMessages :status="status" />

                    <div class="mb-6">
                        <form @submit.prevent="submit">
                            <div>
                                <BtnPrimary :disabled="form.processing">
                                    Resend Verification Email
                                </BtnPrimary>
                            </div>
                        </form>
                    </div>
                
            </div>
        </div>
    </Container>
</template>