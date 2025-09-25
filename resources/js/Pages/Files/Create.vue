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
                <div
                    v-if="$page.props.error"
                    class="bg-red-50 border border-red-200 rounded-md p-4 mb-6"
                >
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg
                                class="h-5 w-5 text-red-400"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-red-800">
                                {{ $page.props.error }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="px-4 py-5 sm:p-6">
                    <h3
                        class="text-lg leading-6 font-medium text-gray-900 mb-6"
                    >
                        <span v-if="form.folder_type === 'notulen'"
                            >Upload Notulen Rapat</span
                        >
                        <span v-else>Upload File Baru</span>
                    </h3>

                    <form
                        @submit.prevent="submit"
                        enctype="multipart/form-data"
                    >
                        <!-- Folder Type Selection - Show first to determine form structure -->
                        <div class="mb-6">
                            <label
                                for="folder_type"
                                class="block text-sm font-medium text-gray-700 mb-2"
                            >
                                Folder <span class="text-red-500">*</span>
                            </label>
                            <select
                                id="folder_type"
                                v-model="form.folder_type"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                required
                            >
                                <option value="">Pilih Folder</option>
                                <option value="data">📁 Data</option>
                                <option value="notulen">📝 Notulen</option>
                            </select>
                            <div
                                v-if="form.errors.folder_type"
                                class="text-red-600 text-sm mt-1"
                            >
                                {{ form.errors.folder_type }}
                            </div>
                        </div>

                        <!-- Notulen-specific fields -->
                        <div
                            v-if="form.folder_type === 'notulen'"
                            class="space-y-6"
                        >
                            <!-- Title -->
                            <div>
                                <label
                                    for="title"
                                    class="block text-sm font-medium text-gray-700"
                                >
                                    Judul Notulen
                                    <span class="text-red-500">*</span>
                                </label>
                                <div class="mt-1">
                                    <input
                                        id="title"
                                        v-model="form.title"
                                        type="text"
                                        required
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                        :class="{
                                            'border-red-300': form.errors.title,
                                        }"
                                        placeholder="Masukkan judul notulen..."
                                    />
                                </div>
                                <p
                                    v-if="form.errors.title"
                                    class="mt-2 text-sm text-red-600"
                                >
                                    {{ form.errors.title }}
                                </p>
                            </div>

                            <!-- Content -->
                            <div>
                                <label
                                    for="content"
                                    class="block text-sm font-medium text-gray-700"
                                >
                                    Isi Notulen
                                    <span class="text-red-500">*</span>
                                </label>
                                <div class="mt-1">
                                    <textarea
                                        id="content"
                                        v-model="form.content"
                                        rows="10"
                                        required
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                        :class="{
                                            'border-red-300':
                                                form.errors.content,
                                        }"
                                        placeholder="Tuliskan isi notulen rapat secara detail..."
                                    ></textarea>
                                </div>
                                <p
                                    v-if="form.errors.content"
                                    class="mt-2 text-sm text-red-600"
                                >
                                    {{ form.errors.content }}
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
                                                    for="notulen-attachments"
                                                    class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500"
                                                >
                                                    <span>Upload file</span>
                                                    <input
                                                        id="notulen-attachments"
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
                                    v-if="form.errors.attachments"
                                    class="mt-2 text-sm text-red-600"
                                >
                                    {{ form.errors.attachments }}
                                </p>
                            </div>
                        </div>

                        <!-- Regular file upload for data folder -->
                        <div v-else class="space-y-6">
                            <!-- File Upload -->
                            <div>
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
                                        </div>
                                        <p class="text-xs text-gray-500">
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
                                        <span
                                            class="ml-2 text-sm text-gray-900"
                                            >{{ form.file.name }}</span
                                        >
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
                            <div>
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

                            <!-- Description -->
                            <div>
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
                        </div>

                        <!-- Team Selection (for both types) -->
                        <div class="mb-6">
                            <label
                                for="team_id"
                                class="block text-sm font-medium text-gray-700 mb-2"
                            >
                                Tim 
                                <span v-if="form.folder_type === 'notulen'" class="text-red-500">*</span>
                            </label>
                            <select
                                id="team_id"
                                v-model="form.team_id"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                :required="form.folder_type === 'notulen'"
                            >
                                <option value="">
                                    <span v-if="form.folder_type === 'notulen'">Pilih Tim</span>
                                    <span v-else>Tim Default (berdasarkan user)</span>
                                </option>
                                <option
                                    v-for="team in props.teams || []"
                                    :key="team.id"
                                    :value="team.id"
                                >
                                    {{ team.name }}
                                </option>
                            </select>
                            <div
                                v-if="form.team_id === '' && props.selectedTeam && form.folder_type !== 'notulen'"
                                class="text-blue-600 text-sm mt-1"
                            >
                                Tim yang dipilih: {{ getSelectedTeamName() }}
                            </div>
                            <div
                                v-if="form.errors.team_id"
                                class="text-red-600 text-sm mt-1"
                            >
                                {{ form.errors.team_id }}
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
                                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50"
                                :class="
                                    form.folder_type === 'notulen'
                                        ? 'bg-green-600 hover:bg-green-700 focus:ring-green-500'
                                        : 'bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500'
                                "
                            >
                                <span v-if="form.processing">
                                    <span v-if="form.folder_type === 'notulen'"
                                        >Menyimpan Notulen...</span
                                    >
                                    <span v-else>Mengupload...</span>
                                </span>
                                <span v-else>
                                    <span v-if="form.folder_type === 'notulen'"
                                        >Simpan Notulen</span
                                    >
                                    <span v-else>Upload File</span>
                                </span>
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
        default: () => [],
    },
    selectedTeam: {
        type: String,
        default: "",
    },
    selectedFolder: {
        type: String,
        default: "",
    },
});

const pageLoaded = ref(false);
const selectedFiles = ref([]);
const fileInput = ref(null);

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
    // Regular file upload fields
    file: null,
    type: "",
    description: "",

    // Notulen-specific fields
    title: "",
    content: "",
    attachments: [],

    // Common fields
    team_id: props.selectedTeam || "",
    folder_type: props.selectedFolder || "",
});

// Handle single file upload for regular files
const handleFileChange = (event) => {
    form.file = event.target.files[0];
    console.log("File selected:", form.file);
};

// Handle multiple file upload for notulen
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

const getSelectedTeamName = () => {
    if (props.selectedTeam) {
        const team = props.teams.find((t) => t.id === props.selectedTeam);
        return team ? team.name : "Tim tidak ditemukan";
    }
    return "";
};

const submit = () => {
    console.log("Form submit started", form.data());

    // Validasi untuk notulen - tim wajib dipilih
    if (form.folder_type === 'notulen' && !form.team_id) {
        form.setError('team_id', 'Tim harus dipilih untuk upload notulen');
        return;
    }

    // Ensure team_id is set if selectedTeam is available but form.team_id is empty
    if (!form.team_id && props.selectedTeam) {
        form.team_id = props.selectedTeam;
        console.log("Auto-assigned team_id:", form.team_id);
    }

    if (form.folder_type === "notulen") {
        // Submit as notulen with multiple files
        const formData = new FormData();
        formData.append("title", form.title);
        formData.append("content", form.content);
        formData.append("team_id", form.team_id);
        formData.append("folder_type", form.folder_type);

        // Append files
        selectedFiles.value.forEach((file, index) => {
            formData.append(`attachments[${index}]`, file);
        });

        form.post(route("files.store"), {
            data: formData,
            forceFormData: true,
            onSuccess: () => {
                console.log("Notulen upload successful");
            },
            onError: (errors) => {
                console.log("Notulen upload error:", errors);
            },
            onFinish: () => {
                console.log("Notulen upload finished");
            },
        });
    } else {
        // Submit as regular file
        form.post(route("files.store"), {
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
    }
};
</script>
