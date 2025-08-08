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
                            <div>
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

        <!-- Hero Section - BAPPEDA with Logo Background -->
        <section
            class="pt-24 pb-20 bg-gradient-to-br from-blue-50 via-white to-green-50 relative overflow-hidden font-sans"
        >
            <!-- Logo Background -->
            <div class="absolute inset-0 flex items-center justify-center opacity-5">
                <img
                    src="/logo.png"
                    alt="BAPPEDA Background"
                    class="w-96 h-96 object-contain"
                />
            </div>
            <!-- Colorful geometric floating elements -->
            <div class="absolute inset-0 overflow-hidden">
                <!-- Blue circle -->
                <div
                    class="absolute top-32 left-20 w-24 h-24 bg-blue-500 rounded-full opacity-80"
                ></div>
                <!-- Yellow square -->
                <div
                    class="absolute top-20 left-40 w-16 h-16 bg-yellow-400 transform rotate-45 opacity-70"
                ></div>
                <!-- Green circle -->
                <div
                    class="absolute top-80 right-32 w-20 h-20 bg-green-500 rounded-full opacity-75"
                ></div>
                <!-- Orange square -->
                <div
                    class="absolute bottom-40 left-32 w-12 h-12 bg-orange-500 transform rotate-12 opacity-80"
                ></div>
                <!-- Purple circle -->
                <div
                    class="absolute bottom-32 right-40 w-16 h-16 bg-purple-500 rounded-full opacity-70"
                ></div>
                <!-- Cyan diamond -->
                <div
                    class="absolute top-1/2 right-20 w-14 h-14 bg-cyan-500 transform rotate-45 opacity-75"
                ></div>
                <!-- Pink circle -->
                <div
                    class="absolute top-64 left-1/4 w-10 h-10 bg-pink-500 rounded-full opacity-80"
                ></div>
                <!-- Red square -->
                <div
                    class="absolute bottom-64 right-1/4 w-8 h-8 bg-red-500 transform rotate-12 opacity-75"
                ></div>
            </div>

            <div class="container mx-auto px-6 py-16 relative z-10">
                <div class="max-w-7xl mx-auto">
                    <!-- Hero Header -->
                    <div class="text-center mb-16">
                        <div class="flex items-center justify-center space-x-6 mb-8">
                            <img
                                src="/logo.png"
                                alt="BAPPEDA Lampung Logo"
                                class="w-24 h-24 object-contain drop-shadow-lg"
                            />
                            <div class="text-left">
                                <h1 class="text-4xl font-black text-gray-900 font-sans">
                                    BAPPEDA
                                </h1>
                                <p class="text-xl text-blue-600 font-bold font-sans">
                                    Provinsi Lampung
                                </p>
                                <p class="text-lg text-gray-600 font-medium font-sans">
                                    Bidang Ekonomi
                                </p>
                            </div>
                        </div>
                        
                        <!-- Vision Banner -->
                        <div class="bg-gradient-to-r from-blue-600 to-green-600 text-white px-8 py-4 rounded-2xl shadow-xl inline-block mb-8">
                            <h2 class="text-2xl md:text-3xl font-black font-sans">
                                "BERSAMA LAMPUNG MAJU MENUJU INDONESIA EMAS"
                            </h2>
                        </div>
                    </div>

                    <!-- Main Content Grid -->
                    <div class="grid lg:grid-cols-2 gap-16 items-start">
                        <!-- Content Side -->
                        <div class="space-y-8">
                            <!-- About Section -->
                            <div class="bg-white rounded-3xl p-8 shadow-xl border border-gray-100">
                                <h3 class="text-2xl font-bold text-gray-900 mb-6 font-sans flex items-center">
                                    <span class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center mr-3">
                                        <span class="text-white text-sm">📋</span>
                                    </span>
                                    Tentang Bidang Ekonomi
                                </h3>
                                <p class="text-gray-700 leading-relaxed mb-6 font-sans">
                                    Bidang Ekonomi BAPPEDA Provinsi Lampung berperan penting dalam merancang kebijakan pembangunan ekonomi daerah, dengan fokus pada sektor-sektor produktif seperti <span class="font-semibold text-blue-600">pertanian, industri, perdagangan, UMKM, ketenagakerjaan, dan pariwisata</span>.
                                </p>
                                <p class="text-gray-700 leading-relaxed mb-6 font-sans">
                                    Tugasnya meliputi penyusunan dokumen perencanaan ekonomi, analisis tren, evaluasi sektor, dan koordinasi lintas instansi. Bidang ini juga mengawal program prioritas pengentasan kemiskinan dan mendorong pertumbuhan ekonomi.
                                </p>
                                <p class="text-gray-700 leading-relaxed font-sans">
                                    Untuk menghadapi dinamika global, Bidang Ekonomi terus melakukan inovasi kebijakan dan membangun sinergi antar pelaku ekonomi untuk meningkatkan daya saing daerah dan menciptakan lapangan kerja berkualitas.
                                </p>
                            </div>

                            <!-- Mission Section -->
                            <div class="bg-white rounded-3xl p-8 shadow-xl border border-gray-100">
                                <h3 class="text-2xl font-bold text-gray-900 mb-6 font-sans flex items-center">
                                    <span class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center mr-3">
                                        <span class="text-white text-sm">🎯</span>
                                    </span>
                                    Misi Kami
                                </h3>
                                <div class="space-y-4">
                                    <div class="flex items-start space-x-4">
                                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                            <span class="text-blue-600 font-bold text-sm">1</span>
                                        </div>
                                        <p class="text-gray-700 font-sans">
                                            Mendorong Pertumbuhan Ekonomi yang Inklusif, Mandiri, dan Inovatif
                                        </p>
                                    </div>
                                    <div class="flex items-start space-x-4">
                                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                            <span class="text-green-600 font-bold text-sm">2</span>
                                        </div>
                                        <p class="text-gray-700 font-sans">
                                            Memperkuat Sumber Daya Manusia yang Unggul dan Produktif
                                        </p>
                                    </div>
                                    <div class="flex items-start space-x-4">
                                        <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                            <span class="text-purple-600 font-bold text-sm">3</span>
                                        </div>
                                        <p class="text-gray-700 font-sans">
                                            Meningkatkan Kehidupan Masyarakat Beradab, Berkeadilan, dan Berkelanjutan serta Tata Kelola Pemerintahan
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Visual Side with Statistics -->
                        <div class="flex justify-center lg:justify-end">
                            <div class="relative w-full max-w-lg">
                                <!-- Statistics Cards -->
                                <div class="grid grid-cols-2 gap-6">
                                    <!-- Data Card 1 - Sektor Ekonomi -->
                                    <div class="bg-white border border-gray-200 rounded-3xl p-6 shadow-xl hover:shadow-2xl transition-all duration-300">
                                        <div class="bg-blue-500 text-white text-xs font-semibold px-3 py-1 rounded-full mb-4 inline-block font-sans">
                                            Fokus Utama
                                        </div>
                                        <div class="text-3xl mb-2">🏭</div>
                                        <h4 class="font-bold text-gray-900 text-lg mb-2 font-sans">
                                            6+
                                        </h4>
                                        <p class="text-gray-600 text-sm font-sans leading-relaxed">
                                            Sektor Ekonomi Produktif
                                        </p>
                                    </div>

                                    <!-- Data Card 2 - Koordinasi Dinas -->
                                    <div class="bg-white border border-gray-200 rounded-3xl p-6 shadow-xl hover:shadow-2xl transition-all duration-300">
                                        <div class="bg-green-500 text-white text-xs font-semibold px-3 py-1 rounded-full mb-4 inline-block font-sans">
                                            Kerjasama
                                        </div>
                                        <div class="text-3xl mb-2">🤝</div>
                                        <h4 class="font-bold text-gray-900 text-lg mb-2 font-sans">
                                            9+
                                        </h4>
                                        <p class="text-gray-600 text-sm font-sans leading-relaxed">
                                            Dinas Koordinasi
                                        </p>
                                    </div>

                                    <!-- Data Card 3 - Tim Ahli -->
                                    <div class="bg-white border border-gray-200 rounded-3xl p-6 shadow-xl hover:shadow-2xl transition-all duration-300">
                                        <div class="bg-purple-500 text-white text-xs font-semibold px-3 py-1 rounded-full mb-4 inline-block font-sans">
                                            SDM
                                        </div>
                                        <div class="text-3xl mb-2">👥</div>
                                        <h4 class="font-bold text-gray-900 text-lg mb-2 font-sans">
                                            15+
                                        </h4>
                                        <p class="text-gray-600 text-sm font-sans leading-relaxed">
                                            Tim Profesional
                                        </p>
                                    </div>

                                    <!-- Data Card 4 - Program -->
                                    <div class="bg-white border border-gray-200 rounded-3xl p-6 shadow-xl hover:shadow-2xl transition-all duration-300">
                                        <div class="bg-orange-500 text-white text-xs font-semibold px-3 py-1 rounded-full mb-4 inline-block font-sans">
                                            Program
                                        </div>
                                        <div class="text-3xl mb-2">📈</div>
                                        <h4 class="font-bold text-gray-900 text-lg mb-2 font-sans">
                                            Berkelanjutan
                                        </h4>
                                        <p class="text-gray-600 text-sm font-sans leading-relaxed">
                                            Pembangunan Ekonomi
                                        </p>
                                    </div>
                                </div>

                                <!-- CTA Section -->
                                <div class="mt-8 text-center">
                                    <template v-if="$page.props.auth?.user">
                                        <Link
                                            href="/dashboard"
                                            class="inline-block px-8 py-4 bg-gradient-to-r from-blue-500 to-green-500 text-white rounded-2xl font-semibold hover:from-blue-600 hover:to-green-600 transition-all duration-300 shadow-xl font-sans"
                                        >
                                            Masuk ke Dashboard
                                        </Link>
                                    </template>
                                    <template v-else>
                                        <Link
                                            href="/register"
                                            class="inline-block px-8 py-4 bg-gradient-to-r from-blue-500 to-green-500 text-white rounded-2xl font-semibold hover:from-blue-600 hover:to-green-600 transition-all duration-300 shadow-xl font-sans mb-4"
                                        >
                                            Bergabung Sekarang
                                        </Link>
                                        <br />
                                        <Link
                                            href="/login"
                                            class="inline-block px-6 py-3 bg-white border-2 border-gray-200 text-gray-700 rounded-2xl font-semibold hover:bg-gray-50 transition-colors font-sans"
                                        >
                                            Login
                                        </Link>
                                    </template>
                                </div>

                                <!-- Floating elements -->
                                <div class="absolute -top-6 -left-6 w-8 h-8 bg-yellow-400 rounded-full opacity-80"></div>
                                <div class="absolute -bottom-6 -right-6 w-6 h-6 bg-pink-500 transform rotate-45 opacity-80"></div>
                                <div class="absolute top-1/2 -left-8 w-4 h-4 bg-cyan-500 rounded-full opacity-80"></div>
                            </div>
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
                                <div>
                                    <h3 class="text-xl font-bold">
                                        EKONOMI BAPPEDA
                                    </h3>
                                    <p class="text-yellow-400 font-medium">
                                        PROVINSI LAMPUNG
                                    </p>
                                </div>
                            </div>
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
