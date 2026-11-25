
@extends('Admin.layouts.master')

@section('content')

    <div class="card">
        <div class="d-flex justify-content-between align-items-center card-header">
            <h5 class="mb-0">تنظیمات سایت</h5>

            @if($setting->isEmpty())
                <a href="{{ route('settings.create') }}" class="btn btn-primary">
                    <i class="ti ti-plus me-1"></i>
                    افزودن تنظیمات
                </a>
            @endif
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>لوگو</th>
                    <th>عنوان سایت</th>
                    <th>توضیحات</th>
                    <th>شماره تماس</th>
                    <th>اینستاگرام</th>
                    <th>عملیات</th>
                </tr>
                </thead>

                <tbody class="table-border-bottom-0">
                @forelse($setting as $item)
                    <tr>
                        <td>
                            @if($item->logo)
                                <img src="{{ asset('storage/' . $item->logo) }}"
                                     width="50" height="50"
                                     style="object-fit: cover;">
                            @else
                                بدون لوگو
                            @endif
                        </td>

                        <td>{{ $item->title }}</td>
                        <td>{{ $item->description }}</td>
                        <td>{{ $item->phone ?? '—' }}</td>
                        <td>{{ $item->instagram ?? '—' }}</td>

                        <td>
                            <div class="dropdown">
                                <button type="button"
                                        class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                    <i class="ti ti-dots-vertical"></i>
                                </button>

                                <div class="dropdown-menu">
                                    <a class="dropdown-item"
                                       href="{{ route('settings.edit', $item->id) }}">
                                        <i class="ti ti-pencil me-1"></i>
                                        ویرایش
                                    </a>

                                    <form action="{{ route('settings.destroy', $item->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('آیا از حذف تنظیمات مطمئن هستید؟')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="dropdown-item text-danger">
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
                        <td colspan="6" class="text-center text-muted py-3">
                            هنوز تنظیماتی ثبت نشده است.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
