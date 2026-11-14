@extends("Admin.layouts.master")
@section("content")
    <!-- Basic Bootstrap Table -->
    <div class="card">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-header">دسته بندی اخبار</h5>
            <button type="button" class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#createCategoryNewsModal">
                <i class="ti ti-plus me-1"></i> افزودن دسته بندی اخبار
            </button>
        </div>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                <tr>
                    <th>عنوان</th>
                    <th>توضیحات</th>
                    <th>وضعیت</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                @forelse($categories as $category)
                    <tr>
                        <td><span class="fw-medium">{{ $category->title }}</span></td>
                        <td>{{ $category->description }}</td>
                        <td>
                            @if($category->status)
                                <span class="badge bg-label-success me-1">فعال</span>
                            @else
                                <span class="badge bg-label-danger me-1">غیرفعال</span>
                            @endif
                        </td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="ti ti-dots-vertical"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#"
                                       data-bs-toggle="modal"
                                       data-bs-target="#editCategoryNewsModal"
                                       data-id="{{ $category->id }}"
                                       data-title="{{ $category->title }}"
                                       data-description="{{ $category->description }}"
                                       data-status="{{ $category->status ? 1 : 0 }}">
                                        <i class="ti ti-pencil me-1"></i> ویرایش
                                    </a>
                                    <form action="{{ route('category_news.destroy', $category->id) }}" method="POST" onsubmit="return confirm('آیا از حذف دسته بندی مطمئن هستید؟')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="ti ti-trash me-1"></i> حذف
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted py-3">هیچ دسته بندی اخباری ثبت نشده است.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <!--/ Basic Bootstrap Table -->

    <!-- Create Category News Modal -->
    <div class="modal fade" id="createCategoryNewsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('category_news.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">افزودن دسته بندی اخبار</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">عنوان</label>
                            <input type="text" name="title" class="form-control" value="{{ old('title') }}" />
                            @error('title') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">توضیحات</label>
                            <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                            @error('description') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">وضعیت</label>
                            <select name="status" class="form-select">
                                <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>فعال</option>
                                <option value="0" {{ old('status') === '0' ? 'selected' : '' }}>غیرفعال</option>
                            </select>
                            @error('status') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">بستن</button>
                        <button type="submit" class="btn btn-primary">ذخیره</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Category News Modal -->
    <div class="modal fade" id="editCategoryNewsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="editCategoryNewsForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">ویرایش دسته بندی اخبار</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">عنوان</label>
                            <input type="text" name="title" id="edit_category_news_title" class="form-control" />
                            @error('title') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">توضیحات</label>
                            <textarea name="description" id="edit_category_news_description" class="form-control" rows="3"></textarea>
                            @error('description') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">وضعیت</label>
                            <select name="status" id="edit_category_news_status" class="form-select">
                                <option value="1">فعال</option>
                                <option value="0">غیرفعال</option>
                            </select>
                            @error('status') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">بستن</button>
                        <button type="submit" class="btn btn-primary">ذخیره تغییرات</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- پر کردن modal ویرایش و باز شدن خودکار بعد از خطا -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var editModal = document.getElementById('editCategoryNewsModal');

            editModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget;
                if (!button) return;

                var id = button.getAttribute('data-id');
                var title = button.getAttribute('data-title');
                var description = button.getAttribute('data-description');
                var status = button.getAttribute('data-status');

                var form = document.getElementById('editCategoryNewsForm');
                form.action = "{{ url('Admin/category_news') }}/" + id;

                document.getElementById('edit_category_news_title').value = title || '';
                document.getElementById('edit_category_news_description').value = description || '';
                document.getElementById('edit_category_news_status').value = status;
            });

            @if($errors->any())
            // اگر رکورد در حال ویرایش بود (session edit_id) modal ویرایش، وگرنه modal ایجاد
            new bootstrap.Modal(document.getElementById('{{ session('edit_id') ? 'editCategoryNewsModal' : 'createCategoryNewsModal' }}')).show();
            @endif
        });
    </script>

    <hr class="my-5" />
@endsection
