<script setup lang="ts">
import { useForm } from "@inertiajs/vue3";

import Card from "primevue/card";
import Button from "primevue/button";
import InputText from "primevue/inputtext";
import { useToast } from "primevue/usetoast";

const toast = useToast();

interface FormData {
    email: string;
    password: string;
}

const form = useForm<FormData>({
    email: "",
    password: "",
});

const handleSubmit = () => {
    form.post("/login", {
        onSuccess: () => {
            toast.add({
                severity: "success",
                summary: "Success",
                detail: "Logged in!",
                life: 3000,
            });
        },
    });
};
</script>

<template>
    <div class="h-full w-full flex flex-col items-center">
        <Card class="w-[450px] m-auto p-4">
            <template #title>
                <div class="w-full text-center">Login</div>
            </template>
            <template #content>
                <div class="w-full space-y-8">
                    <div class="space-y-2">
                        <div>
                            <label for="email">Email</label>
                            <InputText
                                id="email"
                                v-model="form.email"
                                :invalid="form.errors.email"
                                :disabled="form.processing"
                                class="w-full"
                            />
                            <small id="email-help" class="text-red-500">{{
                                form.errors.email
                            }}</small>
                        </div>
                        <div>
                            <label for="email">Password</label>
                            <InputText
                                id="password"
                                v-model="form.password"
                                :invalid="form.errors.password"
                                :disabled="form.processing"
                                type="password"
                                class="w-full"
                            />
                            <small id="password-help" class="text-red-500">{{
                                form.errors.password
                            }}</small>
                        </div>
                    </div>
                    <div>
                        <Button
                            type="submit"
                            label="Login"
                            class="w-full"
                            :disabled="form.processing"
                            @click="handleSubmit"
                        />
                    </div>
                </div>
            </template>
        </Card>
    </div>
</template>

<style scoped></style>
