@extends("Admin.layouts.master")
@section("content")
    <!-- Basic Bootstrap Table -->
    <div class="card">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-header">تنظیمات</h5>
            @if(!$setting)
                <button type="button" class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#createSettingModal">
                    <i class="ti ti-plus me-1"></i> افزودن تنظیمات
                </button>
            @endif
        </div>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        @if($setting)
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                    <tr>
                        <th>نام</th>
                        <th>توضیحات</th>
                        <th>لوگو</th>
                        <th>شماره تلفن</th>
                        <th>آدرس اینستاگرام</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    <tr>
                        <td>
                            <span class="fw-medium">{{ $setting->title }}</span>
                        </td>
                        <td>{{ $setting->description }}</td>
                        <td>
                            <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                <li
                                    data-bs-toggle="tooltip"
                                    data-popup="tooltip-custom"
                                    data-bs-placement="top"
                                    class="avatar avatar-xs pull-up"
                                    title="{{ $setting->title }}">
                                    @if($setting->logo)
                                        <img src="{{ asset('storage/' . $setting->logo) }}" alt="Logo" />
                                    @else
                                        <img width="50" src="{{ asset('storage/setting/images.png') }}">
                                @endif
                            </ul>
                        </td>
                        <td><span class="badge bg-label-primary me-1">{{ $setting->phone }}</span></td>
                        <td>{{ $setting->instagram }}</td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="ti ti-dots-vertical"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editSettingModal">
                                        <i class="ti ti-pencil me-1"></i> ویرایش
                                    </a>
                                    <form action="{{ route('settings.destroy', $setting->id) }}" method="POST" onsubmit="return confirm('آیا از حذف تنظیمات مطمئن هستید؟')">
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
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-info m-3">
                هیچ تنظیماتی ثبت نشده است.
            </div>
        @endif
    </div>
    <!--/ Basic Bootstrap Table -->

    <!-- Create Setting Modal -->
    @if(!$setting)
        <div class="modal fade" id="createSettingModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form action="{{ route('settings.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title">افزودن تنظیمات</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">نام</label>
                                    <input type="text" name="title" class="form-control" value="{{ old('title') }}" />
                                    @error('title') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">شماره تلفن</label>
                                    <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" />
                                    @error('phone') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">آدرس اینستاگرام</label>
                                    <input type="text" name="instagram" class="form-control" value="{{ old('instagram') }}" />
                                    @error('instagram') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">لوگو</label>
                                    <input type="file" name="logo" class="form-control" accept="image/*" />
                                    @error('logo') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label">توضیحات</label>
                                    <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                                    @error('description') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                                </div>
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
    @endif

    <!-- Edit Setting Modal -->
    @if($setting)
        <div class="modal fade" id="editSettingModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form action="{{ route('settings.update', $setting->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title">ویرایش تنظیمات</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">نام</label>
                                    <input type="text" name="title" class="form-control" value="{{ old('title', $setting->title) }}" />
                                    @error('title') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">شماره تلفن</label>
                                    <input type="text" name="phone" class="form-control" value="{{ old('phone', $setting->phone) }}" />
                                    @error('phone') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">آدرس اینستاگرام</label>
                                    <input type="text" name="instagram" class="form-control" value="{{ old('instagram', $setting->instagram) }}" />
                                    @error('instagram') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">لوگو</label>
                                    <input type="file" name="logo" class="form-control" accept="image/*" />
                                    @error('logo') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label">توضیحات</label>
                                    <textarea name="description" class="form-control" rows="3">{{ old('description', $setting->description) }}</textarea>
                                    @error('description') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                                </div>
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
    @endif

    @if($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var modalId = @json($setting ? 'editSettingModal' : 'createSettingModal');
                var el = document.getElementById(modalId);
                if (el) {
                    new bootstrap.Modal(el).show();
                }
            });
        </script>
    @endif

    <hr class="my-5" />
@endsection
