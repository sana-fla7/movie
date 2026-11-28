
@extends("Admin.layouts.master")
@section("content")
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">افزودن نظر</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('comments.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">کاربر</label>
                        <select name="user_id" class="form-select">
                            <option value="">انتخاب کاربر</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name ?? $user->fullname ?? $user->id }}
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">فیلم</label>
                        <select name="movie_id" class="form-select">
                            <option value="">انتخاب فیلم</option>
                            @foreach($movies as $movie)
                                <option value="{{ $movie->id }}" {{ old('movie_id') == $movie->id ? 'selected' : '' }}>
                                    {{ $movie->title }}
                                </option>
                            @endforeach
                        </select>
                        @error('movie_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="form-label">متن نظر</label>
                        <textarea name="massage" class="form-control" rows="4"
                                  placeholder="متن نظر را وارد کنید">{{ old('massage') }}</textarea>
                        @error('massage')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">ثبت</button>
                <a href="{{ route('comments.index') }}" class="btn btn-secondary">بازگشت</a>
            </form>
        </div>
    </div>
@endsection
