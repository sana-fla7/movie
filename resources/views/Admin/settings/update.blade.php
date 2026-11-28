
@extends('Admin.layouts.master')

@section('content')

    <div class="col-md mb-4 mb-md-0">
        <div class="card">
            <h5 class="card-header">
                ویرایش تنظیمات {{ $setting->title }}
            </h5>

            <div class="card-body">

                <form class="browser-default-validation"
                      action="{{ route('settings.update', $setting->id) }}"
                      method="POST"
                      enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

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
                            value="{{ old('title', $setting->title) }}"
                            required />
                    </div>

                    <div class="mb-3">
                        <label class="form-label">توضیحات سایت</label>
                        <textarea
                            name="description"
                            class="form-control"
                            rows="4"
                            required>{{ old('description', $setting->description) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">شماره تماس</label>
                        <input
                            name="phone"
                            type="text"
                            class="form-control"
                            value="{{ old('phone', $setting->phone) }}" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label">اینستاگرام</label>
                        <input
                            name="instagram"
                            type="text"
                            class="form-control"
                            value="{{ old('instagram', $setting->instagram) }}" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label">لوگوی فعلی</label>

                        @if($setting->logo)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $setting->logo) }}"
                                     width="100" height="100"
                                     style="object-fit: cover;" alt="">
                            </div>
                        @else
                            <p>لوگویی ثبت نشده است.</p>
                        @endif

                        <label class="form-label">انتخاب لوگوی جدید</label>
                        <input
                            name="logo"
                            type="file"
                            class="form-control"
                            accept="image/*" />
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">
                                ویرایش تنظیمات
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

@endsection
