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
        <h1>
            Create Student
        </h1>
        <div class="p-5 bg-gray-400 m-2 rounded-xl">
            <form action="{{ route('students.store') }}" method="POST">
                @csrf
                <div class="flex flex-col gap-5">
                    <div>
                        <label for="name">Name:</label>
                        <input type="text" name="name" class="border bg-white" required
                            value="{{ old('name') }}">
                        {{-- @error('name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror --}}
                    </div>
                    <div>
                        <label for="email">Email:</label>
                        <input type="email" name="email" class="border bg-white" required
                            value="{{ old('email') }}">
                        {{-- @error('email')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror --}}
                    </div>
                    <button type="submit" class="bg-blue-500 rounded-2xl p-2">Create Now</button>
                </div>
            </form>
        </div>
    </div>
    <script src="{{ asset('vendor/school/js/main.js') }}"></script>
</body>

</html>
