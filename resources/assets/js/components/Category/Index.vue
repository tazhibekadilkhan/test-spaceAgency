<template>
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">Categories</h1>
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <a href="/categories/create" type="button"
                   class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add</a>
            </div>
        </div>
        <div class="mt-8 flow-root" v-if="categories.length > 0">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead>
                        <tr>
                            <th scope="col"
                                class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6 lg:pl-8">
                                Name
                            </th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                        <tr v-for="category in categories" :key="category.id">
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900">
                                {{ category.name }}
                            </td>
                            <td class="relative whitespace-nowrap text-right text-sm font-medium sm:pr-6 lg:pr-8">
                                <a :href="`/categories/edit/${category.id}`"
                                   class="px-1 text-indigo-600 hover:text-indigo-900">Edit<span
                                    class="sr-only">, {{ category.name }}</span></a>
                                <button
                                    class="px-1 text-indigo-600 hover:text-indigo-900"
                                    @click="deleteItem(category.id)"
                                >Delete<span class="sr-only">, {{ category.name }}</span></button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <nav
                v-if="pages > 1"
                class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                <div
                    v-for="item in pages">
                    <a
                        :href="`/categories?page=${item}`"
                        aria-current="page"
                        class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0"
                    >{{ item }}</a>
                </div>
            </nav>
        </div>
    </div>
</template>

<script setup>
import CategoryDataService from "../../services/CategoryDataService.js";
import {useRoute} from 'vue-router'
import {onMounted} from 'vue'

const route = useRoute()
import {ref} from 'vue';

const categories = ref([])
const pages = ref(1)
const page = ref(1)


function getAll(params) {
    CategoryDataService.getAll(params)
        .then(response => {
            categories.value = response.data.data.items;
            pages.value = response.data.data.lastPage;
        })
        .catch(e => {
            console.log(e);
        });
}

function deleteItem(id) {
    CategoryDataService.delete(id)
        .then(response => {
            getAll(route.query);
        })
        .catch(e => {
            console.log(e);
        });
}

onMounted(() => {
    if (route.query && route.query.page) {
        page.value = route.query.page;
    }
    getAll(route.query);
})

</script>
