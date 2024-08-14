<script setup lang="ts">
import { ref } from "vue";
import { router, usePage } from "@inertiajs/vue3";

import clsx from "clsx";
import Column from "primevue/column";
import Button from "primevue/button";
import DataTable from "primevue/datatable";
import { useToast } from "primevue/usetoast";
import ProgressSpinner from "primevue/progressspinner";

import { User } from "../../Types/Models/User";

defineProps<{
    users: User[];
    favorite_ids: bigint[];
}>();
const page = usePage();
const toast = useToast();

const disabledButtons = ref<number[]>([]);
const tableHeaders = [
    { field: "name", header: "Name" },
    { field: "email", header: "Email" },
];

const handleFavorite = (user: any) => {
    try {
        disabledButtons.value.push(user.id);
        router.post(
            route("users.favorite", user),
            {},
            {
                onSuccess: () => {
                    toast.add({
                        severity: "info",
                        summary: page.props.flash.message
                            ? page.props.flash.message
                            : "",
                        life: 3000,
                    });
                },
                onError: () => {
                    toast.add({
                        severity: "error",
                        summary: "An error occured!",
                        life: 3000,
                    });
                },
                onFinish: () => {
                    disabledButtons.value.splice(
                        disabledButtons.value.indexOf(user.id),
                        1
                    );
                },
            }
        );
    } finally {
        disabledButtons.value.splice(disabledButtons.value.indexOf(user.id), 1);
    }
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
            <Column
                :hidden="!page.props.auth.user"
                :v-id="ProgressSpinner"
                field="favorite"
            >
                <template #body="slotProps">
                    <Button
                        outlined
                        :icon="
                            clsx('pi', {
                                'pi-star-fill': favorite_ids.some(
                                    (id) => id === slotProps.data.id
                                ),
                                'pi-star': !favorite_ids.some(
                                    (id) => id === slotProps.data.id
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
