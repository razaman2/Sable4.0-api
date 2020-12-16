<template>
    <h1>Alarm.com Dealer</h1>
    <div>
        <p>{{dealer.DealerName}}</p>
        <p>{{dealer.DealerID}}</p>
    </div>
    <div>
        <ul class="card">
            <li v-for="branch in dealer.SubDealers.BranchInfo">
                <strong class="title">{{branch.BranchName}}</strong>
                <hr>
                <p>{{branch.BranchId}}</p>
                <inertia-link :href="`/rep-validate/${branch.ContactName}`">
                    <p>{{branch.ContactName}}</p>
                </inertia-link>
                <p class="email">{{branch.ContactEmailAddress}}</p>
                <p>{{branch.ContactPhoneNumber}}</p>
                <hr>
            </li>

            <li>
                <strong class="title">Test Branch</strong>
                <hr>
                <p>1234</p>
                <inertia-link :href="`/rep-validate/nassal`">
                    <p>Nassal</p>
                </inertia-link>
                <p class="email">navid.assal@sablecrm.com</p>
                <p>(732) 444-2222</p>
                <hr>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    props: {
        dealer: {}
    }
};
</script>

<style scoped>
.card {
    display: grid;
    grid-gap: 1em;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
}

.card > li {
    list-style: none;
    box-shadow: .1em .1em 5px 1px grey;
    padding: .5em;
    border-radius: 5px;
}

.card .email {
    word-break: break-all;
}

.card .title {
    margin: 0;
}

li ~ li {
    background-color: blue;
}
</style>
