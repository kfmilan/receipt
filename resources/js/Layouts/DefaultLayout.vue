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
        label: "Receipts",
        icon: "pi pi-receipt",
    },
    {
        label: "Users",
        icon: "pi pi-users",
        route: route("users.index"),
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
                    <template #item="{ item }">
                        <Link href="/users" v-if="item.route">
                            <div class="p-2">
                                <span :class="item.icon" />
                                <span class="ml-2">{{ item.label }}</span>
                            </div>
                        </Link>
                    </template>
                    <template #end>
                        <Link
                            v-if="!sharedData.props.auth.user"
                            :href="route('login')"
                        >
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
