<template>
    <h5>Docusign Test</h5>
    <input class="btn" type="button" value="Sender" @click="send"/>
    <input class="btn" v-if="RegExp('sent').test(contract?.status)" type="button" value="View" @click="view"/>
    <hr>
    <div>
        <label>
            Signer Sequence
            <input type="number" v-model="sequence"/>
        </label>
    </div>

    <pre>{{ contract }}</pre>
</template>

<script>
import {Inertia} from '@inertiajs/inertia';
import {InertiaProgress} from '@inertiajs/progress';

export default {
    mounted () {
        InertiaProgress.init();
    },
    data: () => {
        return {
            sequence: 0
        };
    },
    props: {
        contract: {
            required: true
        },
        url: {
            required: true
        }
    },
    methods: {
        send () {
            Inertia.visit('/docusign', {
                method: 'post',
                preserveState: false
            });
        },
        view () {
            Inertia.visit('/view', {
                method: 'post',
                only: ['url'],
                data: {
                    id: this.contract.envelopeId,
                    sequence: this.sequence
                }
            });
        }
    },
    watch: {
        url: {
            handler: (url) => {
                if(url) {
                    window.open(url, '_blank');
                }
            },
            immediate: true
        }
    }
};
</script>

<style scoped>
.btn ~ .btn {
    margin-left: 10px;
}
</style>
