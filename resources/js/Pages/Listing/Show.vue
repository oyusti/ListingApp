<script setup>
import { Link, router } from '@inertiajs/vue3';
import Container from '../../components/Container.vue';

    const props = defineProps({
        listing: Object,
        user: Object, 
        canModify: Boolean
    })

    const listingDelete = () => {
        if (confirm('Are you sure you want to delete this listing?')) {
            router.delete(route('listings.destroy', props.listing.id));
        }
    }

    const toggleAprove = (listing) => {

        let msg =   props.listing.approved 
                    ? 'Dissaproved the listing' 
                    : 'Approved the listing';

        if (confirm(msg)) {
            router.put(route('admin.approve', props.listing.id));
        }
    }

</script>

<template>
    <div>
        <Head title="- Listing Detail"/>

        <!-- Admin -->
         <div v-if="$page.props.auth.user.role === 'admin'"
            class=" bg-slate-800 text-white mb-6 p-6 rounded-md font-medium flex items-center justify-between">
            <p>
                This Listing is {{ listing.approved ? "Approved" : "Disapproved" }}
            </p>
            <button @click.prevent="toggleAprove(listing)" class="bg-slate-600 px-3 py-1 rounded-md">
                {{ listing.approved ? 'disapprove it' : 'Approve it' }}
            </button>

         </div>

        <Container class="flex gap-4">
            <div class="w-1/4 rounded-md overflow-hidden">
                <img 
                :src="listing.image ? `/storage/${listing.image}` : '/storage/images/listing/2151345410.jpg' " 
                alt="" 
                class=" w-full h-full object-cover object-center bg-slate-300">
            </div>
            <div class="w-3/4">
                <!-- Listing Info -->
                <div class="mb-6">
                    <div class="flex items-end justify-between mb-2">
                        <p class=" text-slate-400 w-full border-b">
                            Listing Detail
                        </p>
                        <div v-if="canModify" class="flex items-center gap-2 pl-4">
                            <!-- Edit and Delete Buttons -->
                            <Link
                            class=" bg-green-500 rounded-md px-6 py-2 text-white hover:outline outline-green-500 outline-offset-2" 
                            :href="route('listings.edit', listing.id)">
                                Edit
                            </Link>

                            <button
                            class=" bg-red-500 rounded-md px-6 py-2 text-white hover:outline outline-red-500 outline-offset-2"
                            @click="listingDelete" 
                            >
                                Delete
                        </button>
                        </div>
                    </div> 

                    <h3 class=" font-bold text-2xl mb-4">
                        {{ listing.title }}
                    </h3>
                    <p>
                        {{ listing.desc }}
                    </p>
                </div>

                <!-- Contact info -->
                <div class="mb-6">
                    <p class=" text-slate-400 w-full border-b">
                        Contact Info
                    </p>

                    <!-- Email -->
                     <div v-if="listing.email" class="flex items-center gap-2 mb-2">
                        <i class="fa-solid fa-at"></i>
                        <p>Email:</p>
                        <a :href="`mailto:${listing.email}`" class="text-link">
                            {{ listing.email }}
                        </a>
                     </div>

                    <!-- Link -->
                    <div v-if="listing.link" class="flex items-center gap-2 mb-2">
                        <i class="fa-solid fa-up-right-from-square"></i>
                        <p>External link:</p>
                        <a :href="listing.link" target="_blank" class="text-link">
                            {{ listing.link }}
                        </a>
                     </div>

                    <!-- User -->

                    <div class="flex items-center gap-2 mb-2">
                        <i class="fa-solid fa-user"></i>
                        <p>Listed by:</p>
                        <Link :href="route('home', {user_id: user.id})" class="text-link">
                            {{ user.name }}
                        </Link>

                     </div>

                </div>

                <!-- Tags -->
                 <div v-if="listing.tags" class="mb-6">
                    <p class=" text-slate-400 w-full border-b mb-2">
                        Tags
                    </p>
                    <div  class="flex items-center gap-3">
                        <div v-for="tag in listing.tags.split(',')" :key="tag">
                            <Link 
                                class=" bg-slate-500 text-white px-2 py-px rounded-full hover:bg-slate-700 hover:dark:bg-slate-900"
                                :href="route('home', { tag: tag })">
                                {{ tag }}
                            </Link>
                        </div>
                    </div>  
                 </div>

            </div>
        </Container>
    </div>
</template>