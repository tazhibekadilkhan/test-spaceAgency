<template>
    <div class="bg-white py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl" v-if="item">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">{{ item.name }}</h2>
                <p class="mt-2 text-lg leading-8 text-gray-600">{{ item.description }}</p>


                <div v-if="!comment && comments.length > 1" class="mt-10 space-y-16 pt-10 sm:mt-16 sm:pt-16">
                    <article v-for="(comment, index) in comments" :key="comment.id"
                             class="flex max-w-xl flex-col items-start justify-between border-t border-gray-200 pt-10">
                        <div class="flex items-center gap-x-4 text-xs">
                            <time :datetime="comment.created_at" class="text-gray-500">{{ comment.created_at }}</time>
                            <button @click="editComment(comment)" class="block w-full rounded-md bg-gray-300 px-1 py-1 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">edit</button>
                            <button @click="deleteComment(comment.id, index)" class="block w-full rounded-md bg-red-300 px-1 py-1 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">delete</button>
                        </div>
                        <div class="group relative">
                            <p class="mt-5 line-clamp-3 text-sm leading-6 text-gray-600">{{ comment.content }}</p>
                        </div>
                        <div class="relative mt-8 flex items-center gap-x-4" v-if="comment.user">
                            <div class="text-sm leading-6">
                                <p class="font-semibold text-gray-900">
                                    <a href="#">
                                        <span class="absolute inset-0"/>
                                        {{ comment.user.name }}
                                    </a>
                                </p>
                                <p class="text-gray-600">{{ comment.user.roles[0].name }}</p>
                            </div>
                        </div>
                    </article>
                </div>

                <div class="mt-16 max-w-xl sm:mt-20" v-if="!comment">
                    <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
                        <div class="sm:col-span-2">
                            <label for="message" class="block text-sm font-semibold leading-6 text-gray-900">Message</label>
                            <div class="mt-2.5">
                                <textarea v-model="content" id="message" rows="4" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                            </div>
                        </div>
                    </div>
                    <div class="mt-10">
                        <button @click="create" class="block w-full rounded-md bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Comment</button>
                    </div>
                </div>
                <div ref="editCommentDiv" class="mt-16 max-w-xl sm:mt-20" v-else>
                    <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
                        <div class="sm:col-span-2">
                            <label for="message" class="block text-sm font-semibold leading-6 text-gray-900">Message</label>
                            <div class="mt-2.5">
                                <textarea v-model="content" id="message" rows="4" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                            </div>
                        </div>
                    </div>
                    <div class="mt-10">
                        <button @click="updateComment" class="block w-full rounded-md bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import PostDataService from "../../services/PostDataService.js";
import CommentDataService from "../../services/CommentDataService.js";
import {onMounted, ref} from 'vue';
import { useRoute, useRouter } from "vue-router";
const router =useRouter()
const route = useRoute()
const item = ref()
const comments = ref([])
const content = ref(null)
const comment = ref(null)

function get() {
    PostDataService.get(route.params.id)
        .then(response => {
            item.value = response.data.data
            getComments()
        })
        .catch(e => {
            console.log(e);
        });
}

function getComments() {
    CommentDataService.getAll({
        post_id: route.params.id
    })
        .then(response => {
            comments.value = response.data.data.items;
        })
        .catch(e => {
            console.log(e);
        });
}

function create() {

    if (!localStorage.getItem('_token')) {
        router.push({path: '/login'})
    }

    CommentDataService.create({
        content: content.value,
        post_id: route.params.id
    })
        .then(response => {
            content.value = ''
            // comments.value.push(response.data.data)
        })
        .catch(e => {
            console.log(e);
            alert(e.response.data.errors?.description || 'Ошибка')
        });
}

function updateComment() {

    if (!localStorage.getItem('_token')) {
        router.push({path: '/login'})
    }

    CommentDataService.update(comment.value.id,{
        content: content.value,
    })
        .then(response => {
            content.value = null
            comment.value = null
        })
        .catch(e => {
            console.log(e);
            alert(e.response.data.error)
        });
}

function deleteComment(id, index) {

    if (!localStorage.getItem('_token')) {
        router.push({path: '/login'})
    }

    CommentDataService.delete(id)
        .then(response => {
            getComments()
        })
        .catch(e => {
            console.log(e);
            alert(e.response.data.error)
        });
}

function editComment(cmt) {

    if (!localStorage.getItem('_token')) {
        router.push({path: '/login'})
    }

    content.value = cmt.content
    comment.value = cmt
}

onMounted(() => {
    get();
})
</script>

