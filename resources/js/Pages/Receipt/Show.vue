<script setup lang="ts">
import { Receipt } from "@/Types/Models/Receipt";

defineProps<{ receipt: Receipt }>();
</script>

<template>
    <div class="flex flex-row gap-4 h-full">
        <div class="w-1/4 bg-gray-900 rounded-md p-4 flex flex-col">
            <div class="font-bold flex flex-col">
                <span class="text-3xl">{{ receipt.name }}</span>
                <span>{{ receipt.date }}</span>
            </div>
        </div>
        <div class="flex-grow bg-gray-900 rounded-md p-4"></div>
        <div class="bg-green-500 w-1/4 hidden">oten dako longganisa</div>
    </div>
</template>
