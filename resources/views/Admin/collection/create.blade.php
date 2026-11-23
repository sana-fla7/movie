@extends("Admin.layouts.master")
@section("content")
    <div class="card">
        <div class="d-flex justify-content-between align-items-center card-header">
            <h5 class="mb-0">افزودن کالکشن جدید</h5>
            <a href="{{ route('collection.index') }}" class="btn btn-label-secondary">
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

        <form action="{{ route('collection.store') }}" method="POST" enctype="multipart/form-data" class="p-4">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">عنوان <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                           value="{{ old('title') }}" />
                    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">فیلم <span class="text-danger">*</span></label>
                    <select name="movie_id" class="form-select @error('movie_id') is-invalid @enderror">
                        <option value="">— انتخاب —</option>
                        @forelse($movies as $movie)
                            <option value="{{ $movie->id }}" {{ old('movie_id') == $movie->id ? 'selected' : '' }}>
                                {{ $movie->title }}
                            </option>
                        @empty
                            <option value="" disabled>هیچ فیلمی وجود ندارد</option>
                        @endforelse
                    </select>
                    @error('movie_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label">تصویر</label>
                    <input type="file" name="image" accept="image/*"
                           class="form-control @error('image') is-invalid @enderror" />
                    @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="d-flex gap-2 pt-3 border-top">
                <button type="submit" class="btn btn-primary">ذخیره</button>
                <a href="{{ route('collection.index') }}" class="btn btn-label-secondary">انصراف</a>
            </div>
        </form>
    </div>
@endsection
