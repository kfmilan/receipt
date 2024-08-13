<script setup lang="ts">
import clsx from "clsx";
import { ref } from "vue";

import Column from "primevue/column";
import Button from "primevue/button";
import DataTable from "primevue/datatable";
import { useToast } from "primevue/usetoast";

import { User } from "../../Types/Models/User";

defineProps<{ users: User[] }>();
const toast = useToast();

const tableHeaders = [
    { field: "name", header: "Name" },
    { field: "email", header: "Email" },
];

const handleFavorite = (user: any) => {
    if (!disabledButtons.value.includes(user.id)) {
        disabledButtons.value.push(user.id);
        setTimeout(() => {
            if (favorites.value.includes(user.id)) {
                favorites.value.splice(favorites.value.indexOf(user.id), 1);
                toast.add({
                    severity: "info",
                    summary: "Removed from favorites!",
                    detail: `Test`,
                    life: 3000,
                });
            } else {
                favorites.value.push(user.id);
                toast.add({
                    severity: "success",
                    summary: "Added to favorites!",
                    detail: ``,
                    life: 3000,
                });
            }
            disabledButtons.value.splice(
                disabledButtons.value.indexOf(user.id),
                1
            );
        }, 1500);
    }
};

const favorites = ref([1, 3]);
const disabledButtons = ref<number[]>([]);
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
                        outlined
                        :icon="
                            clsx('pi', {
                                'pi-star-fill': favorites.includes(
                                    slotProps.data.id
                                ),
                                'pi-star': !favorites.includes(
                                    slotProps.data.id
                                ),
                                'pi-spin pi-spinner': disabledButtons.includes(
                                    slotProps.data.id
                                ),
                            })
                        "
                        :disabled="disabledButtons.includes(slotProps.data.id)"
                        severity="contrast"
                        @click="handleFavorite(slotProps.data)"
                    />
                </template>
            </Column>
        </DataTable>
    </div>
</template>

<style scoped></style>
