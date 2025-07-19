<template>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-[#EAAA00] to-[#FCD34D] py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div class="text-center">
                <div class="mx-auto h-20 w-20 bg-white rounded-full flex items-center justify-center shadow-lg">
                    <span class="text-3xl font-bold text-[#EAAA00]">B</span>
                </div>
                <h2 class="mt-6 text-3xl font-bold text-white">
                    Masuk ke Sistem
                </h2>
                <p class="mt-2 text-sm text-white/80">
                    BAPPEDA Provinsi Lampung
                </p>
            </div>

            <div class="bg-white rounded-lg shadow-2xl p-8">
                <form class="space-y-6" @submit.prevent="submit">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">
                            Email
                        </label>
                        <input
                            id="email"
                            v-model="form.email"
                            type="email"
                            required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-[#EAAA00] focus:border-transparent"
                            placeholder="nama@contoh.com"
                        />
                        <div v-if="form.errors.email" class="text-red-600 text-sm mt-1">
                            {{ form.errors.email }}
                        </div>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">
                            Password
                        </label>
                        <input
                            id="password"
                            v-model="form.password"
                            type="password"
                            required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-[#EAAA00] focus:border-transparent"
                            placeholder="Masukkan password"
                        />
                        <div v-if="form.errors.password" class="text-red-600 text-sm mt-1">
                            {{ form.errors.password }}
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input
                                id="remember"
                                v-model="form.remember"
                                type="checkbox"
                                class="h-4 w-4 text-[#EAAA00] focus:ring-[#EAAA00] border-gray-300 rounded"
                            />
                            <label for="remember" class="ml-2 block text-sm text-gray-900">
                                Ingat saya
                            </label>
                        </div>
                    </div>

                    <div>
                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-[#EAAA00] hover:bg-[#D97706] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#EAAA00] disabled:opacity-50 disabled:cursor-not-allowed transition duration-150 ease-in-out"
                        >
                            <span v-if="form.processing" class="inline-flex items-center">
                                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Memproses...
                            </span>
                            <span v-else>Masuk</span>
                        </button>
                    </div>

                    <div v-if="status" class="text-green-600 text-sm text-center">
                        {{ status }}
                    </div>
                </form>

                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600">
                        Belum punya akun?
                        <Link 
                            :href="route('register')" 
                            class="font-medium text-[#EAAA00] hover:text-[#D97706] transition duration-150 ease-in-out"
                        >
                            Daftar di sini
                        </Link>
                    </p>
                    <p class="mt-2 text-sm text-gray-600">
                        <Link 
                            :href="route('home')" 
                            class="font-medium text-[#EAAA00] hover:text-[#D97706] transition duration-150 ease-in-out"
                        >
                            ← Kembali ke Beranda
                        </Link>
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { useForm } from "@inertiajs/vue3";
import { Link } from '@inertiajs/vue3'

defineProps({
    status: String,
});

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.post("/login");
};
</script>
