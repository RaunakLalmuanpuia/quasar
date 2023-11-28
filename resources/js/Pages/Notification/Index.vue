<template>
    <QuasarLayout>
        <div
            v-if="$page.props.flash.message"
            class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
            role="alert"
        >
            <span class="font-medium">
                {{ $page.props.flash.message }}
            </span>
        </div>

        <h1 class="text-3xl mb-4">Your Notifications</h1>

        <section
            v-if="notifications.data.length"
            class="text-gray-700 dark:text-gray-400"
        >
            <div
                class="border-b border-gray-200 dark:border-gray-800 py-4 flex justify-between items-center"
                v-for="notification in notifications.data"
                :key="notification.id"
            >
                <div>
                    <span
                        v-if="
                            notification.type ===
                            'App\\Notifications\\ReportVerified'
                        "
                        >Report was uploaded by
                        {{ notification.data.employee_name }} with Name
                        <Link
                            :href="
                                route(
                                    'report.employee.show',
                                    notification.data.report_id
                                )
                            "
                            class="text-indigo-600"
                        >
                            {{ notification.data.filename }}
                        </Link>
                    </span>
                </div>
                <div>
                    <Link
                        :href="route('notification.seen', notification.id)"
                        as="button"
                        method="put"
                        v-if="!notification.read_at"
                        >Mark as read</Link
                    >
                </div>
            </div>
        </section>
        <section v-else class="text-gray-700 dark:text-gray-400">
            No Notificaton Yet
        </section>

        <section
            v-if="notifications.data.length"
            class="w-full flex justify-center mt-8 mb-8"
        >
            <div class="flex justify-center mt-4">
                <div class="flex gap-1">
                    <Link
                        v-for="(link, index) in notifications.links"
                        :key="index"
                        class="py-2 px-4 rounded-md"
                        :href="link.url || ''"
                        :class="{
                            'bg-indigo-500 dark:bg-indigo-800 text-gray-300':
                                link.active,
                        }"
                        v-html="link.label"
                    />
                </div>
            </div>
        </section>
    </QuasarLayout>
</template>
<script setup>
import QuasarLayout from "@/Layouts/QuasarLayout.vue";
import { Link } from "@inertiajs/vue3";
const props = defineProps({
    notifications: Object,
});
// const props = defineProps({
//     employerPendingFiles: Object,
//     manager: Object,
// });
</script>
