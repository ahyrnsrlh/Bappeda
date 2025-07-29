<template>
    <AppLayout>
        <div class="max-w-2xl mx-auto">
            <div class="space-y-6">
                <!-- Header -->
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-bold text-gray-900">
                        Buat Jadwal Rapat
                    </h2>
                    <Link
                        href="/meetings"
                        class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50"
                    >
                        Kembali
                    </Link>
                </div>

                <!-- Form -->
                <div class="bg-white shadow px-4 py-5 sm:rounded-lg sm:p-6">
                    <form @submit.prevent="submit">
                        <div class="space-y-6">
                            <!-- Title -->
                            <div>
                                <label
                                    for="title"
                                    class="block text-sm font-medium text-gray-700"
                                >
                                    Judul Rapat
                                </label>
                                <div class="mt-1">
                                    <input
                                        id="title"
                                        v-model="form.title"
                                        type="text"
                                        required
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                        :class="{
                                            'border-red-300': errors.title,
                                        }"
                                    />
                                </div>
                                <p
                                    v-if="errors.title"
                                    class="mt-2 text-sm text-red-600"
                                >
                                    {{ errors.title }}
                                </p>
                            </div>

                            <!-- Meeting Date -->
                            <div>
                                <label
                                    for="meeting_date"
                                    class="block text-sm font-medium text-gray-700"
                                >
                                    Tanggal & Waktu Rapat
                                </label>
                                <div class="mt-1">
                                    <input
                                        id="meeting_date"
                                        v-model="form.meeting_date"
                                        type="datetime-local"
                                        required
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                        :class="{
                                            'border-red-300':
                                                errors.meeting_date,
                                        }"
                                    />
                                </div>
                                <p
                                    v-if="errors.meeting_date"
                                    class="mt-2 text-sm text-red-600"
                                >
                                    {{ errors.meeting_date }}
                                </p>
                            </div>

                            <!-- Location -->
                            <div>
                                <label
                                    for="location"
                                    class="block text-sm font-medium text-gray-700"
                                >
                                    Lokasi Rapat
                                </label>
                                <div class="mt-1">
                                    <input
                                        id="location"
                                        v-model="form.location"
                                        type="text"
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                        :class="{
                                            'border-red-300': errors.location,
                                        }"
                                        placeholder="Ruang Rapat Utama"
                                    />
                                </div>
                                <p
                                    v-if="errors.location"
                                    class="mt-2 text-sm text-red-600"
                                >
                                    {{ errors.location }}
                                </p>
                            </div>

                            <!-- Agenda -->
                            <div>
                                <label
                                    for="agenda"
                                    class="block text-sm font-medium text-gray-700"
                                >
                                    Agenda Rapat
                                </label>
                                <div class="mt-1">
                                    <textarea
                                        id="agenda"
                                        v-model="form.agenda"
                                        rows="4"
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                        :class="{
                                            'border-red-300': errors.agenda,
                                        }"
                                        placeholder="Jelaskan agenda rapat yang akan dibahas..."
                                    ></textarea>
                                </div>
                                <p
                                    v-if="errors.agenda"
                                    class="mt-2 text-sm text-red-600"
                                >
                                    {{ errors.agenda }}
                                </p>
                            </div>

                            <!-- Participants -->
                            <div>
                                <label
                                    class="block text-sm font-medium text-gray-700"
                                >
                                    Peserta Rapat
                                </label>
                                <div class="mt-2 space-y-2">
                                    <div
                                        v-for="team in teams"
                                        :key="team.id"
                                        class="flex items-center"
                                    >
                                        <input
                                            :id="`team_${team.id}`"
                                            v-model="form.participant_teams"
                                            :value="team.id.toString()"
                                            type="checkbox"
                                            class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"
                                        />
                                        <label
                                            :for="`team_${team.id}`"
                                            class="ml-2 block text-sm text-gray-900"
                                        >
                                            {{ team.name }}
                                        </label>
                                    </div>
                                </div>
                                <p
                                    v-if="errors.participant_teams"
                                    class="mt-2 text-sm text-red-600"
                                >
                                    {{ errors.participant_teams }}
                                </p>
                            </div>

                            <!-- Status -->
                            <div>
                                <label
                                    for="status"
                                    class="block text-sm font-medium text-gray-700"
                                >
                                    Status
                                </label>
                                <div class="mt-1">
                                    <select
                                        id="status"
                                        v-model="form.status"
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                        :class="{
                                            'border-red-300': errors.status,
                                        }"
                                    >
                                        <option value="scheduled">
                                            Terjadwal
                                        </option>
                                        <option value="completed">
                                            Selesai
                                        </option>
                                        <option value="cancelled">
                                            Dibatalkan
                                        </option>
                                    </select>
                                </div>
                                <p
                                    v-if="errors.status"
                                    class="mt-2 text-sm text-red-600"
                                >
                                    {{ errors.status }}
                                </p>
                            </div>

                            <!-- Notes -->
                            <div>
                                <label
                                    for="notes"
                                    class="block text-sm font-medium text-gray-700"
                                >
                                    Catatan Tambahan
                                </label>
                                <div class="mt-1">
                                    <textarea
                                        id="notes"
                                        v-model="form.notes"
                                        rows="3"
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                        :class="{
                                            'border-red-300': errors.notes,
                                        }"
                                        placeholder="Catatan atau informasi tambahan..."
                                    ></textarea>
                                </div>
                                <p
                                    v-if="errors.notes"
                                    class="mt-2 text-sm text-red-600"
                                >
                                    {{ errors.notes }}
                                </p>
                            </div>

                            <!-- Undangan Rapat -->
                            <div>
                                <label
                                    for="invitation_file"
                                    class="block text-sm font-medium text-gray-700"
                                >
                                    File Undangan Rapat (opsional)
                                </label>
                                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                    <div class="space-y-1 text-center">
                                        <svg
                                            class="mx-auto h-12 w-12 text-gray-400"
                                            stroke="currentColor"
                                            fill="none"
                                            viewBox="0 0 48 48"
                                        >
                                            <path
                                                d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                                stroke-width="2"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                            />
                                        </svg>
                                        <div class="flex text-sm text-gray-600">
                                            <label
                                                for="invitation_file"
                                                class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500"
                                            >
                                                <span>Upload undangan</span>
                                                <input
                                                    id="invitation_file"
                                                    name="invitation_file"
                                                    type="file"
                                                    class="sr-only"
                                                    @change="handleInvitationFileChange"
                                                    accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"
                                                />
                                            </label>
                                            <p class="pl-1">atau drag and drop</p>
                                        </div>
                                        <p class="text-xs text-gray-500">
                                            PDF, DOC, DOCX, JPG, PNG hingga 10MB
                                        </p>
                                    </div>
                                </div>

                                <div
                                    v-if="form.invitation_file"
                                    class="mt-3 p-3 bg-gray-50 rounded-md"
                                >
                                    <div class="flex items-center">
                                        <svg
                                            class="h-5 w-5 text-gray-400"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                                            />
                                        </svg>
                                        <span class="ml-2 text-sm text-gray-700">
                                            {{ form.invitation_file.name }}
                                        </span>
                                        <button
                                            type="button"
                                            @click="removeInvitationFile"
                                            class="ml-auto text-red-500 hover:text-red-700"
                                        >
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                <p
                                    v-if="errors.invitation_file"
                                    class="mt-2 text-sm text-red-600"
                                >
                                    {{ errors.invitation_file }}
                                </p>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="pt-6 flex justify-end space-x-3">
                            <Link
                                href="/meetings"
                                class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            >
                                Batal
                            </Link>
                            <button
                                type="submit"
                                :disabled="processing"
                                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:opacity-50"
                            >
                                <span v-if="processing">Menyimpan...</span>
                                <span v-else>Simpan Jadwal</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { reactive, ref } from "vue";
import { Link, router } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";

const props = defineProps({
    teams: Array,
    errors: Object,
});

const processing = ref(false);

const form = reactive({
    title: "",
    meeting_date: "",
    location: "",
    agenda: "",
    participant_teams: [],
    status: "scheduled",
    notes: "",
    invitation_file: null,
});

const handleInvitationFileChange = (event) => {
    const file = event.target.files[0];
    if (file) {
        // Validate file size (10MB)
        if (file.size > 10 * 1024 * 1024) {
            alert('Ukuran file tidak boleh lebih dari 10MB');
            return;
        }
        
        // Validate file type
        const allowedTypes = ['application/pdf', 'application/msword', 
                             'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                             'image/jpeg', 'image/jpg', 'image/png'];
        if (!allowedTypes.includes(file.type)) {
            alert('Tipe file tidak didukung. Gunakan PDF, DOC, DOCX, JPG, atau PNG');
            return;
        }
        
        form.invitation_file = file;
    }
};

const removeInvitationFile = () => {
    form.invitation_file = null;
    // Reset file input
    const fileInput = document.getElementById('invitation_file');
    if (fileInput) {
        fileInput.value = '';
    }
};

const submit = () => {
    processing.value = true;

    // Pastikan participant_teams adalah array
    const participantTeams = Array.isArray(form.participant_teams) ? form.participant_teams : [];

    // Create FormData for file upload
    const formData = new FormData();
    Object.keys(form).forEach(key => {
        if (key === 'participant_teams') {
            // Kirim sebagai array, bukan JSON string
            participantTeams.forEach((teamId, index) => {
                formData.append(`participant_teams[${index}]`, teamId);
            });
        } else if (key === 'invitation_file' && form[key]) {
            formData.append('invitation_file', form[key]);
        } else if (form[key] !== null) {
            formData.append(key, form[key]);
        }
    });

    router.post("/meetings", formData, {
        forceFormData: true,
        onFinish: () => {
            processing.value = false;
        },
    });
};
</script>
