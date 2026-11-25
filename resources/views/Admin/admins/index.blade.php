
@extends("Admin.layouts.master")

@section("content")

    <div class="card">

        <div class="d-flex justify-content-between align-items-center card-header">
            <h5 class="mb-0">مدیران سایت</h5>

            <a href="{{ route('admins.create') }}" class="btn btn-primary">
                <i class="ti ti-plus me-1"></i>
                افزودن مدیر
            </a>
        </div>

        @if(session('status'))
            <div class="alert alert-success mx-3 mt-3">
                {{ session('status') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table">

                <thead>
                <tr>
                    <th>نام و نام خانوادگی</th>
                    <th>نام کاربری</th>
                    <th>ایمیل</th>
                    <th>شماره تماس</th>
                    <th>عملیات</th>
                </tr>
                </thead>

                <tbody class="table-border-bottom-0">

                @forelse($admins as $admin)
                    <tr>
                        <td>
                            <span class="fw-medium">{{ $admin->fullname }}</span>
                        </td>

                        <td>{{ $admin->username }}</td>

                        <td>{{ $admin->email }}</td>

                        <td>{{ $admin->phone ?? '—' }}</td>

                        <td>
                            <div class="dropdown">

                                <button type="button"
                                        class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                    <i class="ti ti-dots-vertical"></i>
                                </button>

                                <div class="dropdown-menu">

                                    <a class="dropdown-item"
                                       href="{{ route('admins.edit', $admin->id) }}">
                                        <i class="ti ti-pencil me-1"></i>
                                        ویرایش
                                    </a>

                                    <form action="{{ route('admins.destroy', $admin->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('آیا از حذف این مدیر مطمئن هستید؟')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="dropdown-item text-danger">
                                            <i class="ti ti-trash me-1"></i>
                                            حذف
                                        </button>

                                    </form>

                                </div>
                            </div>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-3">
                            هیچ مدیری ثبت نشده است.
                        </td>
                    </tr>
                @endforelse

                </tbody>
            </table>
        </div>
    </div>

@endsection
