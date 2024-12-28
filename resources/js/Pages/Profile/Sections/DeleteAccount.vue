<script setup>
import Container from '../../../components/Container.vue';
import Title from '../../../components/Title.vue';
import InputField from '../../../components/InputField.vue';
import BtnPrimary from '../../../components/BtnPrimary.vue';
import ErrorMessages  from '../../../components/ErrorMessages.vue';
import { useForm } from '@inertiajs/vue3';
import BtnCancel from '../../../components/BtnCancel.vue';
import { ref } from 'vue';

const showConfirmPassword= ref(false);

const form = useForm({
    password: '',
});

const submit = () => {
    form.delete(route('profile.destroy'),{
        onFinish: () => form.reset(),
        preserveScroll: true,
    });
};


</script>

<template>
    <Container class=" mb-6">

        <div class=" mb-6">
            <Title>Delete Account</Title>
            <p>
                Once you delete your account, there is no going back. Please be certain.
            </p>
        </div>

        <errorMessages :errors="form.errors" />

        <div v-if="showConfirmPassword">
            <form class=" flex items-end gap-4" @submit.prevent="submit">
                <InputField label="Confirm Password" type="password" icon="id-badge" class=" w-1/2" placeholder="Enter your password" v-model="form.password" />

                <div class=" space-x-2">
                    <BtnPrimary :disabled="form.processing">Confirm</BtnPrimary>

                    <button class=" px-6 py-2 rounded-lg bg-gray-200 text-gray-700" 
                    @click="showConfirmPassword = false"
                    >
                        Cancel
                    </button>
                </div>
            </form>
        </div>

        <button 
        v-if="!showConfirmPassword"
        class="px-6 py-2 rounded-lg bg-red-600 text-white disable:bg-red-300 disabled:cursor-wait"
        @click="showConfirmPassword = true"> 
            <i class="fa-solid fa-triangle-exclamation mr2"></i>         
            Delete Account 
        </button>

    </Container>
</template>