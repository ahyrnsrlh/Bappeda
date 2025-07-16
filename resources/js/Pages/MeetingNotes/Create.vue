<template>
    <AppLayout>
        <div class="max-w-4xl mx-auto">
            <div class="space-y-6">
                <!-- Header -->
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-bold text-gray-900">
                        Buat Notulen Rapat
                    </h2>
                    <Link
                        href="/meeting-notes"
                        class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50"
                    >
                        Kembali
                    </Link>
                </div>

                <!-- Form -->
                <div class="bg-white shadow px-4 py-5 sm:rounded-lg sm:p-6">
                    <form @submit.prevent="submit">
                        <div class="space-y-6">
                            <!-- Meeting Selection -->
                            <div>
                                <label
                                    for="meeting_schedule_id"
                                    class="block text-sm font-medium text-gray-700"
                                >
                                    Pilih Rapat
                                </label>
                                <div class="mt-1">
                                    <select
                                        id="meeting_schedule_id"
                                        v-model="form.meeting_schedule_id"
                                        required
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                        :class="{
                                            'border-red-300':
                                                errors.meeting_schedule_id,
                                        }"
                                    >
                                        <option value="">Pilih rapat...</option>
                                        <option
                                            v-for="meeting in meetings"
                                            :key="meeting.id"
                                            :value="meeting.id"
                                        >
                                            {{ meeting.title }} -
                                            {{
                                                formatDate(meeting.meeting_date)
                                            }}
                                        </option>
                                    </select>
                                </div>
                                <p
                                    v-if="errors.meeting_schedule_id"
                                    class="mt-2 text-sm text-red-600"
                                >
                                    {{ errors.meeting_schedule_id }}
                                </p>
                            </div>

                            <!-- Title -->
                            <div>
                                <label
                                    for="title"
                                    class="block text-sm font-medium text-gray-700"
                                >
                                    Judul Notulen
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
                                        placeholder="Masukkan judul notulen..."
                                    />
                                </div>
                                <p
                                    v-if="errors.title"
                                    class="mt-2 text-sm text-red-600"
                                >
                                    {{ errors.title }}
                                </p>
                            </div>

                            <!-- Content -->
                            <div>
                                <label
                                    for="content"
                                    class="block text-sm font-medium text-gray-700"
                                >
                                    Isi Notulen
                                </label>
                                <div class="mt-1">
                                    <textarea
                                        id="content"
                                        v-model="form.content"
                                        rows="10"
                                        required
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                        :class="{
                                            'border-red-300': errors.content,
                                        }"
                                        placeholder="Tuliskan isi notulen rapat secara detail..."
                                    ></textarea>
                                </div>
                                <p
                                    v-if="errors.content"
                                    class="mt-2 text-sm text-red-600"
                                >
                                    {{ errors.content }}
                                </p>
                                <p class="mt-2 text-sm text-gray-500">
                                    Tuliskan hasil pembahasan, keputusan, dan
                                    tindak lanjut dari rapat.
                                </p>
                            </div>

                            <!-- File Attachments -->
                            <div>
                                <label
                                    class="block text-sm font-medium text-gray-700"
                                >
                                    Lampiran File
                                </label>
                                <div class="mt-1">
                                    <div
                                        class="flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md"
                                    >
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
                                            <div
                                                class="flex text-sm text-gray-600"
                                            >
                                                <label
                                                    for="attachments"
                                                    class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500"
                                                >
                                                    <span>Upload file</span>
                                                    <input
                                                        id="attachments"
                                                        ref="fileInput"
                                                        type="file"
                                                        multiple
                                                        class="sr-only"
                                                        @change="
                                                            handleFileUpload
                                                        "
                                                        accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.jpg,.jpeg,.png,.gif"
                                                    />
                                                </label>
                                                <p class="pl-1">
                                                    atau drag and drop
                                                </p>
                                            </div>
                                            <p class="text-xs text-gray-500">
                                                PDF, DOC, XLS, PPT, JPG, PNG
                                                hingga 10MB
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Selected Files Preview -->
                                <div
                                    v-if="selectedFiles.length > 0"
                                    class="mt-4"
                                >
                                    <h4
                                        class="text-sm font-medium text-gray-700 mb-2"
                                    >
                                        File yang dipilih:
                                    </h4>
                                    <ul
                                        class="border border-gray-200 rounded-md divide-y divide-gray-200"
                                    >
                                        <li
                                            v-for="(
                                                file, index
                                            ) in selectedFiles"
                                            :key="index"
                                            class="pl-3 pr-4 py-3 flex items-center justify-between text-sm"
                                        >
                                            <div
                                                class="w-0 flex-1 flex items-center"
                                            >
                                                <svg
                                                    class="flex-shrink-0 h-5 w-5 text-gray-400"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"
                                                    />
                                                </svg>
                                                <span
                                                    class="ml-2 flex-1 w-0 truncate"
                                                >
                                                    {{ file.name }}
                                                </span>
                                                <span
                                                    class="ml-2 text-gray-400 text-xs"
                                                >
                                                    ({{
                                                        formatFileSize(
                                                            file.size
                                                        )
                                                    }})
                                                </span>
                                            </div>
                                            <div class="ml-4 flex-shrink-0">
                                                <button
                                                    type="button"
                                                    @click="removeFile(index)"
                                                    class="font-medium text-red-600 hover:text-red-500"
                                                >
                                                    Hapus
                                                </button>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <p
                                    v-if="errors.attachments"
                                    class="mt-2 text-sm text-red-600"
                                >
                                    {{ errors.attachments }}
                                </p>
                            </div>

                            <!-- Archive Option -->
                            <div class="flex items-center">
                                <input
                                    id="is_archived"
                                    v-model="form.is_archived"
                                    type="checkbox"
                                    class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"
                                />
                                <label
                                    for="is_archived"
                                    class="ml-2 block text-sm text-gray-900"
                                >
                                    Arsipkan notulen ini
                                </label>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="pt-6 flex justify-end space-x-3">
                            <Link
                                href="/meeting-notes"
                                class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            >
                                Batal
                            </Link>
                            <button
                                type="submit"
                                :disabled="processing"
                                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 disabled:opacity-50"
                            >
                                <span v-if="processing">Menyimpan...</span>
                                <span v-else>Simpan Notulen</span>
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
    meetings: Array,
    errors: Object,
    selectedMeetingId: [Number, String], // for pre-selecting meeting from URL param
});

const processing = ref(false);
const selectedFiles = ref([]);
const fileInput = ref(null);

const form = reactive({
    meeting_schedule_id: props.selectedMeetingId || "",
    title: "",
    content: "",
    attachments: [],
    is_archived: false,
});

const handleFileUpload = (event) => {
    const files = Array.from(event.target.files);
    selectedFiles.value.push(...files);
    form.attachments = selectedFiles.value;
};

const removeFile = (index) => {
    selectedFiles.value.splice(index, 1);
    form.attachments = selectedFiles.value;

    // Clear the file input to allow re-selection of the same file
    if (fileInput.value) {
        fileInput.value.value = "";
    }
};

const formatFileSize = (bytes) => {
    if (bytes === 0) return "0 Bytes";
    const k = 1024;
    const sizes = ["Bytes", "KB", "MB", "GB"];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + " " + sizes[i];
};

const formatDate = (date) => {
    return new Date(date).toLocaleDateString("id-ID", {
        year: "numeric",
        month: "long",
        day: "numeric",
        hour: "2-digit",
        minute: "2-digit",
    });
};

const submit = () => {
    processing.value = true;

    const formData = new FormData();
    formData.append("meeting_schedule_id", form.meeting_schedule_id);
    formData.append("title", form.title);
    formData.append("content", form.content);
    formData.append("is_archived", form.is_archived ? "1" : "0");

    // Append files
    selectedFiles.value.forEach((file, index) => {
        formData.append(`attachments[${index}]`, file);
    });

    router.post("/meeting-notes", formData, {
        onFinish: () => {
            processing.value = false;
        },
        forceFormData: true,
    });
};
</script>
