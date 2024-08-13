<script setup lang="ts">
import { useForm } from "@inertiajs/vue3";

import Card from "primevue/card";
import Button from "primevue/button";
import InputText from "primevue/inputtext";

interface FormData {
    email: string;
    password: string;
}

const form = useForm<FormData>({
    email: "",
    password: "",
});

const handleSubmit = () => {
    console.log(form.data());
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
                                class="w-full"
                            />
                        </div>
                        <div>
                            <label for="email">Password</label>
                            <InputText
                                id="password"
                                v-model="form.password"
                                type="password"
                                class="w-full"
                            />
                        </div>
                    </div>
                    <div>
                        <Button
                            type="submit"
                            label="Login"
                            class="w-full"
                            @click="handleSubmit"
                        />
                    </div>
                </div>
            </template>
        </Card>
    </div>
</template>

<style scoped></style>
