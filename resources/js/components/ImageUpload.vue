<script setup>
    import { ref } from 'vue';

    const preview = ref(null);
    const overSizedImage = ref(false);
    const emit = defineEmits(['image']);

    const imageSelected = (e) => {
        preview.value = URL.createObjectURL(e.target.files[0]);
        overSizedImage.value = e.target.files[0].size > 3000000;
        emit('image', e.target.files[0]);
    }
</script>

<template>
    <div>
        <span 
            class=" block text-sm text-slate-700 dark:text-slate-300"
            :class="{ '!text-red-500': overSizedImage }">
            {{ overSizedImage ? 'Image is too large. Max size is 3MB' : 'Image (Size max 3MB)' }}
        </span>

        <label 
            for="image"
            class=" block rounded-md mt-1 bg-slate-300 h-[140px] overflow-hidden cursor-pointer
                border-t-slate-300 border"
            :class="{ '!border-red-500': overSizedImage }">
            <img 
                :src="preview ?? '/storage/images/listing/2151345410.jpg'" 
                alt="" 
                class=" object-cover object-center w-full h-full">
        </label>

        <input 
            @input="imageSelected"
            type="file" 
            id="image" 
            name="image"
            hidden
        />
    </div>
</template>
