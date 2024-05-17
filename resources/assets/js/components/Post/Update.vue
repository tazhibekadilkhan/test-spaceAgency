<template>
    <div class="space-y-10 divide-y divide-gray-900/10">
        <div class="center grid grid-cols-1 gap-x-8 gap-y-8 pt-10 md:grid-cols-3">
            <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">
                <div class="px-4 py-6 sm:p-8">
                    <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">Name</label>
                            <div class="mt-2">
                                <input type="text"  v-model="item.name" id="first-name" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                            </div>
                        </div>

                    </div>
                    <div class="col-span-full">
                        <label for="about" class="block text-sm font-medium leading-6 text-gray-900">Description</label>
                        <div class="mt-2">
                            <textarea id="about" v-model="item.description" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="country" class="block text-sm font-medium leading-6 text-gray-900">Category</label>
                        <div class="mt-2">
                            <select id="country" v-model="item.category_id" autocomplete="country-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                <option
                                    v-for="category in categories"
                                    :value="category.id"
                                >{{ category.name }}</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8">
                    <a href="/posts" type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</a>
                    <button @click="update" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import PostDataService from "../../services/PostDataService.js";
import CategoryDataService from "../../services/CategoryDataService.js";

import { onMounted } from 'vue';
import { useRoute } from "vue-router";
const route =useRoute()

import {ref} from 'vue';
const item = ref({
    name: null,
    description: null,
    category_id: null
})
const categories = ref([])

function getCategories(params) {
    CategoryDataService.getAll(params)
        .then(response => {
            categories.value = response.data.data.items;
        })
        .catch(e => {
            console.log(e);
        });
}

function get() {
    PostDataService.get(route.params.id)
        .then(response => {
            item.value = response.data.data;
            item.value.category_id = item.value.category.id;
        })
        .catch(e => {
            console.log(e);
        });
}

function update() {
    PostDataService.update(route.params.id, item.value)
        .then(response => {
            item.value = response.data.data;
            item.value.category_id = item.value.category.id;
        })
        .catch(e => {
            console.log(e);
            alert(e.response.data.error)
        });
}


onMounted(() => {
    get();
    getCategories();
})

</script>

