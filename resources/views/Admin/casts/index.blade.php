@extends("Admin.layouts.master")
@section("content")
    <!-- Basic Bootstrap Table -->
    <div class="card">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-header">بازیگران و کارگردانان</h5>
            <button type="button" class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#createCastModal">
                <i class="ti ti-plus me-1"></i> افزودن
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
                    <th>تصویر</th>
                    <th>نام کامل</th>
                    <th>نقش</th>
                    <th>توضیحات</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                @forelse($casts as $cast)
                    <tr>
                        <td>
                            @if($cast->image)
                                <img src="{{ asset('storage/' . $cast->image) }}" alt="{{ $cast->full_name }}" width="50" height="50" class="rounded-circle" style="object-fit: cover;" />
                            @else
                                <img src="{{ asset('storage/cast/images.png') }}" alt="بدون تصویر" width="50" height="50" class="rounded-circle" style="object-fit: cover;" />
                            @endif
                        </td>
                        <td><span class="fw-medium">{{ $cast->full_name }}</span></td>
                        <td>
                            @if($cast->role === 'actor')
                                <span class="badge bg-label-primary me-1">بازیگر</span>
                            @else
                                <span class="badge bg-label-warning me-1">کارگردان</span>
                            @endif
                        </td>
                        <td>{{ \Illuminate\Support\Str::limit($cast->description, 60) }}</td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="ti ti-dots-vertical"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#"
                                       data-bs-toggle="modal"
                                       data-bs-target="#editCastModal"
                                       data-id="{{ $cast->id }}"
                                       data-full_name="{{ $cast->full_name }}"
                                       data-description="{{ $cast->description }}"
                                       data-role="{{ $cast->role }}">
                                        <i class="ti ti-pencil me-1"></i> ویرایش
                                    </a>
                                    <form action="{{ route('casts.destroy', $cast->id) }}" method="POST" onsubmit="return confirm('آیا از حذف مطمئن هستید؟')">
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
                        <td colspan="5" class="text-center text-muted py-3">هیچ رکوردی ثبت نشده است.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <!--/ Basic Bootstrap Table -->

    <!-- Create Cast Modal -->
    <div class="modal fade" id="createCastModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('casts.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">افزودن بازیگر / کارگردان</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">نام کامل</label>
                            <input type="text" name="full_name" class="form-control" value="{{ old('full_name') }}" />
                            @error('full_name') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">نقش</label>
                            <select name="role" class="form-select">
                                <option value="actor" {{ old('role') === 'actor' ? 'selected' : '' }}>بازیگر</option>
                                <option value="director" {{ old('role') === 'director' ? 'selected' : '' }}>کارگردان</option>
                            </select>
                            @error('role') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">تصویر</label>
                            <input type="file" name="image" class="form-control" accept="image/*" />
                            @error('image') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">توضیحات</label>
                            <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                            @error('description') <div class="text-danger mt-1">{{ $message }}</div> @enderror
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

    <!-- Edit Cast Modal -->
    <div class="modal fade" id="editCastModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="editCastForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">ویرایش بازیگر / کارگردان</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">نام کامل</label>
                            <input type="text" name="full_name" id="edit_cast_full_name" class="form-control" />
                            @error('full_name') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">نقش</label>
                            <select name="role" id="edit_cast_role" class="form-select">
                                <option value="actor">بازیگر</option>
                                <option value="director">کارگردان</option>
                            </select>
                            @error('role') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">تصویر</label>
                            <input type="file" name="image" class="form-control" accept="image/*" />
                            <small class="text-muted">در صورت انتخاب نکردن، تصویر قبلی حفظ می‌شود.</small>
                            @error('image') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">توضیحات</label>
                            <textarea name="description" id="edit_cast_description" class="form-control" rows="3"></textarea>
                            @error('description') <div class="text-danger mt-1">{{ $message }}</div> @enderror
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
            var editModal = document.getElementById('editCastModal');

            editModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget;
                if (!button) return;

                var id = button.getAttribute('data-id');
                var fullName = button.getAttribute('data-full_name');
                var description = button.getAttribute('data-description');
                var role = button.getAttribute('data-role');

                var form = document.getElementById('editCastForm');
                form.action = "{{ url('Admin/casts') }}/" + id;

                document.getElementById('edit_cast_full_name').value = fullName || '';
                document.getElementById('edit_cast_description').value = description || '';
                document.getElementById('edit_cast_role').value = role || 'actor';
            });

            @if($errors->any())
            new bootstrap.Modal(document.getElementById('{{ session('edit_id') ? 'editCastModal' : 'createCastModal' }}')).show();
            @endif
        });
    </script>

    <hr class="my-5" />
@endsection
