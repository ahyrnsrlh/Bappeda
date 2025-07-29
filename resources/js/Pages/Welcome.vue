<template>
    <div class="min-h-screen bg-gray-50 scroll-smooth">
        <!-- Modern Navigation -->
        <nav
            class="bg-white shadow-lg border-b border-gray-200 fixed w-full top-0 z-50"
        >
            <div class="container mx-auto px-6">
                <div class="flex justify-between items-center py-4">
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center">
                            <div
                                class="w-12 h-12 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-xl flex items-center justify-center shadow-lg"
                            >
                                <span class="text-xl font-bold text-white"
                                    >B</span
                                >
                            </div>
                            <div class="ml-4">
                                <h1 class="text-xl font-bold text-gray-900">
                                    EKONOMI BAPPEDA
                                </h1>
                                <p class="text-sm text-yellow-600 font-medium">
                                    PROVINSI LAMPUNG
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center space-x-4">
                        <template v-if="$page.props.auth?.user">
                            <Link
                                href="/dashboard"
                                class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition-colors"
                            >
                                Dashboard
                            </Link>
                        </template>
                        <template v-else>
                            <Link
                                href="/login"
                                class="px-4 py-2 text-gray-700 hover:text-yellow-600 transition-colors"
                            >
                                Login
                            </Link>
                            <Link
                                href="/register"
                                class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition-colors"
                            >
                                Register
                            </Link>
                        </template>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section
            class="pt-24 pb-20 bg-gradient-to-br from-yellow-400 via-orange-400 to-red-400 relative overflow-hidden"
        >
            <div class="absolute inset-0 opacity-30">
                <div
                    class="absolute top-20 left-10 w-32 h-32 bg-white rounded-full blur-2xl"
                ></div>
                <div
                    class="absolute bottom-20 right-20 w-40 h-40 bg-white rounded-full blur-2xl"
                ></div>
                <div
                    class="absolute top-1/2 left-1/4 w-24 h-24 bg-white rounded-full blur-xl"
                ></div>
            </div>

            <div class="container mx-auto px-6 py-20 relative z-10">
                <div class="max-w-7xl mx-auto">
                    <div class="grid lg:grid-cols-2 gap-16 items-center">
                        <!-- Content -->
                        <div class="text-center lg:text-left space-y-8">
                            <div
                                class="inline-flex items-center bg-white/20 backdrop-blur-sm text-white px-4 py-2 rounded-full text-sm font-medium mb-4"
                            >
                                <span class="mr-2">🏛️</span>
                                BAPPEDA Provinsi Lampung
                            </div>

                            <div class="space-y-4">
                                <h1
                                    class="text-4xl md:text-6xl font-bold text-white leading-tight"
                                >
                                    Sistem Manajemen Rapat
                                    <span class="text-yellow-200"
                                        >Bidang Ekonomi</span
                                    >
                                </h1>
                                <p
                                    class="text-xl md:text-2xl text-white/90 leading-relaxed"
                                >
                                    Platform terintegrasi untuk mengelola jadwal
                                    rapat, notulensi, dan koordinasi tim bidang
                                    perekonomian dan pembangunan.
                                </p>
                            </div>

                            <div
                                class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start"
                            >
                                <template v-if="$page.props.auth?.user">
                                    <Link
                                        href="/dashboard"
                                        class="px-8 py-4 bg-white text-yellow-600 rounded-xl font-semibold shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-300"
                                    >
                                        Masuk ke Dashboard
                                    </Link>
                                </template>
                                <template v-else>
                                    <Link
                                        href="/register"
                                        class="px-8 py-4 bg-white text-yellow-600 rounded-xl font-semibold shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-300"
                                    >
                                        Mulai Sekarang
                                    </Link>
                                </template>
                                <button
                                    @click="scrollToSection('about')"
                                    class="px-8 py-4 border-2 border-white text-white rounded-xl font-semibold hover:bg-white hover:text-yellow-600 transition-all duration-300"
                                >
                                    Pelajari Lebih Lanjut
                                </button>
                            </div>
                        </div>

                        <!-- Image placeholder -->
                        <div class="flex justify-center lg:justify-end">
                            <div class="relative">
                                <div
                                    class="w-96 h-96 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center"
                                >
                                    <div
                                        class="w-64 h-64 bg-white/30 rounded-xl flex items-center justify-center"
                                    >
                                        <div class="text-6xl text-white">
                                            📊
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Teams Section -->
        <section
            id="teams"
            class="py-24 bg-gradient-to-br from-gray-50 to-gray-100"
        >
            <div class="container mx-auto px-6">
                <div class="max-w-7xl mx-auto">
                    <div class="text-center mb-16">
                        <div
                            class="inline-flex items-center bg-gradient-to-r from-green-500 to-blue-600 text-white px-6 py-3 rounded-full text-sm font-semibold mb-6 shadow-lg"
                        >
                            <span class="mr-2">👥</span>
                            Tim Kerja
                        </div>
                        <h2
                            class="text-4xl md:text-5xl font-bold text-gray-900 mb-6"
                        >
                            Tim Bidang Perekonomian
                        </h2>
                    </div>

                    <!-- Teams Grid -->
                    <div
                        class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-8"
                        v-if="teams && teams.length > 0"
                    >
                        <div
                            v-for="team in teams"
                            :key="team.id"
                            class="group bg-white rounded-2xl p-8 text-center hover:shadow-xl hover:scale-105 transition-all duration-300 border border-gray-200"
                        >
                            <div
                                class="w-24 h-24 bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg group-hover:scale-110 transition-transform duration-300"
                            >
                                <span class="text-2xl text-white">👤</span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">
                                {{ team.name }}
                            </h3>
                            <p class="text-gray-600">
                                {{ team.description || "Tim Kerja" }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-gray-900 text-white py-16">
            <div class="container mx-auto px-6">
                <div class="max-w-7xl mx-auto">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                        <!-- Brand Section -->
                        <div class="col-span-1 md:col-span-2">
                            <div class="flex items-center mb-6">
                                <div
                                    class="w-12 h-12 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-xl flex items-center justify-center shadow-lg"
                                >
                                    <span class="text-xl font-bold text-white"
                                        >B</span
                                    >
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-xl font-bold">
                                        EKONOMI BAPPEDA
                                    </h3>
                                    <p class="text-yellow-400 font-medium">
                                        PROVINSI LAMPUNG
                                    </p>
                                </div>
                            </div>
                            <p class="text-gray-400 leading-relaxed mb-6">
                                Sistem Manajemen Rapat Bidang Perekonomian dan
                                Pembangunan BAPPEDA Provinsi Lampung
                            </p>
                        </div>

                        <!-- Quick Links -->
                        <div>
                            <h4 class="text-lg font-semibold mb-6">
                                Menu Utama
                            </h4>
                            <div class="space-y-3">
                                <Link
                                    href="/dashboard"
                                    class="block text-gray-400 hover:text-white transition-colors"
                                >
                                    Dashboard
                                </Link>
                                <Link
                                    href="/meetings"
                                    class="block text-gray-400 hover:text-white transition-colors"
                                >
                                    Jadwal Rapat
                                </Link>
                                <Link
                                    href="/meeting-notes"
                                    class="block text-gray-400 hover:text-white transition-colors"
                                >
                                    Notulensi
                                </Link>
                            </div>
                        </div>

                        <!-- Contact -->
                        <div>
                            <h4 class="text-lg font-semibold mb-6">Kontak</h4>
                            <div class="space-y-3 text-gray-400">
                                <p>BAPPEDA Provinsi Lampung</p>
                                <p>Bandar Lampung</p>
                                <p>Provinsi Lampung</p>
                            </div>
                        </div>
                    </div>

                    <div
                        class="border-t border-gray-800 mt-12 pt-8 text-center text-gray-400"
                    >
                        <p>
                            &copy; 2025 BAPPEDA Provinsi Lampung. All rights
                            reserved.
                        </p>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Scroll to Top Button -->
        <button
            @click="scrollToTop"
            class="fixed bottom-8 right-8 w-14 h-14 bg-gradient-to-br from-yellow-400 to-orange-400 text-white rounded-full shadow-lg hover:shadow-xl hover:scale-110 transition-all duration-300 z-50 flex items-center justify-center"
        >
            <span class="text-xl">↑</span>
        </button>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";

// Props
defineProps({
    teams: Array,
});

// Methods
const scrollToSection = (sectionId) => {
    const element = document.getElementById(sectionId);
    if (element) {
        element.scrollIntoView({ behavior: "smooth" });
    }
};

const scrollToTop = () => {
    window.scrollTo({ top: 0, behavior: "smooth" });
};
</script>
