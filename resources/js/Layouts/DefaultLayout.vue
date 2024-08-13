<script setup lang="ts">
import { ref } from "vue";
import { Link, router, usePage } from "@inertiajs/vue3";

import "primeicons/primeicons.css";
import Toast from "primevue/toast";
import Button from "primevue/button";
import Menubar from "primevue/menubar";
import { useToast } from "primevue/usetoast";

const sharedData = usePage();

const toast = useToast();

const items = ref([
    {
        label: "Home",
        icon: "pi pi-home",
    },
    {
        label: "Features",
        icon: "pi pi-star",
    },
    {
        label: "Projects",
        icon: "pi pi-search",
        items: [
            {
                label: "Core",
                icon: "pi pi-bolt",
                shortcut: "⌘+S",
            },
            {
                label: "Blocks",
                icon: "pi pi-server",
                shortcut: "⌘+B",
            },
            {
                label: "UI Kit",
                icon: "pi pi-pencil",
                shortcut: "⌘+U",
            },
            {
                separator: true,
            },
            {
                label: "Templates",
                icon: "pi pi-palette",
                items: [
                    {
                        label: "Apollo",
                        icon: "pi pi-palette",
                        badge: 2,
                    },
                    {
                        label: "Ultima",
                        icon: "pi pi-palette",
                        badge: 3,
                    },
                ],
            },
        ],
    },
    {
        label: "Contact",
        icon: "pi pi-envelope",
        badge: 3,
    },
]);

const handleLogout = () => {
    router.post(
        "/logout",
        {},
        {
            onSuccess: () => {
                toast.add({
                    severity: "success",
                    summary: "Success",
                    detail: "Logged out!",
                    life: 3000,
                });
                // props.auth.user = usePage().props.auth.user;
            },
        }
    );
};
</script>

<template>
    <main class="flex flex-col w-screen h-screen">
        <Toast position="bottom-right" />
        <header>
            <div class="card p-4">
                <Menubar :model="items">
                    <template #end>
                        <Link v-if="!sharedData.props.auth.user" href="/login">
                            <Button severity="contrast" text label="Login" />
                        </Link>
                        <Button
                            v-if="sharedData.props.auth.user"
                            severity="contrast"
                            text
                            label="Logout"
                            @click="handleLogout"
                        />
                    </template>
                </Menubar>
            </div>
        </header>
        <article class="flex-grow p-4">
            <slot />
        </article>
    </main>
</template>

<style scoped></style>
