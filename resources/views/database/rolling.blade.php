@extends('layouts.main')
@section('main')

@if(Session::has('error'))
<div class="alert alert-danger">
    {{ Session::get('error') }}
</div>
@endif
<div class="w-full pt-5 px-4 sm:px-6 md:px-8 lg:pl-72">
    <header class="">
        <h1 class="block text-lg font-bold text-gray-800 dark:text-white">Rolling Majelis
    </header>
    <hr class="my-5">
    <button id="add" type="button"
        class="py-3 px-4 inline-flex justify-center items-center gap-2 border border-transparent font-semibold bg-gray-800 text-white hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-800 focus:ring-offset-2 transition-all text-sm dark:focus:ring-gray-900 dark:focus:ring-offset-gray-800">
        Add Row
    </button>
    <hr class="my-5">
    <div class="flex flex-col w-2/3">
        <div class="-m-1.5 overflow-x-auto">
            <div class="p-1.5 min-w-full inline-block align-middle">
                <form action="{{ route('rolling.update') }}" method="post">
                    @csrf
                    <div class="border rounded-lg shadow overflow-hidden dark:border-gray-700 dark:shadow-gray-900">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase dark:text-gray-400">
                                        Nama Majelis</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase dark:text-gray-400">
                                        Petugas</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase dark:text-gray-400">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody id="list-tr" class="divide-y divide-gray-200 dark:divide-gray-700">
                                <tr>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                        <select name="majelis[]" id="majelis">
                                            @foreach ($anggota as $item)
                                            <option value="{{ $item->majelis }}">{{ $item->majelis }}</option>
                                            @endforeach
                                        </select></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                        <select name="petugas" id="petugas">
                                            @foreach ($petugas as $item)
                                            <option value="{{ $item->sub_name }}">{{ $item->sub_name }}</option>
                                            @endforeach
                                        </select>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <button class="text-blue-500 hover:text-blue-700"
                                            onclick="deleteRow(this)">Delete</button>
                                    </td>
                                </tr>
                            </tbody>

                        </table>
                        <div class="flex justify-center gap-x-5 py-2 border-t ">
                            <button type="submit"
                                class="py-3 px-4 inline-flex justify-center items-center gap-2 border border-transparent font-semibold bg-indigo-500 text-white hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all text-sm dark:focus:ring-offset-gray-800">
                                Update
                            </button>
                            <button type="button"
                                class="py-3 px-4 inline-flex justify-center items-center gap-2 border border-transparent font-semibold bg-indigo-500 text-white hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all text-sm dark:focus:ring-offset-gray-800">
                                Cancel
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    const html = ` <tr>
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                    <select name="majelis[]" id="majelis">
                                        @foreach ($anggota as $item)
                                        <option value="{{ $item->majelis }}">{{ $item->majelis }}</option>
                                        @endforeach
                                    </select></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                    <select name="petugas" id="petugas">
                                        @foreach ($petugas as $item)
                                        <option value="{{ $item->sub_name }}">{{ $item->sub_name }}</option>
                                        @endforeach
                                    </select>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <button class="text-blue-500 hover:text-blue-700"
                                        onclick="deleteRow(this)">Delete</button>
                                </td>
                            </tr>`
    $('#add').click(function (e) {
        e.preventDefault();
        $('#list-tr').append(html);
    });

    function deleteRow(element) {
        $(element).closest('tr').remove();
    }

</script>
@endpush
