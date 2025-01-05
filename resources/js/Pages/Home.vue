<script setup>
    import Cards from '../components/Cards.vue';
    import Paginationlinks from '../components/Paginationlinks.vue';
    import InputField from '../components/InputField.vue';
    import { router, useForm } from '@inertiajs/vue3';

    const params = route().params

    
    const props = defineProps({
        searchTerms: String,
        listings: Object
    })

    const username = params.user_id ? props.listings.data.find(i => i.user.id === Number(params.user_id)).user.name : null;

    const form = useForm({
        search: props.searchTerms
    });

    const search = () => {
        router.get(route('home'), {
            search: form.search, 
            user_id: params.user_id,
            tag: params.tag
        });
    }
</script>

<template>
    <Head title="- Latest Listings"/>

    <div class="flex justify-between items-center mb-4">
        <div class=" flex items-center gap-4">
            <Link
                class=" px-2 py-1 rounded-md bg-indigo-500 text-white flex items-center gap-2"
                v-if="params.tag"
                :href="route('home', { ...params, tag: null, page: null })">
                {{ params.tag }}
                <i class="fa-solid fa-xmark"></i>
            </Link>
            <Link
                class=" px-2 py-1 rounded-md bg-indigo-500 text-white flex items-center gap-2"
                v-if="params.search"
                :href="route('home', { ...params, search: null, page: null })">
                {{ params.search }}
                <i class="fa-solid fa-xmark"></i>
            </Link>
            <Link
                class=" px-2 py-1 rounded-md bg-indigo-500 text-white flex items-center gap-2"
                v-if="params.user_id"
                :href="route('home', { ...params, user_id: null, page: null })">
                {{ username }}
                <i class="fa-solid fa-xmark"></i>
            </Link>
        </div>

        <div class=" h-1/4">
            <form @submit.prevent="search">
                <InputField 
                type="search" 
                label=""
                icon="magnifying-glass"
                placeholder="Search..."
                v-model="form.search" 
                />
            </form>
        </div>
    </div>

    <div v-if="Object.keys(listings.data).length">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div v-for="listing in listings.data" :key="listing.id">
                <Cards :listing="listing" />
            </div>
        </div>

        <div class="mt-8">
            <Paginationlinks :paginator="listings" />
        </div>
    </div>

    <div v-else>
        <p class="text-center text-slate-600 dark:text-slate-400">No listings found</p>
    </div>

</template>