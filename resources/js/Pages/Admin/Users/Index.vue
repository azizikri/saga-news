<script setup>
import Pagination from '@/Components/Pagination.vue';
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import Modal from '@/Components/Modal.vue'
import Button from '@/Components/Button.vue'
import { Link, router, usePage } from '@inertiajs/vue3';
import { ref, watch } from 'vue';

const confirmingUserDeletion = ref(false)
const userToDelete = ref(null);

function deleteUser(user) {
    if (auth.id === user.id) {
        router.get('/profile#delete-account-form');
    } else {
        router.delete(route('admin.users.destroy', user), {
            onFinish: () => {
                closeModal()
            },
        });
    }
}

const confirmUserDeletion = (user) => {
    if (auth.id === user.id) {
        router.get('/profile#delete-account-form');
    } else {
        userToDelete.value = user
        confirmingUserDeletion.value = true
    }
}

const closeModal = () => {
    confirmingUserDeletion.value = false
}

let auth = usePage().props.auth.user;

defineProps({
    users: Object
})

let name = ref('');

watch(name, value => {
    router.get(route('admin.users.index'), { name: value }, {
        preserveState: true,
    });
});
</script>

<template>
    <AuthenticatedLayout title="Users">
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    Users
                </h2>
                <!-- create new button -->
                <Link :href="route('admin.users.create')"
                    class="focus:outline-none text-white bg-purple-500 hover:bg-purple-600 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">
                Create New User</Link>
            </div>
        </template>

        <div class="space-y-6">

            <div>
                <label for="table-search" class="sr-only">Search</label>
                <div class="relative mt-1">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <input type="text" id="table-search"
                        class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Search user names" v-model="name">
                </div>
            </div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">

                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Role
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Email
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Created At
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <span class="sr-only">Action</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700" v-for="user in users.data"
                            :key="user.id">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ user.name }}
                            </th>
                            <td class="px-6 py-4">
                                {{ user.role }}
                            </td>
                            <td class="px-6 py-4">
                                {{ user.email }}
                            </td>
                            <td class="px-6 py-4">
                                {{ user.created_at }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <Link :href="auth.id != user.id ? route('admin.users.edit', user) : route('profile.edit')"
                                    class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:focus:ring-yellow-900">
                                Edit</Link>
                                <Button @click="confirmUserDeletion(user)"
                                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                    Delete
                                </Button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <Pagination :links="users.links" />
        </div>
        <Modal :show="confirmingUserDeletion" @close="closeModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    Are you sure you want to delete {{ userToDelete.name }}?
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    Once this user is deleted, all of its resources and data
                    will be permanently deleted.
                </p>

                <div class="flex justify-end mt-6">
                    <Button variant="secondary" @click="closeModal">
                        Cancel
                    </Button>

                    <Button variant="danger" class="ml-3" @click="deleteUser(userToDelete.id)">
                        Delete User
                    </Button>
                </div>
            </div>
        </Modal>
    </AuthenticatedLayout>
</template>
