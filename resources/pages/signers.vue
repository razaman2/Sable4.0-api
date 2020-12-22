<template>
    <label for="envelope-id">
        <input id="envelope-id" type="text" placeholder="Envelope ID" v-model="id">
    </label>
    <div>
        <input type="button" @click="getSigners" value="Get Signers">
    </div>
</template>

<script>
import {Inertia} from '@inertiajs/inertia';

export default {
    name: 'signers',
    data: () => {
        return {
            id: ''
        };
    },
    methods: {
        getSigners () {
            Inertia.visit('/signers', {
                method: 'post',
                only: ['signers'],
                data: {id: this.id}
            });
        }
    },
    props: {
        signers: {}
    }
};
</script>

<style scoped>

</style>
