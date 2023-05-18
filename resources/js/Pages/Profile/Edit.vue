<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue'
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue'
import DeleteUserForm from './Partials/DeleteUserForm.vue'

defineProps({
    mustVerifyEmail: Boolean,
    status: String,
})
</script>

<template>
    <AuthenticatedLayout title="Profile">
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
                Profile
            </h2>
        </template>

        <div class="space-y-6">
            <div
                class="p-4 bg-white shadow sm:p-8 dark:bg-gray-800 sm:rounded-lg"
            >
                <UpdateProfileInformationForm
                    :must-verify-email="mustVerifyEmail"
                    :status="status"
                    class="max-w-xl"
                />
            </div>

            <div
                class="p-4 bg-white shadow sm:p-8 dark:bg-gray-800 sm:rounded-lg"
            >
                <UpdatePasswordForm class="max-w-xl" />
            </div>

            <div
                class="p-4 bg-white shadow sm:p-8 dark:bg-gray-800 sm:rounded-lg" id="delete-account-form"
            >
                <DeleteUserForm class="max-w-xl" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
