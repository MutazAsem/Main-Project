<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="{{ asset('vendor/school/images/logo.png') }}">
    <!-- تحميل ملف CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/school/css/style.css') }}">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>

    <!-- تحميل ملف JavaScript -->


    <title>School Package</title>
</head>

<body>
    <div class="p-5">
            @if(session('success'))
            <div class="bg-green-500 text-white p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex flex-row justify-between p-2">
            <h1 class="text-2xl">
                StudentList
            </h1>
            <a href="{{ route('students.create') }}" class="bg-blue-600 text-white p-2 rounded-md">
                Create New Student
            </a>
        </div>
        <div
            class="relative flex flex-col w-full h-full overflow-scroll text-gray-700 bg-white shadow-md rounded-xl bg-clip-border">
            <table class="w-full text-left table-auto min-w-max">
                <thead>
                    <tr>
                        <th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
                            <p
                                class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                Name
                            </p>
                        </th>
                        <th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
                            <p
                                class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                Email
                            </p>
                        </th>
                        <th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
                            <p
                                class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                            </p>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                        <tr>
                            <td class="p-4 border-b border-blue-gray-50">
                                <p
                                    class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                    {{$student->name}}
                                </p>
                            </td>
                            <td class="p-4 border-b border-blue-gray-50">
                                <p
                                    class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                    {{$student->email}}
                                </p>
                            </td>
                            <td class="p-4 border-b border-blue-gray-50">
                                <a href="{{ route('students.show', ['student' => $student->id]) }}"
                                    class="block font-sans text-blue-600 text-sm antialiased font-medium leading-normal text-blue-gray-900">
                                    View
                                </a>
                                <a href="{{ route('students.edit', ['student' => $student->id]) }}"
                                    class="block font-sans text-sm antialiased font-medium leading-normal text-blue-gray-900">
                                    Edit
                                </a>
                                <form action="{{ route('students.destroy', ['student' => $student->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="block text-red-700 font-sans text-sm antialiased font-medium leading-normal text-blue-gray-900">
                                        Delete
                                    </button>
                                </form>
                                {{-- <a href="{{ route('students.destroy', ['student' => $student->id]) }}"
                                    class="block text-red-700 font-sans text-sm antialiased font-medium leading-normal text-blue-gray-900">
                                    Delete
                                </a> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script src="{{ asset('vendor/school/js/main.js') }}"></script>
</body>

</html>
