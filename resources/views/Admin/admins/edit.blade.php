
@extends("Admin.layouts.master")

@section("content")

    <div class="card">

        <div class="card-header">
            <h5 class="mb-0">ویرایش اطلاعات مدیر</h5>
        </div>

        <div class="card-body">

            <form action="{{ route('admins.update', $admin->id) }}"
                  method="POST">

                @csrf
                @method('PUT')

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">نام و نام خانوادگی</label>
                        <input type="text" name="fullname"
                               class="form-control"
                               value="{{ old('fullname', $admin->fullname) }}">

                        @error('fullname')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">نام کاربری</label>
                        <input type="text" name="username"
                               class="form-control"
                               value="{{ old('username', $admin->username) }}">

                        @error('username')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">ایمیل</label>
                        <input type="email" name="email"
                               class="form-control"
                               value="{{ old('email', $admin->email) }}">

                        @error('email')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">شماره تماس</label>
                        <input type="text" name="phone"
                               class="form-control"
                               value="{{ old('phone', $admin->phone) }}">

                        @error('phone')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">رمز عبور جدید</label>
                        <input type="password" name="password"
                               class="form-control"
                               placeholder="در صورت عدم تغییر خالی بگذارید">

                        @error('password')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">تکرار رمز عبور جدید</label>
                        <input type="password"
                               name="password_confirmation"
                               class="form-control">
                    </div>

                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="ti ti-device-floppy me-1"></i>
                    ذخیره تغییرات
                </button>

                <a href="{{ route('admins.index') }}" class="btn btn-secondary">
                    بازگشت
                </a>

            </form>

        </div>
    </div>

@endsection
