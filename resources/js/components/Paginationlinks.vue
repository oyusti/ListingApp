<script setup>
    defineProps({
        paginator: Object
    })

    const makelabel = (label) => {
        if(label.includes('Previous')){
            return '<<';
        }
        if(label.includes('Next')){
            return '>>';
        }
        return label;
    }

</script>

<template>
    <div class=" flex justify-between items-start">
        <div class=" flex items-center rounded-md overflow-hidden shadow-lg">
            <div v-for="(link, i) in paginator.links" :key="i">
                <component 
                    :is="link.url ? 'Link' : 'span'"
                    :href="link.url"
                    v-html="makelabel(link.label)"
                    class=" border-x border-slate-50 w-12 h-12 grid place-items-center bg-white dark:bg-slate-900
                    dark:border-slate-800"
                    :class="{
                        'hover:bg-slate-300 dark:hover:bg-slate-500': link.url, 
                        'text-slate-300': !link.url,
                        'font-bold text-indigo-500 dark:text-indigo-400': link.active
                        }"
                />
            </div>
        </div>
        <p class=" text-sm text-slate-600 dark:text-slate-400">
            Showing {{ paginator.from }} to {{ paginator.to }} of {{ paginator.total }} results
        </p>
    </div>
</template>