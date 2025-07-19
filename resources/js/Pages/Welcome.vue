<template>
    <div class="min-h-screen bg-gray-50 scroll-smooth">
        <!-- Navigation -->
        <nav
            class="bg-white/95 backdrop-blur-sm shadow-lg border-b border-gray-200 fixed w-full top-0 z-50"
        >
            <div class="container mx-auto px-6">
                <div class="flex justify-between items-center py-4">
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center">
                            <!-- Enhanced Logo -->
                            <div
                                class="w-14 h-14 bg-gradient-to-br from-yellow-400 via-orange-400 to-yellow-300 rounded-xl flex items-center justify-center shadow-lg"
                            >
                                <span class="text-white font-bold text-2xl"
                                    >B</span
                                >
                            </div>
                            <div class="ml-4">
                                <h1 class="text-2xl font-bold text-gray-900">
                                    BAPPEDA
                                </h1>
                                <p class="text-sm text-gray-600 font-medium">
                                    Provinsi Lampung
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center space-x-4">
                        <template v-if="$page.props.auth?.user">
                            <Link
                                :href="route('dashboard')"
                                class="inline-flex items-center bg-gradient-to-r from-yellow-400 to-orange-400 text-white px-6 py-3 rounded-xl hover:shadow-xl hover:scale-105 transition-all duration-300 font-semibold"
                            >
                                <span class="mr-2">🏠</span>
                                Dashboard
                            </Link>
                        </template>
                        <template v-else>
                            <Link
                                :href="route('login')"
                                class="text-gray-700 hover:text-yellow-600 transition-all duration-300 font-medium"
                            >
                                Masuk
                            </Link>
                            <Link
                                :href="route('register')"
                                class="inline-flex items-center bg-gradient-to-r from-yellow-400 to-orange-400 text-white px-6 py-3 rounded-xl hover:shadow-xl hover:scale-105 transition-all duration-300 font-semibold"
                            >
                                <span class="mr-2">📝</span>
                                Daftar
                            </Link>
                        </template>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section
            class="relative min-h-screen flex items-center bg-gradient-to-br from-yellow-400 via-orange-400 to-yellow-300 overflow-hidden"
        >
            <!-- Subtle Background Elements -->
            <div class="absolute inset-0 opacity-30">
                <div
                    class="absolute top-20 left-10 w-32 h-32 bg-white/20 rounded-full blur-2xl"
                ></div>
                <div
                    class="absolute bottom-20 right-20 w-40 h-40 bg-white/20 rounded-full blur-2xl"
                ></div>
                <div
                    class="absolute top-1/2 left-1/4 w-24 h-24 bg-white/15 rounded-full blur-xl"
                ></div>
            </div>

            <div class="container mx-auto px-6 py-20 relative z-10">
                <div class="max-w-7xl mx-auto">
                    <div class="grid lg:grid-cols-2 gap-16 items-center">
                        <!-- Content -->
                        <div class="text-center lg:text-left space-y-8">
                            <div
                                class="inline-flex items-center bg-white/20 backdrop-blur-sm px-6 py-3 rounded-full text-white font-medium"
                            >
                                <span class="mr-2">🏛️</span>
                                Portal Resmi BAPPEDA
                            </div>

                            <div class="space-y-4">
                                <h1
                                    class="text-6xl md:text-7xl lg:text-8xl font-bold text-white leading-tight"
                                >
                                    BAPPEDA
                                </h1>
                                <h2
                                    class="text-3xl md:text-4xl font-light text-white/90"
                                >
                                    Provinsi Lampung
                                </h2>
                            </div>

                            <p
                                class="text-xl text-white/85 leading-relaxed max-w-2xl mx-auto lg:mx-0"
                            >
                                Membangun Lampung yang Maju, Sejahtera, dan
                                Berkelanjutan melalui Perencanaan Strategis dan
                                Inovatif
                            </p>

                            <div
                                class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start pt-4"
                            >
                                <template v-if="$page.props.auth?.user">
                                    <Link
                                        :href="route('dashboard')"
                                        class="inline-flex items-center justify-center bg-white text-yellow-600 px-8 py-4 rounded-2xl font-bold text-lg hover:bg-gray-50 hover:shadow-xl transform hover:scale-105 transition-all duration-300"
                                    >
                                        <span class="mr-3">🚀</span>
                                        Masuk Dashboard
                                    </Link>
                                </template>
                                <template v-else>
                                    <Link
                                        :href="route('login')"
                                        class="inline-flex items-center justify-center bg-white text-yellow-600 px-8 py-4 rounded-2xl font-bold text-lg hover:bg-gray-50 hover:shadow-xl transform hover:scale-105 transition-all duration-300"
                                    >
                                        <span class="mr-3">🔐</span>
                                        Masuk Sistem
                                    </Link>
                                </template>
                                <button
                                    @click="scrollToSection('about')"
                                    class="inline-flex items-center justify-center border-2 border-white text-white px-8 py-4 rounded-2xl font-bold text-lg hover:bg-white hover:text-yellow-600 hover:shadow-xl transform hover:scale-105 transition-all duration-300"
                                >
                                    <span class="mr-3">📖</span>
                                    Pelajari Lebih Lanjut
                                </button>
                            </div>
                        </div>

                        <!-- Visual Element -->
                        <div class="flex justify-center lg:justify-end">
                            <div class="relative">
                                <div
                                    class="w-80 h-80 bg-white/20 backdrop-blur-md rounded-3xl flex items-center justify-center shadow-2xl border border-white/30"
                                >
                                    <div
                                        class="w-64 h-64 bg-white/30 backdrop-blur-sm rounded-2xl flex items-center justify-center"
                                    >
                                        <div
                                            class="w-32 h-32 bg-white rounded-xl flex items-center justify-center shadow-lg"
                                        >
                                            <span
                                                class="text-5xl text-yellow-600"
                                                >🏛️</span
                                            >
                                        </div>
                                    </div>
                                </div>
                                <!-- Clean floating elements -->
                                <div
                                    class="absolute -top-6 -right-6 w-20 h-20 bg-white/90 rounded-2xl flex items-center justify-center shadow-lg"
                                >
                                    <span class="text-3xl">📊</span>
                                </div>
                                <div
                                    class="absolute -bottom-6 -left-6 w-20 h-20 bg-white/90 rounded-2xl flex items-center justify-center shadow-lg"
                                >
                                    <span class="text-3xl">💡</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Dinas Section -->
        <section class="py-24 bg-white">
            <div class="container mx-auto px-6">
                <div class="max-w-7xl mx-auto">
                    <!-- Section Header -->
                    <div class="text-center mb-16">
                        <div
                            class="inline-flex items-center bg-gradient-to-r from-yellow-400 to-orange-400 text-white px-6 py-3 rounded-full text-sm font-semibold mb-6 shadow-lg"
                        >
                            <span class="mr-2">🏢</span>
                            Dinas di Bawah Naungan BAPPEDA
                        </div>
                        <h2
                            class="text-4xl md:text-5xl font-bold text-gray-900 mb-6"
                        >
                            Sektor Pembangunan Daerah
                        </h2>
                        <p
                            class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed"
                        >
                            Berbagai sektor strategis yang dikoordinasikan oleh
                            BAPPEDA untuk pembangunan Provinsi Lampung yang
                            berkelanjutan
                        </p>
                    </div>

                    <!-- Dinas Grid -->
                    <div
                        class="grid grid-cols-2 md:grid-cols-5 gap-6 max-w-6xl mx-auto"
                    >
                        <!-- Ekonomi -->
                        <div
                            class="group bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-6 text-center hover:shadow-xl hover:scale-105 transition-all duration-300 border border-blue-200"
                        >
                            <div
                                class="w-16 h-16 bg-gradient-to-br from-blue-400 to-blue-500 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg group-hover:scale-110 transition-transform duration-300"
                            >
                                <span class="text-2xl text-white">💰</span>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">
                                Ekonomi
                            </h3>
                            <p class="text-sm text-gray-600">
                                Pengembangan Ekonomi Daerah
                            </p>
                        </div>

                        <!-- Infrastruktur -->
                        <div
                            class="group bg-gradient-to-br from-orange-50 to-orange-100 rounded-2xl p-6 text-center hover:shadow-xl hover:scale-105 transition-all duration-300 border border-orange-200"
                        >
                            <div
                                class="w-16 h-16 bg-gradient-to-br from-orange-400 to-orange-500 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg group-hover:scale-110 transition-transform duration-300"
                            >
                                <span class="text-2xl text-white">🏗️</span>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">
                                Infrastruktur
                            </h3>
                            <p class="text-sm text-gray-600">
                                Pembangunan & Pemeliharaan
                            </p>
                        </div>

                        <!-- Kemiskinan -->
                        <div
                            class="group bg-gradient-to-br from-green-50 to-green-100 rounded-2xl p-6 text-center hover:shadow-xl hover:scale-105 transition-all duration-300 border border-green-200"
                        >
                            <div
                                class="w-16 h-16 bg-gradient-to-br from-green-400 to-green-500 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg group-hover:scale-110 transition-transform duration-300"
                            >
                                <span class="text-2xl text-white">🤝</span>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">
                                Kemiskinan
                            </h3>
                            <p class="text-sm text-gray-600">
                                Penanggulangan Kemiskinan
                            </p>
                        </div>

                        <!-- Kependudukan -->
                        <div
                            class="group bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-2xl p-6 text-center hover:shadow-xl hover:scale-105 transition-all duration-300 border border-yellow-200"
                        >
                            <div
                                class="w-16 h-16 bg-gradient-to-br from-yellow-400 to-yellow-500 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg group-hover:scale-110 transition-transform duration-300"
                            >
                                <span class="text-2xl text-white">📊</span>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">
                                Kependudukan
                            </h3>
                            <p class="text-sm text-gray-600">
                                Data & Statistik Penduduk
                            </p>
                        </div>

                        <!-- Kesehatan -->
                        <div
                            class="group bg-gradient-to-br from-red-50 to-red-100 rounded-2xl p-6 text-center hover:shadow-xl hover:scale-105 transition-all duration-300 border border-red-200"
                        >
                            <div
                                class="w-16 h-16 bg-gradient-to-br from-red-400 to-red-500 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg group-hover:scale-110 transition-transform duration-300"
                            >
                                <span class="text-2xl text-white">⚕️</span>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">
                                Kesehatan
                            </h3>
                            <p class="text-sm text-gray-600">
                                Pelayanan Kesehatan
                            </p>
                        </div>

                        <!-- Lingkungan Hidup -->
                        <div
                            class="group bg-gradient-to-br from-emerald-50 to-emerald-100 rounded-2xl p-6 text-center hover:shadow-xl hover:scale-105 transition-all duration-300 border border-emerald-200"
                        >
                            <div
                                class="w-16 h-16 bg-gradient-to-br from-emerald-400 to-emerald-500 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg group-hover:scale-110 transition-transform duration-300"
                            >
                                <span class="text-2xl text-white">🌱</span>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">
                                Lingkungan Hidup
                            </h3>
                            <p class="text-sm text-gray-600">
                                Konservasi & Perlindungan
                            </p>
                        </div>

                        <!-- Pariwisata & Kebudayaan -->
                        <div
                            class="group bg-gradient-to-br from-cyan-50 to-cyan-100 rounded-2xl p-6 text-center hover:shadow-xl hover:scale-105 transition-all duration-300 border border-cyan-200"
                        >
                            <div
                                class="w-16 h-16 bg-gradient-to-br from-cyan-400 to-cyan-500 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg group-hover:scale-110 transition-transform duration-300"
                            >
                                <span class="text-2xl text-white">🏖️</span>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">
                                Pariwisata & Kebudayaan
                            </h3>
                            <p class="text-sm text-gray-600">
                                Promosi Wisata & Budaya
                            </p>
                        </div>

                        <!-- Pemerintah & Desa -->
                        <div
                            class="group bg-gradient-to-br from-purple-50 to-purple-100 rounded-2xl p-6 text-center hover:shadow-xl hover:scale-105 transition-all duration-300 border border-purple-200"
                        >
                            <div
                                class="w-16 h-16 bg-gradient-to-br from-purple-400 to-purple-500 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg group-hover:scale-110 transition-transform duration-300"
                            >
                                <span class="text-2xl text-white">🏛️</span>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">
                                Pemerintah & Desa
                            </h3>
                            <p class="text-sm text-gray-600">
                                Tata Kelola Pemerintahan
                            </p>
                        </div>

                        <!-- Pendidikan -->
                        <div
                            class="group bg-gradient-to-br from-indigo-50 to-indigo-100 rounded-2xl p-6 text-center hover:shadow-xl hover:scale-105 transition-all duration-300 border border-indigo-200"
                        >
                            <div
                                class="w-16 h-16 bg-gradient-to-br from-indigo-400 to-indigo-500 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg group-hover:scale-110 transition-transform duration-300"
                            >
                                <span class="text-2xl text-white">📚</span>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">
                                Pendidikan
                            </h3>
                            <p class="text-sm text-gray-600">
                                Peningkatan Kualitas SDM
                            </p>
                        </div>

                        <!-- Sosial -->
                        <div
                            class="group bg-gradient-to-br from-pink-50 to-pink-100 rounded-2xl p-6 text-center hover:shadow-xl hover:scale-105 transition-all duration-300 border border-pink-200"
                        >
                            <div
                                class="w-16 h-16 bg-gradient-to-br from-pink-400 to-pink-500 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg group-hover:scale-110 transition-transform duration-300"
                            >
                                <span class="text-2xl text-white">❤️</span>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">
                                Sosial
                            </h3>
                            <p class="text-sm text-gray-600">
                                Kesejahteraan Masyarakat
                            </p>
                        </div>
                    </div>

                    <!-- Call to Action -->
                    <div class="text-center mt-16">
                        <div
                            class="bg-gradient-to-r from-yellow-50 to-orange-50 rounded-2xl p-8 border border-yellow-200"
                        >
                            <h3 class="text-2xl font-bold text-gray-900 mb-4">
                                Koordinasi Terintegrasi
                            </h3>
                            <p class="text-gray-600 mb-6 max-w-2xl mx-auto">
                                BAPPEDA berperan sebagai koordinator strategis
                                dalam perencanaan pembangunan lintas sektor
                                untuk mencapai visi Lampung yang maju dan
                                berkelanjutan.
                            </p>
                            <button
                                @click="scrollToSection('about')"
                                class="inline-flex items-center bg-gradient-to-r from-yellow-400 to-orange-400 text-white px-8 py-3 rounded-xl hover:shadow-xl hover:scale-105 transition-all duration-300 font-semibold"
                            >
                                <span class="mr-2">📋</span>
                                Pelajari Program Kerja
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Dinas Spesifik Section -->
        <section class="py-24 bg-gradient-to-br from-gray-50 to-gray-100">
            <div class="container mx-auto px-6">
                <div class="max-w-7xl mx-auto">
                    <!-- Section Header -->
                    <div class="text-center mb-16">
                        <div
                            class="inline-flex items-center bg-gradient-to-r from-blue-500 to-purple-600 text-white px-6 py-3 rounded-full text-sm font-semibold mb-6 shadow-lg"
                        >
                            <span class="mr-2">🏛️</span>
                            Dalam lingkup Bidang Perekonomian
                        </div>
                        <h2
                            class="text-4xl md:text-5xl font-bold text-gray-900 mb-6"
                        >
                            Dinas-Dinas Strategis BAPPEDA
                        </h2>
                        <p
                            class="text-xl text-gray-600 max-w-4xl mx-auto leading-relaxed"
                        >
                            Dalam lingkup Bidang Perekonomian, sejumlah dinas
                            menjalin kolaborasi strategis guna mendukung
                            tercapainya tujuan pembangunan ekonomi yang
                            berkelanjutan.
                        </p>
                    </div>

                    <!-- Dinas Grid -->
                    <div
                        class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-8 max-w-6xl mx-auto"
                    >
                        <!-- DINAS PMPTSP -->
                        <div
                            class="group bg-white rounded-2xl p-8 text-center hover:shadow-2xl hover:scale-105 transition-all duration-300 border border-gray-200"
                        >
                            <div
                                class="w-20 h-20 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg group-hover:scale-110 transition-transform duration-300"
                            >
                                <span class="text-2xl text-white">💼</span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3">
                                DINAS PMPTSP
                            </h3>
                            <p class="text-gray-600 leading-relaxed mb-4">
                                Dinas Penanaman Modal dan Pelayanan Terpadu Satu
                                Pintu
                            </p>
                            <div
                                class="inline-flex items-center bg-blue-50 text-blue-700 px-3 py-2 rounded-full text-sm font-medium"
                            >
                                <span class="mr-1">📊</span>
                                Investasi & Perizinan
                            </div>
                        </div>

                        <!-- DINAS TENAGA KERJA -->
                        <div
                            class="group bg-white rounded-2xl p-8 text-center hover:shadow-2xl hover:scale-105 transition-all duration-300 border border-gray-200"
                        >
                            <div
                                class="w-20 h-20 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg group-hover:scale-110 transition-transform duration-300"
                            >
                                <span class="text-2xl text-white">👷</span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3">
                                DINAS TENAGA KERJA
                            </h3>
                            <p class="text-gray-600 leading-relaxed mb-4">
                                Pemberdayaan dan Pengembangan Sumber Daya
                                Manusia
                            </p>
                            <div
                                class="inline-flex items-center bg-green-50 text-green-700 px-3 py-2 rounded-full text-sm font-medium"
                            >
                                <span class="mr-1">👥</span>
                                Ketenagakerjaan
                            </div>
                        </div>

                        <!-- DINAS PARIWISATA DAN EKRAF -->
                        <div
                            class="group bg-white rounded-2xl p-8 text-center hover:shadow-2xl hover:scale-105 transition-all duration-300 border border-gray-200"
                        >
                            <div
                                class="w-20 h-20 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg group-hover:scale-110 transition-transform duration-300"
                            >
                                <span class="text-2xl text-white">🎨</span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3">
                                DINAS PARIWISATA DAN EKRAF
                            </h3>
                            <p class="text-gray-600 leading-relaxed mb-4">
                                Pariwisata dan Ekonomi Kreatif Daerah
                            </p>
                            <div
                                class="inline-flex items-center bg-purple-50 text-purple-700 px-3 py-2 rounded-full text-sm font-medium"
                            >
                                <span class="mr-1">🏖️</span>
                                Tourism & Creative
                            </div>
                        </div>

                        <!-- DINAS PERINDUSTRIAN DAN PERDAGANGAN -->
                        <div
                            class="group bg-white rounded-2xl p-8 text-center hover:shadow-2xl hover:scale-105 transition-all duration-300 border border-gray-200"
                        >
                            <div
                                class="w-20 h-20 bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg group-hover:scale-110 transition-transform duration-300"
                            >
                                <span class="text-2xl text-white">🏭</span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3">
                                DINAS PERINDUSTRIAN DAN PERDAGANGAN
                            </h3>
                            <p class="text-gray-600 leading-relaxed mb-4">
                                Pengembangan Industri dan Perdagangan Daerah
                            </p>
                            <div
                                class="inline-flex items-center bg-orange-50 text-orange-700 px-3 py-2 rounded-full text-sm font-medium"
                            >
                                <span class="mr-1">⚙️</span>
                                Industri & Dagang
                            </div>
                        </div>

                        <!-- DINAS KOPERASI DAN UMKM -->
                        <div
                            class="group bg-white rounded-2xl p-8 text-center hover:shadow-2xl hover:scale-105 transition-all duration-300 border border-gray-200"
                        >
                            <div
                                class="w-20 h-20 bg-gradient-to-br from-teal-500 to-teal-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg group-hover:scale-110 transition-transform duration-300"
                            >
                                <span class="text-2xl text-white">🏪</span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3">
                                DINAS KOPERASI DAN UMKM
                            </h3>
                            <p class="text-gray-600 leading-relaxed mb-4">
                                Pemberdayaan Koperasi dan Usaha Mikro Kecil
                                Menengah
                            </p>
                            <div
                                class="inline-flex items-center bg-teal-50 text-teal-700 px-3 py-2 rounded-full text-sm font-medium"
                            >
                                <span class="mr-1">🤝</span>
                                UMKM & Koperasi
                            </div>
                        </div>

                        <!-- DINAS KETAHANAN PANGAN TP DAN HORTI -->
                        <div
                            class="group bg-white rounded-2xl p-8 text-center hover:shadow-2xl hover:scale-105 transition-all duration-300 border border-gray-200"
                        >
                            <div
                                class="w-20 h-20 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg group-hover:scale-110 transition-transform duration-300"
                            >
                                <span class="text-2xl text-white">🌾</span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3">
                                DINAS KETAHANAN PANGAN TP DAN HORTI
                            </h3>
                            <p class="text-gray-600 leading-relaxed mb-4">
                                Ketahanan Pangan, Tanaman Pangan dan
                                Hortikultura
                            </p>
                            <div
                                class="inline-flex items-center bg-emerald-50 text-emerald-700 px-3 py-2 rounded-full text-sm font-medium"
                            >
                                <span class="mr-1">🥬</span>
                                Pangan & Horti
                            </div>
                        </div>

                        <!-- DINAS PERKEBUNAN -->
                        <div
                            class="group bg-white rounded-2xl p-8 text-center hover:shadow-2xl hover:scale-105 transition-all duration-300 border border-gray-200"
                        >
                            <div
                                class="w-20 h-20 bg-gradient-to-br from-amber-500 to-amber-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg group-hover:scale-110 transition-transform duration-300"
                            >
                                <span class="text-2xl text-white">🌿</span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3">
                                DINAS PERKEBUNAN
                            </h3>
                            <p class="text-gray-600 leading-relaxed mb-4">
                                Pengembangan dan Pengelolaan Perkebunan Daerah
                            </p>
                            <div
                                class="inline-flex items-center bg-amber-50 text-amber-700 px-3 py-2 rounded-full text-sm font-medium"
                            >
                                <span class="mr-1">🌱</span>
                                Perkebunan
                            </div>
                        </div>

                        <!-- DINAS PETERNAKAN DAN KESWAN -->
                        <div
                            class="group bg-white rounded-2xl p-8 text-center hover:shadow-2xl hover:scale-105 transition-all duration-300 border border-gray-200"
                        >
                            <div
                                class="w-20 h-20 bg-gradient-to-br from-red-500 to-red-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg group-hover:scale-110 transition-transform duration-300"
                            >
                                <span class="text-2xl text-white">🐄</span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3">
                                DINAS PETERNAKAN DAN KESWAN
                            </h3>
                            <p class="text-gray-600 leading-relaxed mb-4">
                                Peternakan dan Kesehatan Hewan
                            </p>
                            <div
                                class="inline-flex items-center bg-red-50 text-red-700 px-3 py-2 rounded-full text-sm font-medium"
                            >
                                <span class="mr-1">🐮</span>
                                Peternakan
                            </div>
                        </div>

                        <!-- DINAS KELAUTAN DAN PERIKANAN -->
                        <div
                            class="group bg-white rounded-2xl p-8 text-center hover:shadow-2xl hover:scale-105 transition-all duration-300 border border-gray-200"
                        >
                            <div
                                class="w-20 h-20 bg-gradient-to-br from-cyan-500 to-cyan-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg group-hover:scale-110 transition-transform duration-300"
                            >
                                <span class="text-2xl text-white">🐟</span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3">
                                DINAS KELAUTAN DAN PERIKANAN
                            </h3>
                            <p class="text-gray-600 leading-relaxed mb-4">
                                Pengelolaan Sumber Daya Kelautan dan Perikanan
                            </p>
                            <div
                                class="inline-flex items-center bg-cyan-50 text-cyan-700 px-3 py-2 rounded-full text-sm font-medium"
                            >
                                <span class="mr-1">🌊</span>
                                Kelautan & Perikanan
                            </div>
                        </div>
                    </div>

                    <!-- Collaboration Info -->
                    <div class="text-center mt-16">
                        <div
                            class="grid md:grid-cols-2 gap-8 max-w-4xl mx-auto"
                        >
                            <!-- Left Card -->
                            <div
                                class="bg-gradient-to-br from-blue-50 to-purple-50 rounded-2xl p-8 border border-blue-200"
                            >
                                <div
                                    class="w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg"
                                >
                                    <span class="text-2xl text-white">🤝</span>
                                </div>
                                <h3
                                    class="text-xl font-bold text-gray-900 mb-4"
                                >
                                    Kolaborasi Strategis
                                </h3>
                                <p class="text-gray-600 leading-relaxed">
                                    Sinergi antar dinas dalam bidang
                                    perekonomian untuk menciptakan ekosistem
                                    pembangunan yang terintegrasi dan
                                    berkelanjutan.
                                </p>
                            </div>

                            <!-- Right Card -->
                            <div
                                class="bg-gradient-to-br from-green-50 to-teal-50 rounded-2xl p-8 border border-green-200"
                            >
                                <div
                                    class="w-16 h-16 bg-gradient-to-br from-green-500 to-teal-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg"
                                >
                                    <span class="text-2xl text-white">📈</span>
                                </div>
                                <h3
                                    class="text-xl font-bold text-gray-900 mb-4"
                                >
                                    Pembangunan Ekonomi
                                </h3>
                                <p class="text-gray-600 leading-relaxed">
                                    Mendukung tujuan pembangunan ekonomi yang
                                    berkelanjutan melalui koordinasi program dan
                                    kebijakan lintas sektor.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Anggota Bidang Perekonomian Section -->
        <section class="py-24 bg-white">
            <div class="container mx-auto px-6">
                <div class="max-w-7xl mx-auto">
                    <!-- Section Header -->
                    <div class="text-center mb-16">
                        <div
                            class="inline-flex items-center bg-gradient-to-r from-indigo-500 to-purple-600 text-white px-6 py-3 rounded-full text-sm font-semibold mb-6 shadow-lg"
                        >
                            <span class="mr-2">👥</span>
                            Tim Bidang Perekonomian
                        </div>
                        <h2
                            class="text-4xl md:text-5xl font-bold text-gray-900 mb-6"
                        >
                            Anggota Bidang Perekonomian dan Pembangunan BAPPEDA
                            Provinsi Lampung
                        </h2>
                        <p
                            class="text-xl text-gray-600 max-w-4xl mx-auto leading-relaxed"
                        >
                            Tim profesional yang bertanggung jawab dalam
                            perencanaan dan koordinasi pembangunan ekonomi
                            daerah
                        </p>
                    </div>

                    <!-- Leadership Row -->
                    <div class="flex justify-center mb-12">
                        <div
                            class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-2xl"
                        >
                            <!-- Leader 1 -->
                            <div
                                class="group bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-8 text-center hover:shadow-xl hover:scale-105 transition-all duration-300 border border-blue-200"
                            >
                                <div
                                    class="w-24 h-24 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg group-hover:scale-110 transition-transform duration-300"
                                >
                                    <span class="text-3xl text-white">👤</span>
                                </div>
                                <h3
                                    class="text-xl font-bold text-gray-900 mb-2"
                                >
                                    NAMA
                                </h3>
                                <p class="text-blue-600 font-semibold mb-2">
                                    Kepala Bidang
                                </p>
                                <p class="text-gray-600 text-sm">
                                    Perekonomian dan Pembangunan
                                </p>
                            </div>

                            <!-- Leader 2 -->
                            <div
                                class="group bg-gradient-to-br from-purple-50 to-pink-50 rounded-2xl p-8 text-center hover:shadow-xl hover:scale-105 transition-all duration-300 border border-purple-200"
                            >
                                <div
                                    class="w-24 h-24 bg-gradient-to-br from-purple-500 to-pink-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg group-hover:scale-110 transition-transform duration-300"
                                >
                                    <span class="text-3xl text-white">👤</span>
                                </div>
                                <h3
                                    class="text-xl font-bold text-gray-900 mb-2"
                                >
                                    NAMA
                                </h3>
                                <p class="text-purple-600 font-semibold mb-2">
                                    Wakil Kepala Bidang
                                </p>
                                <p class="text-gray-600 text-sm">
                                    Perekonomian dan Pembangunan
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Team Members Grid -->
                    <div class="grid grid-cols-2 md:grid-cols-5 gap-6 mb-12">
                        <!-- Team Member 1 -->
                        <div
                            class="group bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-6 text-center hover:shadow-xl hover:scale-105 transition-all duration-300 border border-gray-200"
                        >
                            <div
                                class="w-16 h-16 bg-gradient-to-br from-gray-500 to-gray-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg group-hover:scale-110 transition-transform duration-300"
                            >
                                <span class="text-xl text-white">👤</span>
                            </div>
                            <h4 class="text-lg font-bold text-gray-900 mb-1">
                                NAMA
                            </h4>
                            <p class="text-gray-600 text-sm">Anggota Tim</p>
                        </div>

                        <!-- Team Member 2 -->
                        <div
                            class="group bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-6 text-center hover:shadow-xl hover:scale-105 transition-all duration-300 border border-gray-200"
                        >
                            <div
                                class="w-16 h-16 bg-gradient-to-br from-gray-500 to-gray-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg group-hover:scale-110 transition-transform duration-300"
                            >
                                <span class="text-xl text-white">👤</span>
                            </div>
                            <h4 class="text-lg font-bold text-gray-900 mb-1">
                                NAMA
                            </h4>
                            <p class="text-gray-600 text-sm">Anggota Tim</p>
                        </div>

                        <!-- Team Member 3 -->
                        <div
                            class="group bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-6 text-center hover:shadow-xl hover:scale-105 transition-all duration-300 border border-gray-200"
                        >
                            <div
                                class="w-16 h-16 bg-gradient-to-br from-gray-500 to-gray-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg group-hover:scale-110 transition-transform duration-300"
                            >
                                <span class="text-xl text-white">👤</span>
                            </div>
                            <h4 class="text-lg font-bold text-gray-900 mb-1">
                                NAMA
                            </h4>
                            <p class="text-gray-600 text-sm">Anggota Tim</p>
                        </div>

                        <!-- Team Member 4 -->
                        <div
                            class="group bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-6 text-center hover:shadow-xl hover:scale-105 transition-all duration-300 border border-gray-200"
                        >
                            <div
                                class="w-16 h-16 bg-gradient-to-br from-gray-500 to-gray-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg group-hover:scale-110 transition-transform duration-300"
                            >
                                <span class="text-xl text-white">👤</span>
                            </div>
                            <h4 class="text-lg font-bold text-gray-900 mb-1">
                                NAMA
                            </h4>
                            <p class="text-gray-600 text-sm">Anggota Tim</p>
                        </div>

                        <!-- Team Member 5 -->
                        <div
                            class="group bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-6 text-center hover:shadow-xl hover:scale-105 transition-all duration-300 border border-gray-200"
                        >
                            <div
                                class="w-16 h-16 bg-gradient-to-br from-gray-500 to-gray-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg group-hover:scale-110 transition-transform duration-300"
                            >
                                <span class="text-xl text-white">👤</span>
                            </div>
                            <h4 class="text-lg font-bold text-gray-900 mb-1">
                                NAMA
                            </h4>
                            <p class="text-gray-600 text-sm">Anggota Tim</p>
                        </div>

                        <!-- Team Member 6 -->
                        <div
                            class="group bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-6 text-center hover:shadow-xl hover:scale-105 transition-all duration-300 border border-gray-200"
                        >
                            <div
                                class="w-16 h-16 bg-gradient-to-br from-gray-500 to-gray-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg group-hover:scale-110 transition-transform duration-300"
                            >
                                <span class="text-xl text-white">👤</span>
                            </div>
                            <h4 class="text-lg font-bold text-gray-900 mb-1">
                                NAMA
                            </h4>
                            <p class="text-gray-600 text-sm">Anggota Tim</p>
                        </div>

                        <!-- Team Member 7 -->
                        <div
                            class="group bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-6 text-center hover:shadow-xl hover:scale-105 transition-all duration-300 border border-gray-200"
                        >
                            <div
                                class="w-16 h-16 bg-gradient-to-br from-gray-500 to-gray-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg group-hover:scale-110 transition-transform duration-300"
                            >
                                <span class="text-xl text-white">👤</span>
                            </div>
                            <h4 class="text-lg font-bold text-gray-900 mb-1">
                                NAMA
                            </h4>
                            <p class="text-gray-600 text-sm">Anggota Tim</p>
                        </div>

                        <!-- Team Member 8 -->
                        <div
                            class="group bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-6 text-center hover:shadow-xl hover:scale-105 transition-all duration-300 border border-gray-200"
                        >
                            <div
                                class="w-16 h-16 bg-gradient-to-br from-gray-500 to-gray-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg group-hover:scale-110 transition-transform duration-300"
                            >
                                <span class="text-xl text-white">👤</span>
                            </div>
                            <h4 class="text-lg font-bold text-gray-900 mb-1">
                                NAMA
                            </h4>
                            <p class="text-gray-600 text-sm">Anggota Tim</p>
                        </div>

                        <!-- Team Member 9 -->
                        <div
                            class="group bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-6 text-center hover:shadow-xl hover:scale-105 transition-all duration-300 border border-gray-200"
                        >
                            <div
                                class="w-16 h-16 bg-gradient-to-br from-gray-500 to-gray-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg group-hover:scale-110 transition-transform duration-300"
                            >
                                <span class="text-xl text-white">👤</span>
                            </div>
                            <h4 class="text-lg font-bold text-gray-900 mb-1">
                                NAMA
                            </h4>
                            <p class="text-gray-600 text-sm">Anggota Tim</p>
                        </div>

                        <!-- Team Member 10 -->
                        <div
                            class="group bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-6 text-center hover:shadow-xl hover:scale-105 transition-all duration-300 border border-gray-200"
                        >
                            <div
                                class="w-16 h-16 bg-gradient-to-br from-gray-500 to-gray-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg group-hover:scale-110 transition-transform duration-300"
                            >
                                <span class="text-xl text-white">👤</span>
                            </div>
                            <h4 class="text-lg font-bold text-gray-900 mb-1">
                                NAMA
                            </h4>
                            <p class="text-gray-600 text-sm">Anggota Tim</p>
                        </div>
                    </div>

                    <!-- Additional Team Members Row -->
                    <div class="flex justify-center">
                        <div
                            class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-3xl"
                        >
                            <!-- Team Member 11 -->
                            <div
                                class="group bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-6 text-center hover:shadow-xl hover:scale-105 transition-all duration-300 border border-gray-200"
                            >
                                <div
                                    class="w-16 h-16 bg-gradient-to-br from-gray-500 to-gray-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg group-hover:scale-110 transition-transform duration-300"
                                >
                                    <span class="text-xl text-white">👤</span>
                                </div>
                                <h4
                                    class="text-lg font-bold text-gray-900 mb-1"
                                >
                                    NAMA
                                </h4>
                                <p class="text-gray-600 text-sm">Anggota Tim</p>
                            </div>

                            <!-- Team Member 12 -->
                            <div
                                class="group bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-6 text-center hover:shadow-xl hover:scale-105 transition-all duration-300 border border-gray-200"
                            >
                                <div
                                    class="w-16 h-16 bg-gradient-to-br from-gray-500 to-gray-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg group-hover:scale-110 transition-transform duration-300"
                                >
                                    <span class="text-xl text-white">👤</span>
                                </div>
                                <h4
                                    class="text-lg font-bold text-gray-900 mb-1"
                                >
                                    NAMA
                                </h4>
                                <p class="text-gray-600 text-sm">Anggota Tim</p>
                            </div>

                            <!-- Team Member 13 -->
                            <div
                                class="group bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-6 text-center hover:shadow-xl hover:scale-105 transition-all duration-300 border border-gray-200"
                            >
                                <div
                                    class="w-16 h-16 bg-gradient-to-br from-gray-500 to-gray-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg group-hover:scale-110 transition-transform duration-300"
                                >
                                    <span class="text-xl text-white">👤</span>
                                </div>
                                <h4
                                    class="text-lg font-bold text-gray-900 mb-1"
                                >
                                    NAMA
                                </h4>
                                <p class="text-gray-600 text-sm">Anggota Tim</p>
                            </div>
                        </div>
                    </div>

                    <!-- Team Description -->
                    <div class="text-center mt-16">
                        <div
                            class="bg-gradient-to-r from-indigo-50 to-purple-50 rounded-2xl p-8 border border-indigo-200 max-w-4xl mx-auto"
                        >
                            <div
                                class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg"
                            >
                                <span class="text-2xl text-white">🎯</span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-4">
                                Tim Profesional
                            </h3>
                            <p class="text-gray-600 leading-relaxed text-lg">
                                Tim Bidang Perekonomian dan Pembangunan BAPPEDA
                                Provinsi Lampung terdiri dari para profesional
                                berpengalaman yang berkomitmen dalam
                                merencanakan, mengkoordinasikan, dan mengawasi
                                program-program pembangunan ekonomi daerah untuk
                                kemajuan Provinsi Lampung.
                            </p>
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
                <div class="text-center mb-16">
                    <div
                        class="inline-flex items-center bg-gradient-to-r from-yellow-400 to-orange-400 text-white px-6 py-3 rounded-full text-sm font-semibold mb-6 shadow-lg"
                    >
                        <span class="mr-2">👥</span>
                        Tim Kerja
                    </div>
                    <h2 class="text-4xl font-bold text-gray-900 mb-6">
                        Tim BAPPEDA Provinsi Lampung
                    </h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        Tim profesional yang berdedikasi untuk pembangunan
                        Lampung
                    </p>
                </div>

                <div
                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto"
                >
                    <div
                        v-for="team in teams"
                        :key="team.id"
                        class="bg-white border border-gray-200 rounded-2xl p-6 text-center hover:shadow-xl hover:scale-105 transition-all duration-300"
                    >
                        <div
                            class="w-20 h-20 bg-gradient-to-br from-yellow-400 to-orange-400 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg"
                        >
                            <span class="text-white font-bold text-xl">{{
                                team.name.charAt(0)
                            }}</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">
                            {{ team.name }}
                        </h3>
                        <p class="text-gray-600">{{ team.description }}</p>
                        <div class="mt-4">
                            <span
                                class="inline-flex items-center bg-gradient-to-r from-yellow-100 to-orange-100 text-yellow-800 px-3 py-1 rounded-full text-xs font-medium"
                            >
                                <span class="mr-1">👔</span>
                                Koordinasi Tim Kerja
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Enhanced Footer -->
        <footer class="bg-gray-900 text-white relative overflow-hidden">
            <!-- Background decoration -->
            <div
                class="absolute inset-0 bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900"
            ></div>
            <div
                class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-yellow-400 via-orange-400 to-yellow-300"
            ></div>

            <div class="relative z-10">
                <!-- Main Footer Content -->
                <div class="container mx-auto px-6 py-16">
                    <div
                        class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8"
                    >
                        <!-- Brand Section -->
                        <div class="lg:col-span-2">
                            <div class="flex items-center mb-6">
                                <div
                                    class="w-16 h-16 bg-gradient-to-br from-yellow-400 via-orange-400 to-yellow-300 rounded-2xl flex items-center justify-center shadow-xl"
                                >
                                    <span class="text-white font-bold text-2xl"
                                        >B</span
                                    >
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-2xl font-bold">BAPPEDA</h3>
                                    <p class="text-gray-300 font-medium">
                                        Provinsi Lampung
                                    </p>
                                </div>
                            </div>
                            <p
                                class="text-gray-300 leading-relaxed mb-6 max-w-lg"
                            >
                                Badan Perencanaan Pembangunan Daerah Provinsi
                                Lampung berkomitmen untuk mewujudkan pembangunan
                                yang berkelanjutan, inovatif, dan berorientasi
                                pada kesejahteraan masyarakat.
                            </p>
                        </div>

                        <!-- Contact Section -->
                        <div>
                            <h4 class="text-xl font-bold mb-6 text-white">
                                Kontak Kami
                            </h4>
                            <div class="space-y-4">
                                <div class="flex items-start space-x-3">
                                    <div
                                        class="w-8 h-8 bg-gradient-to-br from-yellow-400 to-orange-400 rounded-lg flex items-center justify-center flex-shrink-0 mt-1"
                                    >
                                        <span class="text-white text-sm"
                                            >📍</span
                                        >
                                    </div>
                                    <div>
                                        <p
                                            class="text-gray-300 leading-relaxed"
                                        >
                                            Jl. Jenderal Sudirman No. 123<br />
                                            Bandar Lampung, Provinsi Lampung<br />
                                            35111
                                        </p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <div
                                        class="w-8 h-8 bg-gradient-to-br from-orange-400 to-yellow-300 rounded-lg flex items-center justify-center"
                                    >
                                        <span class="text-white text-sm"
                                            >📞</span
                                        >
                                    </div>
                                    <p class="text-gray-300">(0721) 123-4567</p>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <div
                                        class="w-8 h-8 bg-gradient-to-br from-yellow-400 to-orange-400 rounded-lg flex items-center justify-center"
                                    >
                                        <span class="text-white text-sm"
                                            >✉️</span
                                        >
                                    </div>
                                    <p class="text-gray-300">
                                        info@bappeda.lampungprov.go.id
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Links Section -->
                        <div>
                            <h4 class="text-xl font-bold mb-6 text-white">
                                Link Terkait
                            </h4>
                            <div class="space-y-3">
                                <a
                                    href="#"
                                    class="block text-gray-300 hover:text-yellow-400 transition-colors duration-300 hover:translate-x-2 transform"
                                >
                                    → Pemerintah Provinsi Lampung
                                </a>
                                <a
                                    href="#"
                                    class="block text-gray-300 hover:text-yellow-400 transition-colors duration-300 hover:translate-x-2 transform"
                                >
                                    → Portal Data Pembangunan
                                </a>
                                <a
                                    href="#"
                                    class="block text-gray-300 hover:text-yellow-400 transition-colors duration-300 hover:translate-x-2 transform"
                                >
                                    → RPJMD Provinsi Lampung
                                </a>
                                <a
                                    href="#"
                                    class="block text-gray-300 hover:text-yellow-400 transition-colors duration-300 hover:translate-x-2 transform"
                                >
                                    → SAKIP BAPPEDA
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer Bottom -->
                <div class="border-t border-gray-700">
                    <div class="container mx-auto px-6 py-8">
                        <div
                            class="flex flex-col md:flex-row justify-between items-center"
                        >
                            <div class="text-center md:text-left mb-4 md:mb-0">
                                <p class="text-gray-300">
                                    &copy;
                                    {{ new Date().getFullYear() }} BAPPEDA
                                    Provinsi Lampung. Semua hak dilindungi.
                                </p>
                            </div>
                            <div class="flex items-center space-x-6">
                                <a
                                    href="#"
                                    class="text-gray-300 hover:text-yellow-400 transition-colors duration-300 text-sm"
                                >
                                    Kebijakan Privasi
                                </a>
                                <a
                                    href="#"
                                    class="text-gray-300 hover:text-yellow-400 transition-colors duration-300 text-sm"
                                >
                                    Syarat & Ketentuan
                                </a>
                            </div>
                        </div>
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
import { route } from "ziggy-js";

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
