<template>
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">posts</h1>
            </div>
            <div class="sm:col-span-3 mr-1.5">
                <div class="mt-2">
                    <select id="country" v-model="category_id" autocomplete="country-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                        <option
                            value=""
                        >Null</option>
                        <option
                            v-for="category in categories"
                            :value="category.id"
                        >{{ category.name }}</option>
                    </select>
                </div>
            </div>
            <div class="relative flex items-start">
                <div class="flex h-6 items-center">
                    <input id="comments" aria-describedby="comments-description" v-model="myPost" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600" />
                </div>
                <div class="ml-3 text-sm leading-6">
                    <label for="comments" class="font-medium text-gray-900">My Posts</label>
                </div>
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <a href="/posts/create" type="button"
                   class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add</a>
            </div>
        </div>
        <div class="mt-8 flow-root" v-if="posts.length > 0">
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
                        <tr v-for="post in posts" :key="post.id">
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900">
                                {{ post.name }}
                            </td>
                            <td class="relative whitespace-nowrap text-right text-sm font-medium sm:pr-6 lg:pr-8">
                                <a :href="`/posts/show/${post.id}`"
                                   class="px-1 text-indigo-600 hover:text-indigo-900">Show
                                    <span class="sr-only">, {{ post.name }}</span></a>
                                <a :href="`/posts/edit/${post.id}`"
                                   class="px-1 text-indigo-600 hover:text-indigo-900">Edit
                                    <span class="sr-only">, {{ post.name }}</span></a>
                                <button
                                    class="px-1 text-indigo-600 hover:text-indigo-900"
                                    @click="deleteItem(post.id)"
                                >Delete<span class="sr-only">, {{ post.name }}</span></button>
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
                        :href="`/posts?page=${item}`"
                        aria-current="page"
                        class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0"
                    >{{ item }}</a>
                </div>
            </nav>
        </div>
    </div>
</template>

<script setup>
import PostDataService from "../../services/PostDataService.js";
import CategoryDataService from "../../services/CategoryDataService.js";
import {useRoute, useRouter} from 'vue-router'
import {onMounted} from 'vue'

const route = useRoute()
const router = useRouter()
import {ref, watch} from 'vue';

const posts = ref([])
const myPost = ref(false)
const pages = ref(1)
const page = ref(1)
const categories = ref([])
const category_id = ref(null)


function getCategories(params) {
    CategoryDataService.getAll(params)
        .then(response => {
            categories.value = response.data.data.items;
        })
        .catch(e => {
            console.log(e);
        });
}


function getAll() {
    let params = {
        page: page.value
    }

    if (myPost.value) {
        params.show_my_post = myPost.value
    }

    if (category_id.value) {
        params.category_id = category_id.value
    }

    PostDataService.getAll(params)
        .then(response => {
            posts.value = response.data.data.items;
            pages.value = response.data.data.lastPage;
        })
        .catch(e => {
            console.log(e);
        });
}

function deleteItem(id) {
    PostDataService.delete(id)
        .then(response => {
            getAll();
        })
        .catch(e => {
            console.log(e);
        });
}

onMounted(() => {
    if (route.query && route.query.page) {
        page.value = route.query.page;
    }

    getAll();
    getCategories();
})

watch(myPost, async (newmyPost, oldmyPost) => {
    router.push({ path: 'posts', query: { page: 1 }})
    getAll();
})

watch(category_id, async (newmyPost, oldmyPost) => {
    router.push({ path: 'posts', query: { page: 1 }})
    getAll();
})

</script>
