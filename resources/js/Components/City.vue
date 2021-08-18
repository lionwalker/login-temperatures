<template>
    <div class="mt-2">
        <h5 class="text-3xl font-extrabold">{{ cityName }}</h5>
        <div class="grid grid-cols-4 gap-4 mt-2" v-for="item in isOrderedBy ? orderByTemperature : dataset" :key="item.id">
            <div class="whitespace-nowrap col-span-2"> {{ item.login_time }}</div>
            <div> {{ item.temperature }} &#8451;</div>
            <div> {{ item.temperature_fahrenheit }} &#x2109;</div>
        </div>

    </div>
</template>

<script>
export default {
    name: "City",
    props: {
        cityName: null,
        isOrderedBy: false
    },
    data() {
        return {
            dataset: Array
        }
    },
    mounted() {
        const vm = this;
        let url = "/get/" + this.cityName + "/temperature";
        axios.get(url)
            .then(function (response) {
                vm.dataset = response.data;
            })
            .catch(function (error) {
                console.log(error);
            });
    },
    computed: {
        orderByTemperature: function () {
            return _.orderBy(this.dataset, 'temperature', 'desc')
        }
    }
}
</script>

<style scoped>

</style>
