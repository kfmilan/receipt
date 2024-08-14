<script setup lang="ts">
import { toRaw } from "vue";
import Card from "primevue/card";
import Avatar from "primevue/avatar";
import AvatarGroup from "primevue/avatargroup";
import Button from "primevue/button";
import { Link, router } from "@inertiajs/vue3";

interface Receipt {
    id: number;
    name: string;
    date: string;
    service_charge_rate: number;
}

defineProps<{ receipts: Receipt[] }>();
</script>

<template>
    <div>
        <div class="grid lg:grid-cols-5 grid-cols-2 gap-2">
            <Card v-for="receipt in receipts" class="p-3" :key="receipt.id">
                <template #title>
                    <p class="text-2xl font-bold text-blue-600">
                        {{ receipt.name }}
                    </p>
                    <p class="text-sm">{{ receipt.date }}</p>
                </template>
                <template #content>
                    <p>Item 1 - P100.00</p>
                    <p>Item 2 - P150.00</p>
                    <p>Item 3 - P150.00</p>
                </template>
                <template #footer>
                    <div class="grid place-items-center">
                        <AvatarGroup class="gap-2">
                            <Avatar label="A" shape="circle" />
                            <Avatar label="B" shape="circle" />
                            <Avatar label="C" shape="circle" />
                            <Avatar label="+2" shape="circle" />
                        </AvatarGroup>
                    </div>
                    <div>
                        <Link :href="route('receipts.show', receipt)">
                            <Button
                                icon="pi pi-arrow-right"
                                text
                                rounded
                                severity="info"
                            />
                        </Link>
                    </div>
                </template>
            </Card>
        </div>
    </div>
</template>
