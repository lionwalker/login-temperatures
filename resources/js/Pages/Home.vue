<template>
    <div>
        <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
            <div class="font-extrabold mt-8 text-5xl text-green-500 mb-4">
                Login Temperatures
                <hr class="mt-2 text-black">
            </div>

            <div class="text-right">
                <button type="button" v-on:click="hottest" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mr-2">Hottest First
                </button>
                <button type="button" v-on:click="reset" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded mr-2">Reset
                    Order
                </button>
            </div>

            <div class="grid grid-cols-2 gap-4 mt-2">
                <div class="" v-for="(item, index) in cities" >
                    <city :is-ordered-by="isOrdered" :city-name="index"/>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import City from '@/Components/City.vue'
import Button from "@/Jetstream/Button";

export default {
    components: {
        Button,
        City
    },
    props:{
        cities:[]
    },
    data() {
        return {
            isOrdered: false,
        }
    },
    methods: {
        hottest: function (event) {
            this.isOrdered = true;
        },
        reset: function (event) {
            this.isOrdered = false;
        },
    },
}
</script>
