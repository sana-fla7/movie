
@extends('Admin.layouts.master')

@section('content')

    <div class="col-md mb-4 mb-md-0">
        <div class="card">
            <h5 class="card-header">اضافه کردن تنظیمات سایت</h5>

            <div class="card-body">

                <form class="browser-default-validation"
                      action="{{ route('settings.store') }}"
                      method="POST"
                      enctype="multipart/form-data">

                    @csrf

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="mb-3">
                        <label class="form-label">عنوان سایت</label>
                        <input
                            name="title"
                            type="text"
                            class="form-control"
                            value="{{ old('title') }}"
                            placeholder="عنوان سایت را وارد کنید"
                            required />
                    </div>

                    <div class="mb-3">
                        <label class="form-label">توضیحات سایت</label>
                        <textarea
                            name="description"
                            class="form-control"
                            rows="4"
                            placeholder="توضیحات سایت را وارد کنید"
                            required>{{ old('description') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">شماره تماس</label>
                        <input
                            name="phone"
                            type="text"
                            class="form-control"
                            value="{{ old('phone') }}"
                            placeholder="شماره تماس را وارد کنید" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label">اینستاگرام</label>
                        <input
                            name="instagram"
                            type="text"
                            class="form-control"
                            value="{{ old('instagram') }}"
                            placeholder="آدرس یا آیدی اینستاگرام" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label">لوگوی سایت</label>
                        <input
                            name="logo"
                            type="file"
                            class="form-control"
                            accept="image/*" />
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">
                                ارسال
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

@endsection
