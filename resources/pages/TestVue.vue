<script lang="ts">
import ReactiveVue
    from "@razaman2/reactive-vue";
import {h} from 'vue';
import {InertiaProgress} from "@inertiajs/progress";
import {Inertia} from "@inertiajs/inertia";

export default class TestVue extends ReactiveVue {
    // public mounted() {
    //     InertiaProgress.init();
    //     console.log('what is my state:', this.getState().getData());
    // }

    public template() {
        return h('div', [
            h('h1', 'Testing Reactive Vue From Laravel.'),
            h('div', {
                style: 'display:flex; flex-direction:column; height: 250px align-items:space-between;'
            }, [
                h('input', {
                    type: 'text',
                    placeholder: 'Enter Name',
                    value: this.getState()?.getData?.('name'),
                    oninput: (data: any) => this.getState()?.setData?.({name: data.target.value})
                }),
                h('input', {
                    type: 'number',
                    placeholder: 'Enter Age',
                    value: this.getState()?.getData?.('age'),
                    oninput: (data: any) => this.getState()?.setData?.({age: data.target.value})
                }),
                h('input', {
                    type: 'datetime-local',
                    placeholder: 'Enter Date and Time',
                    value: this.getState()?.getData?.('datetime'),
                    oninput: (data: any) => this.getState()?.setData?.({datetime: data.target.value})
                })
            ]),
            h('input', {
                type: 'submit',
                onclick: () => Inertia.visit('/reactive-vue', {
                    data: this.getState().getData()
                })
            })
        ]);
    }
};
</script>

<style scoped>

</style>
