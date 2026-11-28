
@extends("Admin.layouts.master")
@section("content")
    <div class="card">
        <div class="d-flex justify-content-between align-items-center card-header">
            <h5 class="mb-0">واچ‌ لیست ها</h5>
            <a href="{{ route('watchlist.create') }}" class="btn btn-primary">
                <i class="ti ti-plus me-1"></i> افزودن به واچ‌ لیست
            </a>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>شناسه کاربر</th>
                    <th>شناسه فیلم</th>
                    <th>عنوان</th>
                    <th>وضعیت</th>
                    <th>عملیات</th>
                </tr>
                </thead>

                <tbody class="table-border-bottom-0">
                @forelse($watchlist as $item)
                    <tr>
                        <td>{{ $item->user_id }}</td>
                        <td>{{ $item->movie_id }}</td>
                        <td><span class="fw-medium">{{ $item->title }}</span></td>
                        <td>
                            @if($item->status == 1)
                                <span class="badge bg-label-success">فعال</span>
                            @else
                                <span class="badge bg-label-secondary">غیرفعال</span>
                            @endif
                        </td>

                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="ti ti-dots-vertical"></i>
                                </button>

                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('watchlist.edit', $item->id) }}">
                                        <i class="ti ti-pencil me-1"></i> ویرایش
                                    </a>

                                    <form action="{{ route('watchlist.destroy', $item->id) }}" method="POST"
                                          onsubmit="return confirm('آیا از حذف این مورد مطمئن هستید؟')">
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
                        <td colspan="5" class="text-center text-muted py-3">
                            هیچ موردی در واچ‌لیست ثبت نشده است.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
