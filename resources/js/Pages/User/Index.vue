<script setup lang="ts">
import { defineProps } from "vue";
import { User } from "../../Types/Models/User";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import Button from "primevue/button";

defineProps<{ users: User[] }>();

const tableHeaders = [
    { field: "name", header: "Name" },
    { field: "email", header: "Email" },
];

const handleFavorite = (slotProps: any) => {
    return () => {
        console.log(slotProps);
    };
};
</script>

<template>
    <div class="px-4 pb-4">
        <DataTable :value="users">
            <Column
                v-for="column in tableHeaders"
                :field="column.field"
                :header="column.header"
            ></Column>
            <Column field="favorite">
                <template #body="slotProps">
                    <Button
                        icon="pi pi-star"
                        outlined
                        severity="contrast"
                        @click="handleFavorite('test')"
                    />
                </template>
            </Column>
        </DataTable>
    </div>
</template>

<style scoped></style>
