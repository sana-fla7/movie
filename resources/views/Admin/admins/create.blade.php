
@extends("Admin.layouts.master")

@section("content")

    <div class="card">

        <div class="card-header">
            <h5 class="mb-0">افزودن مدیر جدید</h5>
        </div>

        <div class="card-body">

            <form action="{{ route('admins.store') }}" method="POST">
                @csrf

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">نام و نام خانوادگی</label>
                        <input type="text" name="fullname"
                               class="form-control"
                               value="{{ old('fullname') }}"
                               placeholder="نام کامل را وارد کنید">

                        @error('fullname')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">نام کاربری</label>
                        <input type="text" name="username"
                               class="form-control"
                               value="{{ old('username') }}"
                               placeholder="نام کاربری">

                        @error('username')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">ایمیل</label>
                        <input type="email" name="email"
                               class="form-control"
                               value="{{ old('email') }}"
                               placeholder="example@gmail.com">

                        @error('email')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">شماره تماس</label>
                        <input type="text" name="phone"
                               class="form-control"
                               value="{{ old('phone') }}"
                               placeholder="شماره تماس">

                        @error('phone')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">رمز عبور</label>
                        <input type="password" name="password"
                               class="form-control"
                               placeholder="رمز عبور">

                        @error('password')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">تکرار رمز عبور</label>
                        <input type="password"
                               name="password_confirmation"
                               class="form-control"
                               placeholder="تکرار رمز عبور">
                    </div>

                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="ti ti-device-floppy me-1"></i>
                    ثبت مدیر
                </button>

                <a href="{{ route('admins.index') }}" class="btn btn-secondary">
                    بازگشت
                </a>

            </form>

        </div>
    </div>

@endsection
