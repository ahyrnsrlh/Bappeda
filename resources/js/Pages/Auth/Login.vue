<template>
    <div class="min-h-screen flex">
        <!-- Left Side - Login Form -->
        <div
            class="flex-1 flex items-center justify-center px-4 sm:px-6 lg:px-20 xl:px-24"
        >
            <div class="w-full max-w-sm lg:w-96">
                <div class="text-center">
                    <!-- Logo Section -->
                    <div class="flex justify-center mb-6">
                        
                    </div>

                    <h2 class="text-3xl font-bold text-gray-900 mb-2">
                        Selamat Datang
                    </h2>
                    <p class="text-gray-600 mb-8">
                        Masuk ke Sistem BAPPEDA Provinsi Lampung
                    </p>
                </div>

                <!-- Login Form -->
                <div
                    class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100"
                >
                    <form class="space-y-6" @submit.prevent="submit">
                        <div>
                            <label
                                for="email"
                                class="block text-sm font-semibold text-gray-700 mb-2"
                            >
                                Alamat Email
                            </label>
                            <div class="relative">
                                <div
                                    class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
                                >
                                    <svg
                                        class="h-5 w-5 text-gray-400"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"
                                        ></path>
                                    </svg>
                                </div>
                                <input
                                    id="email"
                                    v-model="form.email"
                                    type="email"
                                    required
                                    class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition duration-200"
                                    placeholder="nama@email.com"
                                />
                            </div>
                            <div
                                v-if="form.errors.email"
                                class="text-red-600 text-sm mt-2"
                            >
                                {{ form.errors.email }}
                            </div>
                        </div>

                        <div>
                            <label
                                for="password"
                                class="block text-sm font-semibold text-gray-700 mb-2"
                            >
                                Kata Sandi
                            </label>
                            <div class="relative">
                                <div
                                    class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
                                >
                                    <svg
                                        class="h-5 w-5 text-gray-400"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"
                                        ></path>
                                    </svg>
                                </div>
                                <input
                                    id="password"
                                    v-model="form.password"
                                    type="password"
                                    required
                                    class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition duration-200"
                                    placeholder="Masukkan kata sandi"
                                />
                            </div>
                            <div
                                v-if="form.errors.password"
                                class="text-red-600 text-sm mt-2"
                            >
                                {{ form.errors.password }}
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input
                                    id="remember"
                                    v-model="form.remember"
                                    type="checkbox"
                                    class="h-4 w-4 text-yellow-600 focus:ring-yellow-500 border-gray-300 rounded"
                                />
                                <label
                                    for="remember"
                                    class="ml-2 block text-sm text-gray-700"
                                >
                                    Ingat saya
                                </label>
                            </div>
                        </div>

                        <div>
                            <button
                                type="submit"
                                :disabled="form.processing"
                                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-lg text-sm font-semibold text-white bg-gradient-to-r from-yellow-500 to-orange-500 hover:from-yellow-600 hover:to-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200 transform hover:scale-[1.02]"
                            >
                                <span
                                    v-if="form.processing"
                                    class="inline-flex items-center"
                                >
                                    <svg
                                        class="animate-spin -ml-1 mr-3 h-5 w-5 text-white"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                    >
                                        <circle
                                            class="opacity-25"
                                            cx="12"
                                            cy="12"
                                            r="10"
                                            stroke="currentColor"
                                            stroke-width="4"
                                        ></circle>
                                        <path
                                            class="opacity-75"
                                            fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                                        ></path>
                                    </svg>
                                    Memproses...
                                </span>
                                <span v-else class="flex items-center">
                                    <svg
                                        class="w-5 h-5 mr-2"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
                                        ></path>
                                    </svg>
                                    Masuk ke Sistem
                                </span>
                            </button>
                        </div>

                        <div
                            v-if="status"
                            class="text-green-600 text-sm text-center bg-green-50 p-3 rounded-lg"
                        >
                            {{ status }}
                        </div>

                        <div
                            v-if="message"
                            class="text-blue-600 text-sm text-center bg-blue-50 p-3 rounded-lg"
                        >
                            {{ message }}
                        </div>
                    </form>

                    <div class="mt-8 text-center space-y-4">
                        <div class="relative">
                            <div class="absolute inset-0 flex items-center">
                                <div
                                    class="w-full border-t border-gray-300"
                                ></div>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="px-2 bg-white text-gray-500"
                                    >atau</span
                                >
                            </div>
                        </div>

                        <p class="text-sm text-gray-600">
                            Belum punya akun?
                            <Link
                                :href="route('register')"
                                class="font-semibold text-yellow-600 hover:text-yellow-700 transition duration-200"
                            >
                                Daftar di sini
                            </Link>
                        </p>
                        <p class="text-sm text-gray-500">
                            <Link
                                :href="route('home')"
                                class="hover:text-gray-700 transition duration-200"
                            >
                                ← Kembali ke Beranda
                            </Link>
                        </p>
                    </div>
                </div>
            </div>
        </div>     
    </div>
</template>
<script setup>
import { useForm } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";

defineProps({
    status: String,
    message: String,
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
