<script setup>
    import PaginationLinks from '../../components/Paginationlinks.vue'
    import RoleSelect from '../../components/RoleSelect.vue'
    import SessionMessages from '../../components/SessionMessages.vue'
    defineProps({
        users:Object,
        status:String
    });
</script>

<template>
    <Head title="- Admin" />

    <SessionMessages :status="status" />

    <!-- Heading -->
    <div>Heading</div>
    

    <!-- Table -->
    <table class="bg-white dark:bg-slate-800 w-full rounded-lg overflow-hidden ring-1 ring-slate-300">
        <thead>
            <tr class="bg-slate-600 text-slate-300 uppercase text-xs text-left">
                <th class="w-3/6 p-3">Name</th>
                <th class="w-2/6 p-3">Role</th>
                <th class="w-1/6 p-3">listings</th>
                <th class="w-1/6 p-3 text-right">View</th>
            </tr>
        </thead>

        <tbody class="divide-y divide-slate-300 divide-dashed">
            <tr v-for="user in users.data" :key="user.id" class="text-sm">
                <td class="w-3/6 py-5 px-3">
                    <p class="font-bold mb-1">{{ user.name }}</p>
                    <p class=" font-light text-xs">{{ user.email }}</p>
                </td>

                <td class="w-2/6 py-5 px-3">
                    <RoleSelect :user="user" />
                </td>

                <td class="w-1/6 py-5 px-3">
                    <div class="flex items-center gap-6">
                        <div class="flex items-center gap-1">
                            <p>{{ user.listings.filter(l => l.approved).length }}</p>
                            <i class="fa-solid fa-circle-check text-green-400"></i>
                        </div>
                        <div class="flex items-center gap-1">
                            <p>{{ user.listings.filter(l => !l.approved).length }}</p>
                            <i class="fa-solid fa-circle-xmark text-red-400"></i>
                        </div>
                    </div>
                </td>

                <td class="w-1/6 py-5 px-3 text-right">
                    Link View
                </td>
            </tr>
        </tbody>
                
    </table>

    <div class="mt-6">
        <PaginationLinks :paginator="users" />
    </div>

</template>