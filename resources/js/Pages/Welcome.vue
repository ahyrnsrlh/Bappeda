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

                    <!-- Navigation Links -->
                    <div class="hidden md:flex items-center space-x-8">
                        <button
                            @click="scrollToSection('hero')"
                            class="text-gray-700 hover:text-yellow-600 font-medium transition-colors duration-200"
                        >
                            Beranda
                        </button>
                        <button
                            @click="scrollToSection('dinas')"
                            class="text-gray-700 hover:text-yellow-600 font-medium transition-colors duration-200"
                        >
                            Tentang
                        </button>
                        <button
                            @click="scrollToSection('staff')"
                            class="text-gray-700 hover:text-yellow-600 font-medium transition-colors duration-200"
                        >
                            Struktur Organisasi
                        </button>
                        <button
                            @click="scrollToSection('contact')"
                            class="text-gray-700 hover:text-yellow-600 font-medium transition-colors duration-200"
                        >
                            Link Terkait
                        </button>
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
            id="hero"
            class="pt-24 pb-20 bg-white relative overflow-hidden"
            style="
                background-image: url('/storage/sigerr.png');
                background-size: contain;
                background-position: center;
                background-repeat: no-repeat;
            "
        >
            <!-- Logo overlay with reduced opacity for better visibility -->
            <div class="absolute inset-0 bg-white/40"></div>

            <div class="container mx-auto px-6 py-20 relative z-10">
                <div class="max-w-7xl mx-auto">
                    <div class="grid lg:grid-cols-2 gap-16 items-center">
                        <!-- Content -->
                        <div class="text-center lg:text-left space-y-8">
                            <div
                                class="inline-flex items-center bg-gray-100 border border-gray-200 text-gray-800 px-6 py-3 rounded-full text-base font-semibold mb-4"
                            >
                                <span class="mr-2">🏛️</span>
                                Bidang Ekonomi BAPPEDA Provinsi Lampung
                            </div>

                            <div class="space-y-6">
                                <h1
                                    class="text-4xl md:text-6xl font-bold text-gray-900 leading-tight"
                                >
                                    Portal Info Ekonomi
                                    <span class="text-yellow-600">BAPPEDA</span>
                                </h1>
                                <div class="space-y-4">
                                    <p
                                        class="text-xl md:text-2xl text-gray-800 leading-relaxed font-medium"
                                    >
                                        "BERSAMA LAMPUNG MAJU MENUJU INDONESIA
                                        EMAS"
                                    </p>
                                    <p
                                        class="text-lg md:text-xl text-gray-700 leading-relaxed"
                                    >
                                        Merancang kebijakan pembangunan ekonomi
                                        daerah dengan fokus pada sektor
                                        produktif:
                                        <span
                                            class="font-semibold text-gray-900"
                                            >pertanian, industri, perdagangan,
                                            UMKM, ketenagakerjaan, dan
                                            pariwisata</span
                                        >
                                    </p>
                                </div>
                            </div>

                            <!-- Mission Points -->
                            <div
                                class="bg-gray-50 border border-gray-200 rounded-2xl p-6 space-y-4"
                            >
                                <h3
                                    class="text-lg font-bold text-gray-900 mb-4"
                                >
                                    Misi Kami:
                                </h3>
                                <div class="space-y-3 text-gray-800">
                                    <div class="flex items-start space-x-3">
                                        <span
                                            class="flex-shrink-0 w-6 h-6 bg-yellow-500 rounded-full flex items-center justify-center text-xs font-bold text-white"
                                            >1</span
                                        >
                                        <p class="text-sm leading-relaxed">
                                            Mendorong Pertumbuhan Ekonomi yang
                                            Inklusif, Mandiri, dan Inovatif
                                        </p>
                                    </div>
                                    <div class="flex items-start space-x-3">
                                        <span
                                            class="flex-shrink-0 w-6 h-6 bg-yellow-500 rounded-full flex items-center justify-center text-xs font-bold text-white"
                                            >2</span
                                        >
                                        <p class="text-sm leading-relaxed">
                                            Memperkuat Sumber Daya Manusia yang
                                            Unggul dan Produktif
                                        </p>
                                    </div>
                                    <div class="flex items-start space-x-3">
                                        <span
                                            class="flex-shrink-0 w-6 h-6 bg-yellow-500 rounded-full flex items-center justify-center text-xs font-bold text-white"
                                            >3</span
                                        >
                                        <p class="text-sm leading-relaxed">
                                            Meningkatkan Kehidupan Masyarakat
                                            Beradab, Berkeadilan, dan
                                            Berkelanjutan
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div
                                class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start"
                            >
                                <template v-if="$page.props.auth?.user">
                                    <Link
                                        href="/dashboard"
                                        class="px-8 py-4 bg-yellow-500 text-white rounded-xl font-semibold shadow-lg hover:shadow-xl hover:scale-105 hover:bg-yellow-600 transition-all duration-300"
                                    >
                                        Masuk ke Dashboard
                                    </Link>
                                </template>
                                <template v-else>
                                    <Link
                                        href="/register"
                                        class="px-8 py-4 bg-yellow-500 text-white rounded-xl font-semibold shadow-lg hover:shadow-xl hover:scale-105 hover:bg-yellow-600 transition-all duration-300"
                                    >
                                        Mulai Sekarang
                                    </Link>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Dinas Section -->
        <section id="dinas" class="py-24 bg-gray-50">
            <div class="container mx-auto px-6">
                <div class="max-w-7xl mx-auto">
                    <div class="text-center mb-16">
                        <div
                            class="inline-flex items-center bg-gradient-to-r from-green-600 to-teal-600 text-white px-6 py-3 rounded-full text-sm font-semibold mb-6 shadow-lg"
                        >
                            <span class="mr-2">🏢</span>
                            Dinas di Bawah Naungan BAPPEDA
                        </div>
                        <h2
                            class="text-4xl md:text-5xl font-bold text-gray-900 mb-6"
                        >
                            Dinas Terkait Sektor Ekonomi
                        </h2>
                        <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                            Dinas-dinas yang berkoordinasi dengan BAPPEDA dalam
                            perencanaan dan pelaksanaan pembangunan ekonomi
                            daerah
                        </p>
                    </div>

                    <div
                        class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8"
                    >
                        <!-- DINAS PMPTSP -->
                        <div
                            class="group bg-white rounded-2xl p-8 text-center hover:shadow-xl hover:scale-105 transition-all duration-300 border border-gray-200"
                        >
                            <div
                                class="w-20 h-20 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg group-hover:scale-110 transition-transform duration-300"
                            >
                                <span class="text-3xl text-white">🏛️</span>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-3">
                                DINAS PMPTSP
                            </h3>
                            <p class="text-gray-600 text-sm leading-relaxed">
                                Penanaman Modal dan Pelayanan Terpadu Satu Pintu
                            </p>
                        </div>

                        <!-- DINAS TENAGA KERJA -->
                        <div
                            class="group bg-white rounded-2xl p-8 text-center hover:shadow-xl hover:scale-105 transition-all duration-300 border border-gray-200"
                        >
                            <div
                                class="w-20 h-20 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg group-hover:scale-110 transition-transform duration-300"
                            >
                                <span class="text-3xl text-white">👷</span>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-3">
                                DINAS TENAGA KERJA
                            </h3>
                            <p class="text-gray-600 text-sm leading-relaxed">
                                Ketenagakerjaan dan Transmigrasi
                            </p>
                        </div>

                        <!-- DINAS PARIWISATA DAN EKRAF -->
                        <div
                            class="group bg-white rounded-2xl p-8 text-center hover:shadow-xl hover:scale-105 transition-all duration-300 border border-gray-200"
                        >
                            <div
                                class="w-20 h-20 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg group-hover:scale-110 transition-transform duration-300"
                            >
                                <span class="text-3xl text-white">🏖️</span>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-3">
                                DINAS PARIWISATA DAN EKRAF
                            </h3>
                            <p class="text-gray-600 text-sm leading-relaxed">
                                Pariwisata dan Ekonomi Kreatif
                            </p>
                        </div>

                        <!-- DINAS PERINDUSTRIAN DAN PERDAGANGAN -->
                        <div
                            class="group bg-white rounded-2xl p-8 text-center hover:shadow-xl hover:scale-105 transition-all duration-300 border border-gray-200"
                        >
                            <div
                                class="w-20 h-20 bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg group-hover:scale-110 transition-transform duration-300"
                            >
                                <span class="text-3xl text-white">🏭</span>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-3">
                                DINAS PERINDUSTRIAN DAN PERDAGANGAN
                            </h3>
                            <p class="text-gray-600 text-sm leading-relaxed">
                                Industri dan Perdagangan Daerah
                            </p>
                        </div>

                        <!-- DINAS KOPERASI DAN UMKM -->
                        <div
                            class="group bg-white rounded-2xl p-8 text-center hover:shadow-xl hover:scale-105 transition-all duration-300 border border-gray-200"
                        >
                            <div
                                class="w-20 h-20 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg group-hover:scale-110 transition-transform duration-300"
                            >
                                <span class="text-3xl text-white">🏪</span>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-3">
                                DINAS KOPERASI DAN UMKM
                            </h3>
                            <p class="text-gray-600 text-sm leading-relaxed">
                                Koperasi dan Usaha Mikro Kecil Menengah
                            </p>
                        </div>

                        <!-- DINAS KETAHANAN PANGAN TP DAN HORTI -->
                        <div
                            class="group bg-white rounded-2xl p-8 text-center hover:shadow-xl hover:scale-105 transition-all duration-300 border border-gray-200"
                        >
                            <div
                                class="w-20 h-20 bg-gradient-to-br from-red-500 to-red-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg group-hover:scale-110 transition-transform duration-300"
                            >
                                <span class="text-3xl text-white">🌾</span>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-3">
                                DINAS KETAHANAN PANGAN TP DAN HORTI
                            </h3>
                            <p class="text-gray-600 text-sm leading-relaxed">
                                Ketahanan Pangan, Tanaman Pangan dan
                                Hortikultura
                            </p>
                        </div>

                        <!-- DINAS PERKEBUNAN -->
                        <div
                            class="group bg-white rounded-2xl p-8 text-center hover:shadow-xl hover:scale-105 transition-all duration-300 border border-gray-200"
                        >
                            <div
                                class="w-20 h-20 bg-gradient-to-br from-teal-500 to-teal-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg group-hover:scale-110 transition-transform duration-300"
                            >
                                <span class="text-3xl text-white">🌴</span>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-3">
                                DINAS PERKEBUNAN
                            </h3>
                            <p class="text-gray-600 text-sm leading-relaxed">
                                Perkebunan dan Kehutanan
                            </p>
                        </div>

                        <!-- DINAS PETERNAKAN DAN KESWAN -->
                        <div
                            class="group bg-white rounded-2xl p-8 text-center hover:shadow-xl hover:scale-105 transition-all duration-300 border border-gray-200"
                        >
                            <div
                                class="w-20 h-20 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg group-hover:scale-110 transition-transform duration-300"
                            >
                                <span class="text-3xl text-white">🐄</span>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-3">
                                DINAS PETERNAKAN DAN KESWAN
                            </h3>
                            <p class="text-gray-600 text-sm leading-relaxed">
                                Peternakan dan Kesehatan Hewan
                            </p>
                        </div>

                        <!-- DINAS KELAUTAN DAN PERIKANAN -->
                        <div
                            class="group bg-white rounded-2xl p-8 text-center hover:shadow-xl hover:scale-105 transition-all duration-300 border border-gray-200"
                        >
                            <div
                                class="w-20 h-20 bg-gradient-to-br from-cyan-500 to-cyan-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg group-hover:scale-110 transition-transform duration-300"
                            >
                                <span class="text-3xl text-white">🐟</span>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-3">
                                DINAS KELAUTAN DAN PERIKANAN
                            </h3>
                            <p class="text-gray-600 text-sm leading-relaxed">
                                Kelautan dan Perikanan Daerah
                            </p>
                        </div>
                    </div>

                    <!-- Coordination Info -->
                    <div
                        class="mt-16 bg-white rounded-3xl p-8 md:p-12 border border-gray-200"
                    >
                        <div class="text-center">
                            <div
                                class="w-16 h-16 bg-gradient-to-br from-green-500 to-blue-500 rounded-2xl flex items-center justify-center mx-auto mb-6"
                            >
                                <span class="text-2xl text-white">🤝</span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-4">
                                Koordinasi Antar Dinas
                            </h3>
                            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                                BAPPEDA berperan dalam mengkoordinasikan seluruh
                                dinas terkait untuk memastikan sinergi dalam
                                perencanaan dan pelaksanaan pembangunan ekonomi
                                daerah yang berkelanjutan dan terintegrasi.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Staff Section -->
        <section id="staff" class="py-24 bg-white">
            <div class="container mx-auto px-6">
                <div class="max-w-7xl mx-auto">
                    <div class="text-center mb-16">
                        <div
                            class="inline-flex items-center bg-gradient-to-r from-purple-600 to-pink-600 text-white px-6 py-3 rounded-full text-sm font-semibold mb-6 shadow-lg"
                        >
                            <span class="mr-2">👥</span>
                            Anggota Bidang Perekonomian dan Pembangunan
                        </div>
                        <h2
                            class="text-4xl md:text-5xl font-bold text-gray-900 mb-6"
                        >
                            Struktur BAPPEDA Provinsi Lampung
                        </h2>
                        <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                            Tim profesional yang berdedikasi dalam perencanaan
                            dan pembangunan ekonomi daerah
                        </p>
                    </div>

                    <!-- Leadership Section -->
                    <div class="mb-16">
                        <h3
                            class="text-2xl font-bold text-gray-900 text-center mb-12"
                        >
                            Pimpinan
                        </h3>
                        <div class="flex justify-center">
                            <div
                                class="max-w-sm bg-white rounded-3xl p-8 text-center shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-200"
                            >
                                <div
                                    class="w-32 h-32 rounded-full mx-auto mb-6 shadow-lg overflow-hidden"
                                >
                                    <img
                                        src="/storage/foto-pegawai/RIDWAN SAIFUDDIN S.E., M.Si.png"
                                        alt="Ridwan Saifuddin"
                                        class="w-full h-full object-cover"
                                    />
                                </div>
                                <h4
                                    class="text-xl font-bold text-gray-900 mb-2"
                                >
                                    Ridwan Saifuddin, S.E., M.Si
                                </h4>
                                <p class="text-blue-600 font-semibold mb-2">
                                    Kabid Perencanaan Perekonomian
                                </p>
                                <p class="text-gray-600 text-sm">
                                    NIP. 19740918 200002 1 002<br />Pembina / IV
                                    a
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Staff Grid -->
                    <div
                        class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8"
                    >
                        <!-- Kaizan - Fungsional Perencana Madya -->
                        <div
                            class="group bg-white rounded-2xl p-6 text-center hover:shadow-xl hover:scale-105 transition-all duration-300 border border-gray-200"
                        >
                            <div
                                class="w-24 h-24 rounded-full mx-auto mb-4 shadow-lg group-hover:scale-110 transition-transform duration-300 overflow-hidden"
                            >
                                <img
                                    src="/storage/foto-pegawai/KAIZAN SP.,M.Si.png"
                                    alt="Kaizan"
                                    class="w-full h-full object-cover"
                                />
                            </div>
                            <h4 class="text-lg font-bold text-gray-900 mb-2">
                                Kaizan, S.P., M.Si
                            </h4>
                            <p
                                class="text-purple-600 font-semibold text-sm mb-2"
                            >
                                Fungsional Perencana Madya
                            </p>
                            <p class="text-gray-600 text-xs">
                                NIP. 19730323 200212 1 011<br />Pembina Tingkat
                                I / IV b
                            </p>
                        </div>

                        <!-- Naomi Setyawati - Fungsional Perencana Ahli Muda -->
                        <div
                            class="group bg-white rounded-2xl p-6 text-center hover:shadow-xl hover:scale-105 transition-all duration-300 border border-gray-200"
                        >
                            <div
                                class="w-24 h-24 rounded-full mx-auto mb-4 shadow-lg group-hover:scale-110 transition-transform duration-300 overflow-hidden"
                            >
                                <img
                                    src="/storage/foto-pegawai/NAOMI SETYAWATI S.E.png"
                                    alt="Naomi Setyawati"
                                    class="w-full h-full object-cover"
                                />
                            </div>
                            <h4 class="text-lg font-bold text-gray-900 mb-2">
                                Naomi Setyawati, S.E
                            </h4>
                            <p
                                class="text-green-600 font-semibold text-sm mb-2"
                            >
                                Fungsional Perencana Ahli Muda
                            </p>
                            <p class="text-gray-600 text-xs">
                                NIP. 19771014 200312 2 005<br />Penata Tingkat I
                                / III d
                            </p>
                        </div>

                        <!-- Haryo Wicaksono - Fungsional Perencana Ahli Muda -->
                        <div
                            class="group bg-white rounded-2xl p-6 text-center hover:shadow-xl hover:scale-105 transition-all duration-300 border border-gray-200"
                        >
                            <div
                                class="w-24 h-24 rounded-full mx-auto mb-4 shadow-lg group-hover:scale-110 transition-transform duration-300 overflow-hidden"
                            >
                                <img
                                    src="/storage/foto-pegawai/HARYO WICAKSONO SE.png"
                                    alt="Haryo Wicaksono"
                                    class="w-full h-full object-cover"
                                />
                            </div>
                            <h4 class="text-lg font-bold text-gray-900 mb-2">
                                Haryo Wicaksono, S.E
                            </h4>
                            <p class="text-blue-600 font-semibold text-sm mb-2">
                                Fungsional Perencana Ahli Muda
                            </p>
                            <p class="text-gray-600 text-xs">
                                NIP. 19780729 201001 1 007<br />Penata Tingkat I
                                / III d
                            </p>
                        </div>

                        <!-- Era Jayanti - Fungsional Perencana Ahli Muda -->
                        <div
                            class="group bg-white rounded-2xl p-6 text-center hover:shadow-xl hover:scale-105 transition-all duration-300 border border-gray-200"
                        >
                            <div
                                class="w-24 h-24 rounded-full mx-auto mb-4 shadow-lg group-hover:scale-110 transition-transform duration-300 overflow-hidden"
                            >
                                <img
                                    src="/storage/foto-pegawai/era jayanti.JPG"
                                    alt="Era Jayanti"
                                    class="w-full h-full object-cover"
                                />
                            </div>
                            <h4 class="text-lg font-bold text-gray-900 mb-2">
                                Era Jayanti, S.STP., M.M
                            </h4>
                            <p class="text-pink-600 font-semibold text-sm mb-2">
                                Fungsional Perencana Ahli Muda
                            </p>
                            <p class="text-gray-600 text-xs">
                                NIP. 19860329 200802 2 002<br />Penata Tingkat I
                                / III d
                            </p>
                        </div>

                        <!-- Yunita Devi - Fungsional Perencana Ahli Muda -->
                        <div
                            class="group bg-white rounded-2xl p-6 text-center hover:shadow-xl hover:scale-105 transition-all duration-300 border border-gray-200"
                        >
                            <div
                                class="w-24 h-24 rounded-full mx-auto mb-4 shadow-lg group-hover:scale-110 transition-transform duration-300 overflow-hidden"
                            >
                                <img
                                    src="/storage/foto-pegawai/YUNITA DEWI S.P.png"
                                    alt="Yunita Devi"
                                    class="w-full h-full object-cover"
                                />
                            </div>
                            <h4 class="text-lg font-bold text-gray-900 mb-2">
                                Yunita Dewi, S.P
                            </h4>
                            <p class="text-teal-600 font-semibold text-sm mb-2">
                                Fungsional Perencana Ahli Muda
                            </p>
                            <p class="text-gray-600 text-xs">
                                NIP. 19800613 200501 2 006<br />Penata Tingkat I
                                / III d
                            </p>
                        </div>

                        <!-- Andre Victor Mushoni - Fungsional Perencana Ahli Muda -->
                        <div
                            class="group bg-white rounded-2xl p-6 text-center hover:shadow-xl hover:scale-105 transition-all duration-300 border border-gray-200"
                        >
                            <div
                                class="w-24 h-24 rounded-full mx-auto mb-4 shadow-lg group-hover:scale-110 transition-transform duration-300 overflow-hidden"
                            >
                                <img
                                    src="/storage/foto-pegawai/ANDRE VICTOR MUCHSIN S.E., M.M.png"
                                    alt="Andre Victor Mushoni"
                                    class="w-full h-full object-cover"
                                />
                            </div>
                            <h4 class="text-lg font-bold text-gray-900 mb-2">
                                Andre Victor Muchsin, S.E., M.M
                            </h4>
                            <p
                                class="text-indigo-600 font-semibold text-sm mb-2"
                            >
                                Fungsional Perencana Ahli Muda
                            </p>
                            <p class="text-gray-600 text-xs">
                                NIP. 19890929 201001 1 008<br />Penata Tingkat I
                                / III d
                            </p>
                        </div>

                        <!-- Kornelia Restianti - Fungsional Perencana Ahli Muda -->
                        <div
                            class="group bg-white rounded-2xl p-6 text-center hover:shadow-xl hover:scale-105 transition-all duration-300 border border-gray-200"
                        >
                            <div
                                class="w-24 h-24 rounded-full mx-auto mb-4 shadow-lg group-hover:scale-110 transition-transform duration-300 overflow-hidden"
                            >
                                <img
                                    src="/storage/foto-pegawai/Cornelia Restianti.jpg"
                                    alt="Cornelia Restianti"
                                    class="w-full h-full object-cover"
                                />
                            </div>
                            <h4 class="text-lg font-bold text-gray-900 mb-2">
                                Kornella Restianti, S.KM., M.Ling
                            </h4>
                            <p
                                class="text-violet-600 font-semibold text-sm mb-2"
                            >
                                Fungsional Perencana Ahli Muda
                            </p>
                            <p class="text-gray-600 text-xs">
                                NIP. 19810125 200804 2 002<br />Penata / III c
                            </p>
                        </div>

                        <!-- Kartini - Fungsional Perencana Ahli Pertama -->
                        <div
                            class="group bg-white rounded-2xl p-6 text-center hover:shadow-xl hover:scale-105 transition-all duration-300 border border-gray-200"
                        >
                            <div
                                class="w-24 h-24 rounded-full mx-auto mb-4 shadow-lg group-hover:scale-110 transition-transform duration-300 overflow-hidden"
                            >
                                <img
                                    src="/storage/foto-pegawai/KARTINI S.H.png"
                                    alt="Kartini"
                                    class="w-full h-full object-cover"
                                />
                            </div>
                            <h4 class="text-lg font-bold text-gray-900 mb-2">
                                Kartini, S.H
                            </h4>
                            <p class="text-red-600 font-semibold text-sm mb-2">
                                Fungsional Perencana Ahli Pertama
                            </p>
                            <p class="text-gray-600 text-xs">
                                NIP. 19730430 200701 2 007<br />Penata Muda
                                Tingkat I / III b
                            </p>
                        </div>

                        <!-- Rizki Winandia - Fungsional Perencana Ahli Pertama -->
                        <div
                            class="group bg-white rounded-2xl p-6 text-center hover:shadow-xl hover:scale-105 transition-all duration-300 border border-gray-200"
                        >
                            <div
                                class="w-24 h-24 rounded-full mx-auto mb-4 shadow-lg group-hover:scale-110 transition-transform duration-300 overflow-hidden"
                            >
                                <img
                                    src="/storage/foto-pegawai/pak rizky.jpg"
                                    alt="Rizki Winandia"
                                    class="w-full h-full object-cover"
                                />
                            </div>
                            <h4 class="text-lg font-bold text-gray-900 mb-2">
                                Rizki Winanda, S.E., M.E
                            </h4>
                            <p class="text-sky-600 font-semibold text-sm mb-2">
                                Fungsional Perencana Ahli Pertama
                            </p>
                            <p class="text-gray-600 text-xs">
                                NIP. 19891028 201501 1 004<br />Penata Muda
                                Tingkat I / III b
                            </p>
                        </div>

                        <!-- Rita Mustika Sari - Fungsional Perencana Ahli Pertama -->
                        <div
                            class="group bg-white rounded-2xl p-6 text-center hover:shadow-xl hover:scale-105 transition-all duration-300 border border-gray-200"
                        >
                            <div
                                class="w-24 h-24 rounded-full mx-auto mb-4 shadow-lg group-hover:scale-110 transition-transform duration-300 overflow-hidden"
                            >
                                <img
                                    src="/storage/foto-pegawai/RITA MUSTIKA SARI S.Si.png"
                                    alt="Rita Mustika Sari"
                                    class="w-full h-full object-cover"
                                />
                            </div>
                            <h4 class="text-lg font-bold text-gray-900 mb-2">
                                Rita Mustika Sari, S.Si
                            </h4>
                            <p
                                class="text-amber-600 font-semibold text-sm mb-2"
                            >
                                Fungsional Perencana Ahli Pertama
                            </p>
                            <p class="text-gray-600 text-xs">
                                NIP. 19920625 201502 2 005<br />Penata Muda /
                                III a
                            </p>
                        </div>

                        <!-- Ahmad Zainullah - Penelaah Teknis Kebijakan (separate card below Ahli Pertama) -->
                        <div
                            class="group bg-white rounded-2xl p-6 text-center hover:shadow-xl hover:scale-105 transition-all duration-300 border border-gray-200"
                        >
                            <div
                                class="w-24 h-24 rounded-full mx-auto mb-4 shadow-lg group-hover:scale-110 transition-transform duration-300 overflow-hidden"
                            >
                                <img
                                    src="/storage/foto-pegawai/AHMAD AMRULLAH S.T..png"
                                    alt="Ahmad Zainullah"
                                    class="w-full h-full object-cover"
                                />
                            </div>
                            <h4 class="text-lg font-bold text-gray-900 mb-2">
                                Ahmad Amrullah, S.T
                            </h4>
                            <p
                                class="text-orange-600 font-semibold text-sm mb-2"
                            >
                                Penelaah Teknis Kebijakan
                            </p>
                            <p class="text-gray-600 text-xs">
                                NIP. 19710713 200701 1 002<br />Penata Tingkat I
                                / III d
                            </p>
                        </div>

                        <!-- Fakhira Hamidah Khaiumisa - Konsultan Individu -->
                        <div
                            class="group bg-white rounded-2xl p-6 text-center hover:shadow-xl hover:scale-105 transition-all duration-300 border border-gray-200"
                        >
                            <div
                                class="w-24 h-24 rounded-full mx-auto mb-4 shadow-lg group-hover:scale-110 transition-transform duration-300 overflow-hidden"
                            >
                                <img
                                    src="/storage/foto-pegawai/Fakhira Hamidah Khairunnisa S.P.jpg"
                                    alt="Fakhira Hamidah Khaiumisa"
                                    class="w-full h-full object-cover"
                                />
                            </div>
                            <h4 class="text-lg font-bold text-gray-900 mb-2">
                                Fakhira Hamidah Khairunnisa, S.P
                            </h4>
                            <p class="text-rose-600 font-semibold text-sm mb-2">
                                Konsultan Individu
                            </p>
                            <p class="text-gray-600 text-xs">-</p>
                        </div>

                        <!-- Nadila Putri Efendi - Konsultan Individu -->
                        <div
                            class="group bg-white rounded-2xl p-6 text-center hover:shadow-xl hover:scale-105 transition-all duration-300 border border-gray-200"
                        >
                            <div
                                class="w-24 h-24 rounded-full mx-auto mb-4 shadow-lg group-hover:scale-110 transition-transform duration-300 overflow-hidden"
                            >
                                <img
                                    src="/storage/foto-pegawai/Nadila Putri Efendi, S.Sos .JPG"
                                    alt="Nadila Putri Efendi"
                                    class="w-full h-full object-cover"
                                />
                            </div>
                            <h4 class="text-lg font-bold text-gray-900 mb-2">
                                Nadila Putri Efendi, S.Sos
                            </h4>
                            <p class="text-cyan-600 font-semibold text-sm mb-2">
                                Konsultan Individu
                            </p>
                            <p class="text-gray-600 text-xs">-</p>
                        </div>

                        <!-- Ibnu Trilaksono - Konsultan Individu -->
                        <div
                            class="group bg-white rounded-2xl p-6 text-center hover:shadow-xl hover:scale-105 transition-all duration-300 border border-gray-200"
                        >
                            <div
                                class="w-24 h-24 rounded-full mx-auto mb-4 shadow-lg group-hover:scale-110 transition-transform duration-300 overflow-hidden"
                            >
                                <img
                                    src="/storage/foto-pegawai/Ibnu Trilaksono S.Ak.jpg"
                                    alt="Ibnu Trilaksono"
                                    class="w-full h-full object-cover"
                                />
                            </div>
                            <h4 class="text-lg font-bold text-gray-900 mb-2">
                                Ibnu Trilaksono, S.Ak
                            </h4>
                            <p
                                class="text-slate-600 font-semibold text-sm mb-2"
                            >
                                Konsultan Individu
                            </p>
                            <p class="text-gray-600 text-xs">-</p>
                        </div>

                        <!-- Puspita Rini - P3K -->
                        <div
                            class="group bg-white rounded-2xl p-6 text-center hover:shadow-xl hover:scale-105 transition-all duration-300 border border-gray-200"
                        >
                            <div
                                class="w-24 h-24 rounded-full mx-auto mb-4 shadow-lg group-hover:scale-110 transition-transform duration-300 overflow-hidden"
                            >
                                <img
                                    src="/storage/foto-pegawai/puspita rini.jpg"
                                    alt="Puspita Rini"
                                    class="w-full h-full object-cover"
                                />
                            </div>
                            <h4 class="text-lg font-bold text-gray-900 mb-2">
                                Puspita Rini, S.E
                            </h4>
                            <p class="text-lime-600 font-semibold text-sm mb-2">
                                P3K
                            </p>
                            <p class="text-gray-600 text-xs">-</p>
                        </div>
                    </div>

                    <!-- Team Stats -->
                    <div
                        class="mt-16 bg-gradient-to-br from-blue-50 to-purple-50 rounded-3xl p-8 md:p-12"
                    >
                        <div
                            class="grid grid-cols-1 md:grid-cols-5 gap-8 text-center"
                        >
                            <div>
                                <div
                                    class="text-3xl font-bold text-blue-600 mb-2"
                                >
                                    1
                                </div>
                                <p class="text-gray-700 font-semibold">
                                    Kepala Bidang
                                </p>
                            </div>
                            <div>
                                <div
                                    class="text-3xl font-bold text-purple-600 mb-2"
                                >
                                    11
                                </div>
                                <p class="text-gray-700 font-semibold">
                                    Fungsional Perencana
                                </p>
                            </div>
                            <div>
                                <div
                                    class="text-3xl font-bold text-teal-600 mb-2"
                                >
                                    1
                                </div>
                                <p class="text-gray-700 font-semibold">
                                    Penelaah Teknis Kebijakan
                                </p>
                            </div>
                            <div>
                                <div
                                    class="text-3xl font-bold text-green-600 mb-2"
                                >
                                    3
                                </div>
                                <p class="text-gray-700 font-semibold">
                                    Konsultan Individu
                                </p>
                            </div>
                            <div>
                                <div
                                    class="text-3xl font-bold text-orange-600 mb-2"
                                >
                                    1
                                </div>
                                <p class="text-gray-700 font-semibold">P3K</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer id="contact" class="bg-yellow-600 text-white py-16">
            <div class="container mx-auto px-6">
                <div class="max-w-7xl mx-auto">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                        <!-- Brand Section -->
                        <div class="col-span-1 md:col-span-2">
                            <div class="flex items-center mb-6">
                                <div>
                                    <h3 class="text-xl font-bold">
                                        BAPPEDA
                                    </h3>
                                    <p class="text-white font-medium">
                                        PROVINSI LAMPUNG
                                    </p>
                                </div>
                            </div>
                            <p class="text-white leading-relaxed mb-6">
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
                                    class="block text-white hover:text-white transition-colors"
                                >
                                    Dashboard
                                </Link>
                                <Link
                                    href="/meetings"
                                    class="block text-white hover:text-white transition-colors"
                                >
                                    Jadwal Rapat
                                </Link>
                            </div>
                        </div>

                        <!-- Contact -->
                        <div>
                            <h4 class="text-lg font-semibold mb-6">
                                Link Terkait
                            </h4>
                            <div class="space-y-3 text-white">
                                <a
                                    href="https://bappeda.lampungprov.go.id"
                                    target="_blank"
                                    class="block hover:text-yellow-400 transition-colors duration-200"
                                >
                                    BAPPEDA Prov Lampung
                                </a>
                                <a
                                    href="https://lampung.bps.go.id/id"
                                    target="_blank"
                                    class="block hover:text-yellow-400 transition-colors duration-200"
                                >
                                    BPS Prov Lampung
                                </a>
                                <a
                                    href="https://data.go.id"
                                    target="_blank"
                                    class="block hover:text-yellow-400 transition-colors duration-200"
                                >
                                    Satu Data Indonesia
                                </a>
                            </div>
                        </div>
                    </div>

                    <div
                        class="border-t border-white mt-12 pt-8 text-center text-white"
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
