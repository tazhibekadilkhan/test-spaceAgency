<template>
    <div class="flex min-h-full flex-1 flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <img class="mx-auto h-10 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600"
                 alt="Your Company"/>
            <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Sign in to your
                account</h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <div class="space-y-6">
                <div>
                    <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
                    <div class="mt-2">
                        <input id="email" v-model="email" type="email" autocomplete="email" required=""
                               class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"/>
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                    </div>
                    <div class="mt-2">
                        <input id="password" v-model="password" type="password" autocomplete="current-password" required=""
                               class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"/>
                    </div>
                </div>


                <p v-if="errors" class="mt-2 text-sm text-red-600" id="email-error">{{ errors }}</p>

                <div>
                    <button @click="login"
                            class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Sign in
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>


<script setup>
import http from "../axios.js";

import {onMounted, watch} from 'vue';
import {useRoute, useRouter} from "vue-router";

const route = useRoute()
const router = useRouter()

import {ref} from 'vue';

const errors = ref()
const email = ref('moderator@test.com')
const password = ref('password')

function login() {
    http.post("/login", {
        email: email.value,
        password: password.value
    })
        .then(response => {
            localStorage.setItem('_token', response.data.data.authorization.access_token)
            router.replace('/posts')
        })
        .catch(e => {
            errors.value = e.response.data.error
            console.log(e);
        });

}


onMounted(() => {
    // if (localStorage.getItem('_token')) {
    //     router.replace('/posts')
    // }
})

watch(email, async (newmyPost, oldmyPost) => {
    errors.value = ''
})

watch(password, async (newmyPost, oldmyPost) => {
    errors.value = ''
})

</script>
