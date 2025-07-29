<template>
    <AppLayout>
        <div class="max-w-2xl mx-auto">
            <!-- Loading State -->
            <div
                v-if="!pageLoaded"
                class="flex justify-center items-center h-64"
            >
                <div
                    class="animate-spin rounded-full h-32 w-32 border-b-2 border-yellow-600"
                ></div>
            </div>

            <!-- Main Content -->
            <div v-else class="bg-white shadow rounded-lg">
                <!-- Error Alert -->
                <div v-if="$page.props.error" class="bg-red-50 border border-red-200 rounded-md p-4 mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-red-800">{{ $page.props.error }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="px-4 py-5 sm:p-6">
                    <h3
                        class="text-lg leading-6 font-medium text-gray-900 mb-6"
                    >
                        Upload File Baru
                    </h3>

                    <form
                        @submit.prevent="submit"
                        enctype="multipart/form-data"
                    >
                        <!-- File Upload -->
                        <div class="mb-6">
                            <label
                                class="block text-sm font-medium text-gray-700 mb-2"
                            >
                                Pilih File *
                            </label>
                            <div
                                class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md"
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
                                    <div class="flex text-sm text-gray-600">
                                        <label
                                            for="file-upload"
                                            class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500"
                                        >
                                            <span>Upload a file</span>
                                            <input
                                                id="file-upload"
                                                name="file-upload"
                                                type="file"
                                                class="sr-only"
                                                @change="handleFileChange"
                                                required
                                            />
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>                            <p class="text-xs text-gray-500">
                                PNG, JPG, PDF, DOC, DOCX up to 50MB
                            </p>
                                </div>
                            </div>

                            <div
                                v-if="form.file"
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
                                            d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"
                                        />
                                    </svg>
                                    <span class="ml-2 text-sm text-gray-900">{{
                                        form.file.name
                                    }}</span>
                                    <span class="ml-2 text-sm text-gray-500"
                                        >({{
                                            formatFileSize(form.file.size)
                                        }})</span
                                    >
                                </div>
                            </div>

                            <div
                                v-if="form.errors.file"
                                class="text-red-600 text-sm mt-1"
                            >
                                {{ form.errors.file }}
                            </div>
                        </div>

                        <!-- File Type -->
                        <div class="mb-6">
                            <label
                                for="type"
                                class="block text-sm font-medium text-gray-700 mb-2"
                            >
                                Tipe File *
                            </label>
                            <select
                                id="type"
                                v-model="form.type"
                                required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            >
                                <option value="">Pilih tipe file</option>
                                <option value="document">Dokumen</option>
                                <option value="other">Lainnya</option>
                            </select>
                            <div
                                v-if="form.errors.type"
                                class="text-red-600 text-sm mt-1"
                            >
                                {{ form.errors.type }}
                            </div>
                        </div>

                        <!-- Team Selection -->
                        <div class="mb-6">
                            <label
                                for="team_id"
                                class="block text-sm font-medium text-gray-700 mb-2"
                            >
                                Tim
                            </label>
                            <select
                                id="team_id"
                                v-model="form.team_id"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            >
                                <option value="">
                                    Tim Default (berdasarkan user)
                                </option>
                                <option
                                    v-for="team in (props.teams || [])"
                                    :key="team.id"
                                    :value="team.id"
                                >
                                    {{ team.name }}
                                </option>
                            </select>
                            <div
                                v-if="form.errors.team_id"
                                class="text-red-600 text-sm mt-1"
                            >
                                {{ form.errors.team_id }}
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mb-6">
                            <label
                                for="description"
                                class="block text-sm font-medium text-gray-700 mb-2"
                            >
                                Deskripsi
                            </label>
                            <textarea
                                id="description"
                                v-model="form.description"
                                rows="4"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                placeholder="Deskripsi file (opsional)"
                            ></textarea>
                            <div
                                v-if="form.errors.description"
                                class="text-red-600 text-sm mt-1"
                            >
                                {{ form.errors.description }}
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex justify-end space-x-3">
                            <Link
                                href="/files"
                                class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            >
                                Batal
                            </Link>
                            <button
                                type="submit"
                                :disabled="form.processing"
                                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:opacity-50"
                            >
                                <span v-if="form.processing"
                                    >Mengupload...</span
                                >
                                <span v-else>Upload File</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { useForm, Link } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import { onMounted, ref } from "vue";

const props = defineProps({
    teams: {
        type: Array,
        default: () => []
    },
});

const pageLoaded = ref(false);

// Debug log and error handling
onMounted(() => {
    try {
        console.log("Files Create component mounted");
        console.log("Teams prop:", props.teams);
        console.log("Props:", props);
        pageLoaded.value = true;
    } catch (error) {
        console.error("Error in onMounted:", error);
        pageLoaded.value = true; // Still show page even if there's an error
    }
});

const form = useForm({
    file: null,
    type: "",
    team_id: "",
    description: "",
});

const handleFileChange = (event) => {
    form.file = event.target.files[0];
    console.log("File selected:", form.file);
};

const formatFileSize = (bytes) => {
    if (bytes === 0) return "0 Bytes";
    const k = 1024;
    const sizes = ["Bytes", "KB", "MB", "GB"];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + " " + sizes[i];
};

const submit = () => {
    console.log("Form submit started", form.data());
    form.post("/file-management", {
        onSuccess: () => {
            console.log("Upload successful");
        },
        onError: (errors) => {
            console.log("Upload error:", errors);
        },
        onFinish: () => {
            console.log("Upload finished");
        },
    });
};
</script>
