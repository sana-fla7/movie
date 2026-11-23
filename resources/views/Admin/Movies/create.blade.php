@extends("Admin.layouts.master")
@section("content")
    <div class="card">
        <div class="d-flex justify-content-between align-items-center card-header">
            <h5 class="mb-0">افزودن فیلم جدید</h5>
            <a href="{{ route('movies.index') }}" class="btn btn-label-secondary">
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

        <form action="{{ route('movies.store') }}"
              method="POST"
              enctype="multipart/form-data"
              class="p-4">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">عنوان <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                           value="{{ old('title') }}" />
                    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">دسته بندی <span class="text-danger">*</span></label>
                    <select name="category_id" class="form-select @error('category_id') is-invalid @enderror">
                        <option value="">— انتخاب —</option>
                        @forelse($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @empty
                            <option value="" disabled>هیچ دسته بندی وجود ندارد</option>
                        @endforelse
                    </select>
                    @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">سال <span class="text-danger">*</span></label>
                    <input type="text" name="year" maxlength="4" class="form-control @error('year') is-invalid @enderror"
                           value="{{ old('year') }}" />
                    @error('year') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">کشور <span class="text-danger">*</span></label>
                    <input type="text" name="country" class="form-control @error('country') is-invalid @enderror"
                           value="{{ old('country') }}" />
                    @error('country') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">مدت زمان <span class="text-danger">*</span></label>
                    <input type="text" name="time" class="form-control @error('time') is-invalid @enderror"
                           value="{{ old('time') }}" placeholder="مثلاً 120 دقیقه" />
                    @error('time') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">IMDb</label>
                    <input type="number" name="imdb" min="0" max="10"
                           class="form-control @error('imdb') is-invalid @enderror"
                           value="{{ old('imdb', 0) }}" />
                    @error('imdb') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">وضعیت <span class="text-danger">*</span></label>
                    <select name="status" class="form-select @error('status') is-invalid @enderror">
                        <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>فعال</option>
                        <option value="0" {{ old('status') === '0' ? 'selected' : '' }}>غیرفعال</option>
                    </select>
                    @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">پوستر</label>
                    <input type="file" name="poster" accept="image/*"
                           class="form-control @error('poster') is-invalid @enderror" />
                    @error('poster') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-12 mb-3">
                    <label class="form-label">توضیحات</label>
                    <textarea name="description" rows="2"
                              class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-12 mb-3">
                    <label class="form-label">محتوا</label>
                    <textarea name="content" rows="4"
                              class="form-control @error('content') is-invalid @enderror">{{ old('content') }}</textarea>
                    @error('content') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="d-flex gap-2 pt-3 border-top">
                <button type="submit" class="btn btn-primary">ذخیره</button>
                <a href="{{ route('movies.index') }}" class="btn btn-label-secondary">انصراف</a>
            </div>
        </form>
    </div>
@endsection
