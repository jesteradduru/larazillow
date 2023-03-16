<template>
        <h1>Index</h1>
        <h2>The message is {{ message }}</h2>
</template>
<script setup> 
    defineProps({
        message: String
    }) 
</script>