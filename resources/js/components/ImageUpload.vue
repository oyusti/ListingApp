<script setup>
    import { ref } from 'vue';

    
    const overSizedImage = ref(false);
    const emit = defineEmits(['image']);
    const props = defineProps({
        listingImage: String
        });
    const currentImage = props.listingImage ? `/storage/${props.listingImage}` : null;     
    const preview = ref(currentImage);
    const showRevertBtn = ref(false);

    const imageSelected = (e) => {
        preview.value = URL.createObjectURL(e.target.files[0]);
        overSizedImage.value = e.target.files[0].size > 3000000;
        showRevertBtn.value = true;
        emit('image', e.target.files[0]);
    }

    const revertImageChange = () => {
        showRevertBtn.value = false;
        preview.value = currentImage;
        overSizedImage.value = false;
        emit('image', null);
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
                border-t-slate-300 border relative"
            :class="{ '!border-red-500': overSizedImage }">
            <img 
                :src="preview ?? '/storage/images/listing/2151345410.jpg'" 
                alt="" 
                class=" object-cover object-center w-full h-full">

            <button 
                v-if="showRevertBtn"
                @click.prevent="revertImageChange"
                type="button"
                class=" absolute top-2 right-2 bg-white/75 w-8 h-8 rounded-full grid place-items-center text-slate-700"
            >
                <i class="fa-solid fa-rotate-left"></i>
            </button>
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
