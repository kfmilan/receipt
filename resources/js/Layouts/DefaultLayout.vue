<script setup lang="ts">
import { ref } from "vue";

import Menubar from "primevue/menubar";

import "primeicons/primeicons.css";

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
</script>

<template>
    <main class="flex flex-col w-full h-full">
        <header>
            <div class="card p-4">
                <Menubar :model="items" />
            </div>
        </header>
        <article class="flex-grow p-4">
            <slot />
        </article>
    </main>
</template>

<style scoped></style>
