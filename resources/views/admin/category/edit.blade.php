@extends('admin.layouts.layout')
@section('admin_page_title', 'Edit Category - Admin Panel')
@section('admin_layout')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Edit Category</h5>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissable fade show">
                            {{-- <ul type="none"> --}}
                                @foreach ($errors->all() as $error)
                                    {{-- <li> --}}
                                         *{{ $error }} <br>
                                    {{-- </li> --}}
                                @endforeach
                            {{-- </ul> --}}
                        </div>
                    @endif
                    @if (session("success"))
                        <div class="alert alert-success alert-dismissable fade show">
                            {{ session("success") }}
                        </div>
                    @endif
                    <form action="{{ route('update.cat', $category_info->id) }}" method="POST" enctype="multipart/form-data">

                        @csrf
                        @method('PUT')
                        <label for="category_name" class="form-label fw-bold mb-2">Category Name</label>
                        <input type="text" class="form-control mb-2" name="category_name" placeholder="Eelctronics" value="{{ $category_info->category_name }}">
                        
                        <label for="description" class="form-label fw-bold mb-2">Category Description</label>
                        <textarea class="form-control mb-2" name="description" placeholder="Describe your Brand"
                            rows="10"> {{ $category_info->description }}</textarea>

                        <label class="form-label fw-bold mb-2">Category Icon</label>
                        <div class="mb-3">
                            <!-- Show existing images -->
                            @if($category_info->icon_path)
                                <div class="d-flex flex-wrap gap-3">
                                    <div class="position-relative image-wrapper" style="width: 150px;">
                                        <img src="{{ asset('storage/' . $category_info->icon_path) }}" alt="Brand Logo"
                                            class="img-thumbnail w-100 h-auto object-fit">
                                        <button type="button"
                                            class="btn btn-danger btn-sm position-absolute top-0 end-0 remove-image"
                                            data-image-path="{{ $category_info->icon_path }}">✖</button>
                                    </div>
                                </div>
                            @endif

                        </div>

                        <!-- Hidden field to track deleted images -->
                        <input type="hidden" name="deleted_image" id="deleted-image" value="">


                        <label class="form-label fw-bold mb-2">Add New Image</label>

                        <input type="file" name="new_image" id="image-input" class="form-control mb-2">

                        <label for="slug" class="form-label fw-bold mb-2">Slug</label>
                        <input type="text" class="form-control mb-2" name="slug" placeholder="demo"
                            value="{{ $category_info->slug }}" readonly>

                        <label class="form-label fw-bold mb-2" for="is_featured">
                            Is Featured
                        </label><br>
                        <input class="mb-2" type="checkbox" name="is_featured" id="is_featured" value="1" {{ $category_info->is_featured ? 'checked' : '' }}> <br>


                        <label for="meta_title" class="form-label fw-bold mb-2">Meta Title</label>
                        <input type="text" class="form-control mb-2" name="meta_title" placeholder="Meta Titles"
                            value="{{ $category_info->meta_title }}">

                        <label for="meta_description" class="form-label fw-bold mb-2">Meta Description</label>
                        <input type="text" class="form-control mb-2" name="meta_description" placeholder="Meta Descriptions"
                            value="{{ $category_info->meta_description }}">

                        <button type="submit" class="btn btn-primary w-100">Update Category</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let deletedImage = "";

            document.querySelectorAll('.remove-image').forEach(button => {
                button.addEventListener('click', function () {
                    const imageWrapper = this.closest('.image-wrapper');
                    const imagePath = this.dataset.imagePath;

                    if (imageWrapper && imagePath) {
                        imageWrapper.remove(); // remove from DOM
                        deletedImage = imagePath; // store for backend
                        document.getElementById('deleted-image').value = deletedImage;
                    }
                });
            });

            // // Preview newly added image
            // const imageInput = document.getElementById('image-input');
            // if (imageInput) {
            //     imageInput.addEventListener('change', function (event) {
            //         let previewContainer = document.getElementById('new-image-preview');
            //         if (!previewContainer) {
            //             previewContainer = document.createElement('div');
            //             previewContainer.id = 'new-image-preview';
            //             this.parentNode.appendChild(previewContainer);
            //         }
            //         previewContainer.innerHTML = "";

            //         Array.from(event.target.files).forEach(file => {
            //             const reader = new FileReader();
            //             reader.onload = function (e) {
            //                 const imgWrapper = document.createElement('div');
            //                 imgWrapper.classList.add('position-relative', 'image-wrapper');
            //                 imgWrapper.style.width = '150px';
            //                 imgWrapper.style.height = '200px';
            //                 imgWrapper.style.display = 'flex';
            //                 imgWrapper.style.alignItems = 'center';
            //                 imgWrapper.style.justifyContent = 'center';

            //                 imgWrapper.innerHTML = `
            //                             <img src="${e.target.result}" class="img-thumbnail object-fit-contain" style="max-width: 100%; max-height: 100%;">
            //                         `;
            //                 previewContainer.appendChild(imgWrapper);
            //             };
            //             reader.readAsDataURL(file);
            //         });
            //     });
            // }
        });
    </script>

@endsection
