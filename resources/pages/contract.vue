<script lang="ts">
import {Inertia} from '@inertiajs/inertia';
import {InertiaProgress} from '@inertiajs/progress';
import ReactiveVue
    from '@razaman2/reactive-vue';
import {
    Options,
    prop
} from 'vue-class-component';
import {
    h,
    watch
} from 'vue';

@Options({
    props: {
        contract: prop({
            required: true,
            type: Object
        }),

        url: prop({
            required: true,
            type: String
        })
    }
})

export default class Contract extends ReactiveVue {
    public mounted() {
        InertiaProgress.init();

        this.$watch(() => this.url, (url: string) => {
            if (url) {
                window.open(url, '_blank');
            }
        }, {immediate: true});

        watch(this.contract, (contract: any) => {
            console.log('the value of contract:', contract);
        }, {immediate: true})
    }

    public template() {
        return h('div', [
            h('h5', 'Docusign Test'),
            this.getSendButton(),
            this.getViewButton(),
            h('hr'),
            this.getSequenceInput(),
            h('pre', this.contract)
        ])
    }

    protected getViewButton() {
        if (RegExp('^sent$').test(this.contract?.status)) {
            return h('input', {
                class: 'btn',
                type: 'button',
                value: 'View',
                onclick: () => Inertia.visit('/view', {
                    method: 'post',
                    only: ['url'],
                    data: {
                        id: this.contract?.envelopeId,
                        sequence: this.getState()?.getData('sequence')
                    }
                })
            });
        }
    }

    protected getSendButton() {
        return h('input', {
            class: 'btn',
            type: 'button',
            value: 'Sender',
            onclick: () => Inertia.visit('/docusign', {
                method: 'post',
                preserveState: false
            })
        });
    }

    protected getSequenceInput() {
        return h('div', [
            h('label', [
                'Signer Sequence',
                h('input', {
                    type: 'number',
                    value: this.getState()?.getData('sequence'),
                    oninput: (event: InputEvent) => this.getState()?.setData({sequence: (event.target as any).value})
                })
            ])
        ]);
    }

    public getDefaultData() {
        return {
            sequence: 0
        }
    }
}
</script>

<style scoped>
.btn ~ .btn {
    margin-left: 10px;
}
</style>
