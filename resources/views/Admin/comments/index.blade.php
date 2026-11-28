
@extends("Admin.layouts.master")
@section("content")
    <div class="card">
        <div class="d-flex justify-content-between align-items-center card-header">
            <h5 class="mb-0">نظرات</h5>
            <a href="{{ route('comments.create') }}" class="btn btn-primary">
                <i class="ti ti-plus me-1"></i> افزودن نظر
            </a>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>کاربر</th>
                    <th>فیلم</th>
                    <th>متن نظر</th>
                    <th>عملیات</th>
                </tr>
                </thead>

                <tbody class="table-border-bottom-0">
                @forelse($comments as $comment)
                    <tr>
                        <td>{{ $comment->user_id }}</td>
                        <td>{{ $comment->movie_id }}</td>
                        <td>{{ $comment->massage }}</td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="ti ti-dots-vertical"></i>
                                </button>

                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('comments.edit', $comment->id) }}">
                                        <i class="ti ti-pencil me-1"></i> ویرایش
                                    </a>

                                    <form action="{{ route('comments.destroy', $comment->id) }}" method="POST"
                                          onsubmit="return confirm('آیا از حذف این نظر مطمئن هستید؟')">
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
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted py-3">
                            هیچ نظری ثبت نشده است.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
