
@extends("Admin.layouts.master")
@section("content")
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">ویرایش واچ‌لیست</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('watchlist.update', $watchlist->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">کاربر</label>
                        <select name="user_id" class="form-select">
                            @foreach($users as $user)
                                <option value="{{ $user->id }}"
                                    {{ old('user_id', $watchlist->user_id) == $user->id ? 'selected' : '' }}>
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
                            @foreach($movies as $movie)
                                <option value="{{ $movie->id }}"
                                    {{ old('movie_id', $watchlist->movie_id) == $movie->id ? 'selected' : '' }}>
                                    {{ $movie->title }}
                                </option>
                            @endforeach
                        </select>
                        @error('movie_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">عنوان</label>
                        <input type="text" name="title" class="form-control"
                               value="{{ old('title', $watchlist->title) }}">
                        @error('title')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">وضعیت</label>
                        <select name="status" class="form-select">
                            <option value="1" {{ old('status', $watchlist->status) == 1 ? 'selected' : '' }}>فعال</option>
                            <option value="0" {{ old('status', $watchlist->status) == 0 ? 'selected' : '' }}>غیرفعال</option>
                        </select>
                        @error('status')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">ویرایش</button>
                <a href="{{ route('watchlist.index') }}" class="btn btn-secondary">بازگشت</a>
            </form>
        </div>
    </div>
@endsection
