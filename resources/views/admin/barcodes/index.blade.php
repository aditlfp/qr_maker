<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Barcode Management') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-8" x-data="barcodeManager()">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Alert Messages -->
            <div x-show="alert.show" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform -translate-y-2"
                x-transition:enter-end="opacity-100 transform translate-y-0"
                x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0" class="mb-4" style="display: none;">
                <div class="alert"
                    :class="{
                        'alert-success': alert.type === 'success',
                        'alert-warning': alert.type === 'warning',
                        'alert-error': alert.type === 'error'
                    }">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span x-text="alert.message"></span>
                    <button @click="alert.show = false" class="btn btn-sm btn-ghost btn-circle">✕</button>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success mb-4" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if (session('warning'))
                <div class="alert alert-warning mb-4" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <span>{{ session('warning') }}</span>
                </div>
            @endif

            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <!-- Header with Search and Add Button -->
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                        <div class="form-control w-full sm:w-80">
                            <label class="input input-bordered flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                                    class="h-4 w-4 opacity-70">
                                    <path fill-rule="evenodd"
                                        d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                                        clip-rule="evenodd" />
                                </svg>
                                <input type="text" class="grow" placeholder="Search barcodes..."
                                    @input.debounce.300ms="searchBarcodes($event.target.value)" />
                            </label>
                        </div>

                        <button
                            class="btn bg-blue-600 text-white gap-2 hover:bg-blue-400 hover:text-blue-700 transition-all ease-in-out duration-300"
                            @click="$dispatch('open-modal', 'createItem')">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                    clip-rule="evenodd" />
                            </svg>
                            Add New Barcode
                        </button>
                    </div>

                    <!-- Table -->
                    <div class="overflow-x-auto">
                        <table class="table table-zebra">
                            <thead>
                                <tr>
                                    <th class="bg-base-200">ID</th>
                                    <th class="bg-base-200">QR Code</th>
                                    <th class="bg-base-200">Title</th>
                                    <th class="bg-base-200">Description</th>
                                    <th class="bg-base-200">Created At</th>
                                    <th class="bg-base-200 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="barcode-table-body">
                                @forelse ($barcodes as $barcode)
                                    <tr class="hover" data-barcode-id="{{ $barcode->id }}">
                                        <td class="font-medium">{{ $barcode->id }}</td>
                                        <td>
                                            <div class="avatar">
                                                <div class="mask mask-squircle w-16 h-16">
                                                    <img src="{{ asset('storage/' . $barcode->qr_code) }}"
                                                        alt="QR Code" class="object-cover" />
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="font-semibold">{{ $barcode->title }}</div>
                                        </td>
                                        <td>
                                            <span class="text-sm">
                                                {{ $barcode->description ?: 'N/A' }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="flex flex-col">
                                                <span
                                                    class="text-sm">{{ $barcode->created_at->format('M d, Y') }}</span>
                                                <span
                                                    class="text-xs opacity-50">{{ $barcode->created_at->format('H:i') }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="flex gap-2 justify-center">
                                                <button class="btn btn-sm btn-info btn-outline gap-1"
                                                    @click="editBarcode({{ $barcode->id }}, '{{ addslashes($barcode->title) }}', '{{ addslashes($barcode->description) }}')">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                        viewBox="0 0 20 20" fill="currentColor">
                                                        <path
                                                            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                    </svg>
                                                    Edit
                                                </button>
                                                <button class="btn btn-sm btn-error btn-outline gap-1"
                                                    @click="deleteBarcode({{ $barcode->id }})">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                        viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    Delete
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-8">
                                            <div class="flex flex-col items-center gap-2 text-base-content/50">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                                </svg>
                                                <span class="text-lg font-medium">No barcodes found</span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $barcodes->links() }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Create Modal -->
        <x-modal name="createItem">
            <div class="p-6">
                <h3 class="text-2xl font-bold mb-6 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Create New Barcode
                </h3>

                <form @submit.prevent="createBarcode">
                    <div class="space-y-4">
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-semibold">Title <span class="text-error">*</span></span>
                            </label>
                            <input type="text" x-model="createForm.title" placeholder="Enter barcode title"
                                class="input input-bordered w-full" required />
                            <template x-if="createForm.errors.title">
                                <label class="label">
                                    <span class="label-text-alt text-error" x-text="createForm.errors.title"></span>
                                </label>
                            </template>
                        </div>

                        <div class="form-control flex flex-col">
                            <label class="label">
                                <span class="label-text font-semibold">Description</span>
                            </label>
                            <textarea x-model="createForm.description" class="textarea textarea-bordered h-24 w-full"
                                placeholder="Enter description (optional)"></textarea>
                            <template x-if="createForm.errors.description">
                                <label class="label">
                                    <span class="label-text-alt text-error"
                                        x-text="createForm.errors.description"></span>
                                </label>
                            </template>
                        </div>

                        <div class="modal-action">
                            <button type="button" class="btn btn-ghost"
                                @click="$dispatch('close-modal', 'createItem'); resetCreateForm()">
                                Cancel
                            </button>
                            <button type="submit"
                                class="btn bg-blue-600 text-white gap-2 hover:bg-blue-400 hover:text-blue-700 transition-all ease-in-out duration-300"
                                :disabled="createForm.loading">
                                <span x-show="!createForm.loading">Create Barcode</span>
                                <span x-show="createForm.loading" class="loading loading-spinner loading-sm"></span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </x-modal>

        <!-- Edit Modal -->
        <x-modal name="editItem">
            <div class="p-6">
                <h3 class="text-2xl font-bold mb-6 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Edit Barcode
                </h3>

                <form @submit.prevent="updateBarcode">
                    <div class="space-y-4">
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-semibold">Title <span class="text-error">*</span></span>
                            </label>
                            <input type="text" x-model="editForm.title" placeholder="Enter barcode title"
                                class="input input-bordered w-full" required />
                            <template x-if="editForm.errors.title">
                                <label class="label">
                                    <span class="label-text-alt text-error" x-text="editForm.errors.title"></span>
                                </label>
                            </template>
                        </div>

                        <div class="form-control flex flex-col">
                            <label class="label">
                                <span class="label-text font-semibold">Description</span>
                            </label>
                            <textarea x-model="editForm.description" class="textarea textarea-bordered h-24 w-full"
                                placeholder="Enter description (optional)"></textarea>
                            <template x-if="editForm.errors.description">
                                <label class="label">
                                    <span class="label-text-alt text-error"
                                        x-text="editForm.errors.description"></span>
                                </label>
                            </template>
                        </div>

                        <div class="modal-action">
                            <button type="button" class="btn btn-ghost"
                                @click="$dispatch('close-modal', 'editItem'); resetEditForm()">
                                Cancel
                            </button>
                            <button type="submit"
                                class="btn bg-blue-600 text-white gap-2 hover:bg-blue-400 hover:text-blue-700 transition-all ease-in-out duration-300"
                                :disabled="editForm.loading">
                                <span x-show="!editForm.loading">Update Barcode</span>
                                <span x-show="editForm.loading" class="loading loading-spinner loading-sm"></span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </x-modal>

        <!-- Delete Confirmation Modal -->
        <x-modal name="deleteConfirm">
            <div class="p-6">
                <div class="flex flex-col items-center gap-4">
                    <div class="rounded-full bg-error/10 p-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-error" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>

                    <h3 class="text-2xl font-bold">Delete Barcode?</h3>
                    <p class="text-center text-base-content/70">
                        Are you sure you want to delete this barcode? This action cannot be undone.
                    </p>

                    <div class="modal-action w-full">
                        <button type="button" class="btn btn-ghost flex-1"
                            @click="$dispatch('close-modal', 'deleteConfirm')">
                            Cancel
                        </button>
                        <button type="button" class="btn btn-error flex-1" @click="confirmDelete()"
                            :disabled="deleteForm.loading">
                            <span x-show="!deleteForm.loading">Delete</span>
                            <span x-show="deleteForm.loading" class="loading loading-spinner loading-sm"></span>
                        </button>
                    </div>
                </div>
            </div>
        </x-modal>
    </div>

    @push('scripts')
        <script>
            function barcodeManager() {
                return {
                    alert: {
                        show: false,
                        type: 'success',
                        message: ''
                    },
                    createForm: {
                        title: '',
                        description: '',
                        errors: {},
                        loading: false
                    },
                    editForm: {
                        id: null,
                        title: '',
                        description: '',
                        errors: {},
                        loading: false
                    },
                    deleteForm: {
                        id: null,
                        loading: false
                    },

                    showAlert(type, message) {
                        this.alert = {
                            show: true,
                            type,
                            message
                        };
                        setTimeout(() => {
                            this.alert.show = false;
                        }, 5000);
                    },

                    resetCreateForm() {
                        this.createForm = {
                            title: '',
                            description: '',
                            errors: {},
                            loading: false
                        };
                    },

                    resetEditForm() {
                        this.editForm = {
                            id: null,
                            title: '',
                            description: '',
                            errors: {},
                            loading: false
                        };
                    },

                    async createBarcode() {
                        this.createForm.loading = true;
                        this.createForm.errors = {};

                        try {
                            const response = await fetch('{{ route('barcodes.store') }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                    'Accept': 'application/json'
                                },
                                body: JSON.stringify({
                                    title: this.createForm.title,
                                    description: this.createForm.description
                                })
                            });

                            const data = await response.json();

                            if (response.ok) {
                                this.showAlert('success', 'Barcode created successfully!');
                                this.$dispatch('close-modal', 'createItem');
                                this.resetCreateForm();
                                await this.refreshTable();
                            } else {
                                if (data.errors) {
                                    this.createForm.errors = data.errors;
                                } else {
                                    this.showAlert('error', data.message || 'Failed to create barcode');
                                }
                            }
                        } catch (error) {
                            this.showAlert('error', 'An error occurred. Please try again.');
                        } finally {
                            this.createForm.loading = false;
                        }
                    },

                    editBarcode(id, title, description) {
                        this.editForm.id = id;
                        this.editForm.title = title;
                        this.editForm.description = description || '';
                        this.$dispatch('open-modal', 'editItem');
                    },

                    async updateBarcode() {
                        this.editForm.loading = true;
                        this.editForm.errors = {};
                        let updateUrl = "{{ route('barcodes.update', ':id') }}";
                        updateUrl = updateUrl.replace(':id', this.editForm.id);
                        try {
                            const response = await fetch(updateUrl, {
                                method: 'PUT',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                    'Accept': 'application/json'
                                },
                                body: JSON.stringify({
                                    title: this.editForm.title,
                                    desc: this.editForm.description
                                })
                            });

                            const data = await response.json();

                            if (response.ok) {
                                this.showAlert('success', 'Barcode updated successfully!');
                                this.$dispatch('close-modal', 'editItem');
                                this.resetEditForm();
                                await this.refreshTable();
                            } else {
                                if (data.errors) {
                                    this.editForm.errors = data.errors;
                                } else {
                                    this.showAlert('error', data.message || 'Failed to update barcode');
                                }
                            }
                        } catch (error) {
                            this.showAlert('error', 'An error occurred. Please try again.');
                        } finally {
                            this.editForm.loading = false;
                        }
                    },

                    deleteBarcode(id) {
                        this.deleteForm.id = id;
                        this.$dispatch('open-modal', 'deleteConfirm');
                    },

                    async confirmDelete() {
                        this.deleteForm.loading = true;
                        let destroyUrl = "{{ route('barcodes.destroy', ':id') }}";
                        destroyUrl = destroyUrl.replace(':id', this.deleteForm.id);
                        try {
                            const response = await fetch(destroyUrl, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                    'Accept': 'application/json'
                                }
                            });

                            const data = await response.json();

                            if (response.ok) {
                                this.showAlert('success', 'Barcode deleted successfully!');
                                this.$dispatch('close-modal', 'deleteConfirm');
                                await this.refreshTable();
                            } else {
                                this.showAlert('error', data.message || 'Failed to delete barcode');
                            }
                        } catch (error) {
                            this.showAlert('error', 'An error occurred. Please try again.');
                        } finally {
                            this.deleteForm.loading = false;
                        }
                    },

                    async refreshTable() {
                        try {
                            const response = await fetch(window.location.href, {
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest',
                                    'Accept': 'text/html'
                                }
                            });

                            const html = await response.text();
                            const parser = new DOMParser();
                            const doc = parser.parseFromString(html, 'text/html');
                            const newTableBody = doc.querySelector('#barcode-table-body');

                            if (newTableBody) {
                                document.querySelector('#barcode-table-body').innerHTML = newTableBody.innerHTML;
                            }
                        } catch (error) {
                            console.error('Failed to refresh table:', error);
                        }
                    },

                    async searchBarcodes(query) {
                        try {
                            const url = new URL(window.location.href);
                            url.searchParams.set('search', query);

                            if (!query) {
                                url.searchParams.delete('search');
                            }

                            const response = await fetch(url.toString(), {
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest',
                                    'Accept': 'text/html'
                                }
                            });

                            const html = await response.text();
                            const parser = new DOMParser();
                            const doc = parser.parseFromString(html, 'text/html');

                            // Update table body
                            const newTableBody = doc.querySelector('#barcode-table-body');
                            if (newTableBody) {
                                document.querySelector('#barcode-table-body').innerHTML = newTableBody.innerHTML;
                            }

                            // Update pagination
                            const newPagination = doc.querySelector('#pagination-container');
                            if (newPagination) {
                                const currentPagination = document.querySelector('#pagination-container');
                                if (currentPagination) {
                                    currentPagination.innerHTML = newPagination.innerHTML;
                                }
                            }

                            // Update URL without page reload
                            window.history.pushState({}, '', url.toString());
                        } catch (error) {
                            console.error('Failed to search:', error);
                            this.showAlert('error', 'Failed to perform search');
                        }
                    }
                }
            }
        </script>
    @endpush
</x-app-layout>
