<script setup>
    import Container from '../../components/Container.vue';
    import Title from '../../components/Title.vue';
    import TextLink from '../../components/TextLink.vue';
    import InputField from '../../components/InputField.vue';
    import TextArea from '../../components/TextArea.vue';
    import ImageUpload from '../../components/ImageUpload.vue';
    import BtnPrimary from '../../components/BtnPrimary.vue';
    import ErrorMessages from '../../components/ErrorMessages.vue';
    import SessionMessages from '../../components/SessionMessages.vue';
    import CheckBox from '../../components/CheckBox.vue'; 
    import { useForm } from '@inertiajs/vue3';

    const props = defineProps({
        listing: Object
    })

    const form = useForm({
        title: props.listing.title,
        desc: props.listing.desc,
        tags: props.listing.tags,
        email: props.listing.email,
        link: props.listing.link,
        image: null
    })
</script>

<template>

    <Head title="- Edit Listing"/>

    <Container>
    
        <div>
            <Title>
                Edit a New Listing
            </Title>
        </div>

        <ErrorMessages :errors="form.errors" />

        <form class="grid grid-cols-2 gap-6">
            <div class="space-y-6">
                <InputField label="Title" icon="heading" v-model="form.title" placeholder="My new Listing" />
                <InputField label="Tags (separate with comma)" icon="tags" v-model="form.tags" placeholder="one,two,three" />
                <TextArea label="Description" icon="newspaper" v-model="form.desc" placeholder="A short description of your listing" />
            </div>

            <div class="space-y-6">
                <InputField label="Email" icon="at" v-model="form.email" placeholder="email@example.com" />
                <InputField label="External Link" icon="up-right-from-square" v-model="form.link" placeholder="https://example.com" />
                <ImageUpload @image="(e) => form.image = e" :listingImage="listing.image" />
            </div>

            <div>
                <BtnPrimary :disabled="form.processing">    
                    Update
                </BtnPrimary>
            </div>
    
        </form>
            
    </Container>

</template>