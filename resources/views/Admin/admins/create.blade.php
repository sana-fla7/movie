@extends("Admin.layouts.master")
@section("content")
    <div class="card">
        <div class="d-flex justify-content-between align-items-center card-header">
            <h5 class="mb-0">افزودن ادمین جدید</h5>
            <a href="{{ route('admins.index') }}" class="btn btn-label-secondary">
                ← بازگشت به لیست
            </a>
        </div>

        @if($errors->any())
            <div class="alert alert-danger m-3">
                <strong>لطفاً خطاهای زیر را برطرف کنید:</strong>
                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admins.store') }}" method="POST" class="p-4">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">نام کامل <span class="text-danger">*</span></label>
                    <input type="text" name="fullname" class="form-control @error('fullname') is-invalid @enderror"
                           value="{{ old('fullname') }}" />
                    @error('fullname') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">نام کاربری <span class="text-danger">*</span></label>
                    <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"
                           value="{{ old('username') }}" />
                    @error('username') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">ایمیل <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email') }}" />
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">تلفن</label>
                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                           value="{{ old('phone') }}" />
                    @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">رمز عبور <span class="text-danger">*</span></label>
                    <input type="password" name="password"
                           class="form-control @error('password') is-invalid @enderror" />
                    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">تکرار رمز عبور <span class="text-danger">*</span></label>
                    <input type="password" name="password_confirmation" class="form-control" />
                    <small class="text-muted">حداقل ۸ کاراکتر.</small>
                </div>
            </div>

            <div class="d-flex gap-2 pt-3 border-top">
                <button type="submit" class="btn btn-primary">ذخیره</button>
                <a href="{{ route('admins.index') }}" class="btn btn-label-secondary">انصراف</a>
            </div>
        </form>
    </div>
@endsection
