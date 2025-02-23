<script setup>
    import Title from '../../components/Title.vue';
    import { Link, useForm, router } from '@inertiajs/vue3';
    import InputField from '../../components/InputField.vue';
    import PaginationLinks from '../../components/Paginationlinks.vue'
    import SessionMessages from '../../components/SessionMessages.vue'
    
    const params =route().params

    const props = defineProps({
        user:Object,
        listings:Object,
        status:String
    })

    const form = useForm({
        search: params.search,
        user_role:params.user.role
    })

    const search = () => {
        router.get(route('user.show',{
            user: props.user.id,
            search: form.search
        }));
    }

    const showDisapproved = (e) => {
        if (e.target.checked) {
            router.get(
                route('user.show',{
                user:props.user.id,
                search:params.search,
                disapproved: true
                })
            );
        } else {
            router.get(
                route('user.show', {
                user:props.user.id,
                search:params.search,
                disapproved: null
                }) 
            );
        }
    }

    const toggleAprove = (listing) => {

        let msg =   listing.approved 
                    ? 'Dissaproved the listing' 
                    : 'Approved the listing';

        if (confirm(msg)) {
            router.put(route('admin.approve', listing.id));
        }
    }

</script>

<template>
    <Head :title="`- ${user.name} Listings`" />

    <SessionMessages :status="status" />

    <!-- Heading -->
     <div class=" mb-6">
        <Title>{{ user.name }} Latest Listings</Title>
        <div class=" flex items-end justify-between">
            <div class=" flex items-end gap-2">
                <form @submit.prevent="search">
                    <InputField 
                        type="search" 
                        label=""
                        icon="magnifying-glass"
                        placeholder="Search..."
                        v-model="form.search" 
                    />
                </form>

                <Link
                    class=" px-2 py-1 rounded-md bg-indigo-500 text-white flex items-center gap-2"
                    v-if="params.search"
                    :href="route('user.show', { ...params, search: null, page: null, user:user.id })">
                    {{ params.search }}
                    <i class="fa-solid fa-xmark"></i>
                </Link>
            </div>

            <div>
                <!-- Toggle approved listing button -->
        <div class=" flex items-center gap-1 text-xs hover:bg-slate-300 dark:hover:bg-slate-800 px-2 py-1 rounded-md">
            <input 
                @input="showDisapproved"
                :checked="params.disapproved"
                type="checkbox" 
                id="showDisapproved"
                class=" rounded-md border-1 outline-0 text-indigo-500 ring-indigo-500 border-slate-700 cursor-pointer" 
            />
            <label 
                for="showDisapproved"
                class=" block text-sm font-medium text-slate-700 dark:text-slate-300 cursor-pointer px-1"
            >
                Show disapproved listings
            </label>
        </div>
            </div>

        </div>
    </div>

    <!-- Table -->

    <table class="bg-white dark:bg-slate-800 w-full rounded-lg overflow-hidden ring-1 ring-slate-300">
        <thead>
            <tr class="bg-slate-600 text-slate-300 uppercase text-xs text-left">
                <th class="w-4/6 p-3">Title</th>
                <th class="w-2/6 p-3">approved</th>
                <th class="w-1/6 p-3">View</th> 
            </tr>
        </thead>

        <tbody class="divide-y divide-slate-300 divide-dashed">
            <tr v-for="listing in listings.data" :key="listing.id" class="text-sm">
                <td class="py-5 px-3">
                    {{ listing.title }}
                </td>

                <td class="py-5 px-3 text-2xl text-center">
                    <button @click.prevent="toggleAprove(listing)">
                        <i
                        :class="`fa-solid fa-${
                        listing.approved 
                        ? 'circle-check text-green-400' 
                        : 'circle-xmark text-red-400'}`">
                            
                        </i>
                    </button>
                </td>

                <td class="w-1/6 py-5 px-3 text-right">
                    <Link 
                        class="fa-solid fa-up-right-from-square px-3 text-indigo-400"
                        :href="route('listings.show', listing.id)"
                    >
                    </Link> 
                </td>
            </tr>
        </tbody>
                
    </table>

    <div class="mt-6">
        <PaginationLinks :paginator="listings" />
    </div>

</template>