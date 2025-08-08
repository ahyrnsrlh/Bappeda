<template>
    <div
        class="min-h-screen flex items-center justify-center bg-gradient-to-br from-[#EAAA00] to-[#FCD34D] py-12 px-4 sm:px-6 lg:px-8"
    >
        <div class="max-w-md w-full space-y-8">
            <div class="text-center">
                <div
                    class="mx-auto h-20 w-20 bg-white rounded-full flex items-center justify-center shadow-lg"
                >
                    <span class="text-3xl font-bold text-[#EAAA00]">B</span>
                </div>
                <h2 class="mt-6 text-3xl font-bold text-white">
                    Daftar Akun Baru
                </h2>
                <p class="mt-2 text-sm text-white/80">
                    BAPPEDA Provinsi Lampung
                </p>
            </div>

            <div class="bg-white rounded-lg shadow-2xl p-8">
                <form @submit.prevent="submit" class="space-y-6">
                    <div>
                        <label
                            for="name"
                            class="block text-sm font-medium text-gray-700"
                        >
                            Nama Lengkap
                        </label>
                        <input
                            id="name"
                            v-model="form.name"
                            type="text"
                            required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-[#EAAA00] focus:border-transparent"
                            placeholder="Masukkan nama lengkap"
                        />
                        <div
                            v-if="errors?.name"
                            class="mt-1 text-sm text-red-600"
                        >
                            {{ errors.name }}
                        </div>
                    </div>

                    <div>
                        <label
                            for="email"
                            class="block text-sm font-medium text-gray-700"
                        >
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
                        <div
                            v-if="errors?.email"
                            class="mt-1 text-sm text-red-600"
                        >
                            {{ errors.email }}
                        </div>
                    </div>

                    <div>
                        <label
                            for="role"
                            class="block text-sm font-medium text-gray-700"
                        >
                            Role
                        </label>
                        <select
                            id="role"
                            v-model="form.role"
                            required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-[#EAAA00] focus:border-transparent"
                        >
                            <option value="">Pilih Role</option>
                            <option value="kabid">Kepala Bidang</option>
                            <option value="wakabid">Wakil Kepala Bidang</option>
                            <option value="KI">Koordinator Internal</option>
                            <option value="tim_1">
                                Tim Penanggulangan Kemiskinan
                            </option>
                            <option value="tim_2">
                                Tim Kawasan Industri & PSN
                            </option>
                            <option value="tim_3">Tim Peluang Investasi</option>
                            <option value="tim_4">Tim CSR/TJSL</option>
                            <option value="tim_5">Tim DBH Perkebunan</option>
                        </select>
                        <div
                            v-if="errors?.role"
                            class="mt-1 text-sm text-red-600"
                        >
                            {{ errors.role }}
                        </div>
                    </div>

                    <div v-if="teams?.length">
                        <label
                            for="team_id"
                            class="block text-sm font-medium text-gray-700"
                        >
                            Tim Kerja (Opsional)
                        </label>
                        <select
                            id="team_id"
                            v-model="form.team_id"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-[#EAAA00] focus:border-transparent"
                        >
                            <option value="">Pilih Tim Kerja</option>
                            <option
                                v-for="team in teams"
                                :key="team.id"
                                :value="team.id"
                            >
                                {{ team.name }}
                            </option>
                        </select>
                        <div
                            v-if="errors?.team_id"
                            class="mt-1 text-sm text-red-600"
                        >
                            {{ errors.team_id }}
                        </div>
                    </div>

                    <div>
                        <label
                            for="password"
                            class="block text-sm font-medium text-gray-700"
                        >
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
                        <div
                            v-if="errors?.password"
                            class="mt-1 text-sm text-red-600"
                        >
                            {{ errors.password }}
                        </div>
                    </div>

                    <div>
                        <label
                            for="password_confirmation"
                            class="block text-sm font-medium text-gray-700"
                        >
                            Konfirmasi Password
                        </label>
                        <input
                            id="password_confirmation"
                            v-model="form.password_confirmation"
                            type="password"
                            required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-[#EAAA00] focus:border-transparent"
                            placeholder="Konfirmasi password"
                        />
                    </div>

                    <div>
                        <button
                            type="submit"
                            :disabled="processing"
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-[#EAAA00] hover:bg-[#D97706] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#EAAA00] disabled:opacity-50 disabled:cursor-not-allowed transition duration-150 ease-in-out"
                        >
                            <span
                                v-if="processing"
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
                                Mendaftar...
                            </span>
                            <span v-else>Daftar</span>
                        </button>
                    </div>
                </form>

                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600">
                        Sudah punya akun?
                        <Link
                            :href="route('login')"
                            class="font-medium text-[#EAAA00] hover:text-[#D97706] transition duration-150 ease-in-out"
                        >
                            Masuk di sini
                        </Link>
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";
import { computed } from "vue";

defineProps({
    teams: {
        type: Array,
        default: () => [],
    },
    errors: {
        type: Object,
        default: () => ({}),
    },
});

const form = useForm({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
    role: "",
    team_id: "",
});

const processing = computed(() => form.processing);

const submit = () => {
    form.post(route("register"));
};
</script>
