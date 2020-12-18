<template>
    <h1>{{name ?? 'Invalid User'}}</h1>
</template>

<script>
export default {
    props: {
        name: {}
    }
};
</script>

<style scoped>

</style>
