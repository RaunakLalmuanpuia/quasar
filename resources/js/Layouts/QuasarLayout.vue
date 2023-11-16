<template>
    <q-layout view="hHh lpR fFf">
        <q-header elevated class="bg-primary text-white" height-hint="98">
            <q-toolbar>
                <q-btn dense flat round icon="menu" @click="toggleLeftDrawer" />

                <q-toolbar-title>
                    <q-avatar>
                        <img
                            src="https://cdn.quasar.dev/logo-v2/svg/logo-mono-white.svg"
                        />
                    </q-avatar>
                    Title
                </q-toolbar-title>
                <q-btn-dropdown
                    color="primary"
                    :label="$page.props.auth.user.name"
                >
                    <q-list>
                        <q-item clickable v-close-popup @click="profile">
                            <q-item-section>
                                <q-item-label>Profile</q-item-label>
                            </q-item-section>
                        </q-item>

                        <q-item clickable v-close-popup @click="logout">
                            <q-item-section>
                                <q-item-label>Logout</q-item-label>
                            </q-item-section>
                        </q-item>
                    </q-list>
                </q-btn-dropdown>
            </q-toolbar>

            <q-tabs align="center">
                <q-route-tab :href="route('dashboard')" label="Upload Report" />
                <q-route-tab to="/page2" label="View Report" />
                <q-route-tab to="/page3" label="Contact" />
                <q-route-tab
                    v-if="$page.props.user.roles.includes('admin')"
                    :href="route('permission_ui.permissions.index')"
                    label="Roles"
                />
            </q-tabs>
        </q-header>

        <q-drawer v-model="leftDrawerOpen" side="left" bordered>
            <!-- drawer content -->
        </q-drawer>

        <q-page-container>
            <slot></slot>
        </q-page-container>

        <q-footer elevated class="bg-grey-8 text-white">
            <q-toolbar align="middle">
                <q-toolbar-title>
                    <q-avatar>
                        <img
                            src="https://cdn.quasar.dev/logo-v2/svg/logo-mono-white.svg"
                        />
                    </q-avatar>
                    <div align="middle">Title</div>
                </q-toolbar-title>
            </q-toolbar>
        </q-footer>
    </q-layout>
</template>

<script setup>
import { ref } from "vue";
import { router } from "@inertiajs/vue3";
const leftDrawerOpen = ref(false);
const toggleLeftDrawer = () => {
    leftDrawerOpen.value = !leftDrawerOpen.value;
};

// Redirect to a route using Inertia
const profile = () => {
    // Use Inertia to visit the profile route
    router.get(route("profile.show"));
    // router.visit("/user/profile-information", { method: "get" });
};
const logout = () => {
    // Use Inertia to visit the logout route
    router.post(route("logout"));
};
</script>
