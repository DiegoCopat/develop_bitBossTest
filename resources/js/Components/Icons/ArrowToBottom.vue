<template>
    <svg :style="style" class="rotate-0 h-6 w-6 transform transition-all duration-300 ease-linear" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round"
            d="M19 9l-7 7-7-7" />
    </svg>
</template>

<script>
    import { defineComponent } from "@vue/runtime-core";

    export default defineComponent({
        props: {
            style: String,
        },  
    });
</script>
