<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthBase from '@/layouts/AuthLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { LoaderCircle, Eye, EyeOff } from 'lucide-vue-next';
import { ref } from 'vue';

defineProps<{
    status?: string;
    canResetPassword: boolean;
}>();

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const showPassword = ref(false);

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <AuthBase title="" description="">
        <Head title="Log in" />
        
        <!-- Olara Logo -->
        <!-- <div class="flex justify-center mb-8">
            <img src="/images/olara-logo.png" alt="Olara" class="h-12" />
        </div> -->

        <!-- Sign in heading and description -->
        <div class="text-left">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Sign in</h1>
            <p class="text-gray-600">Login to your designated account from here</p>
        </div>

        <div v-if="status" class="mb-4 text-center text-sm font-medium text-green-600">
            {{ status }}
        </div>
        
        <form @submit.prevent="submit" class="flex flex-col gap-6">
            <div class="grid gap-6">
                <div class="grid gap-2">
                    <Label for="email" class="text-sm font-medium text-gray-700">E-mail</Label>
                    <Input
                        id="email"
                        type="email"
                        required
                        autofocus
                        :tabindex="1"
                        autocomplete="email"
                        v-model="form.email"
                        placeholder="example@gmail.com"
                        class="h-12 px-4 border border-gray-200 rounded-lg focus:border-[#465fff] focus:ring-[#465fff]"
                    />
                    <InputError :message="form.errors.email" />
                </div>
                
                <div class="grid gap-2">
                    <Label for="password" class="text-sm font-medium text-gray-700">Password</Label>
                    <div class="relative">
                        <Input
                            id="password"
                            :type="showPassword ? 'text' : 'password'"
                            required
                            :tabindex="2"
                            autocomplete="current-password"
                            v-model="form.password"
                            placeholder="Enter your password"
                            class="h-12 px-4 pr-12 border border-gray-200 rounded-lg focus:border-[#465fff] focus:ring-[#465fff]"
                        />
                        <button
                            type="button"
                            @click="showPassword = !showPassword"
                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 border-l-2 border-[#cfd9e0] pl-2"
                        >
                            <Eye v-if="!showPassword" class="h-5 w-5" />
                            <EyeOff v-else class="h-5 w-5" />
                        </button>
                    </div>
                    <InputError :message="form.errors.password" />
                </div>
                
                <div class="flex items-center justify-between">
                    <Label for="remember" class="flex items-center space-x-3">
                        <Checkbox id="remember" v-model="form.remember" :tabindex="3" class="border-gray-300" />
                        <span class="text-sm text-gray-600">Remember me</span>
                    </Label>
                    <TextLink v-if="canResetPassword" :href="route('password.request')" class="text-sm text-[#465fff] hover:text-[#3d4ecc]" :tabindex="5">
                        Forgot Password?
                    </TextLink>
                </div>
                
                <Button 
                    type="submit" 
                    class="mt-4 w-full h-12 bg-[#465fff] hover:bg-[#3d4ecc] text-white font-medium rounded-lg transition-colors" 
                    :tabindex="4" 
                    :disabled="form.processing"
                >
                    <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin mr-2" />
                    Sign in
                </Button>
            </div>
            
        </form>
    </AuthBase>
</template>
