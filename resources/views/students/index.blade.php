<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen py-6 px-4 bg-violet-100">
    <div class="max-w-5xl mx-auto">

        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 gap-3">
            <div class="text-center sm:text-left">
                <h1 class="text-2xl font-bold text-violet-900 tracking-tight">Student List</h1>
                <p class="text-violet-500 mt-1 text-sm">All registered students</p>
            </div>
            <a href="{{ route('students.create') }}"
               class="bg-violet-500 hover:bg-violet-600 text-white font-semibold px-5 py-2.5 rounded-lg shadow-lg shadow-violet-400/30 transition transform hover:-translate-y-0.5 flex items-center justify-center gap-2 whitespace-nowrap">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Register Student
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 text-sm rounded-lg px-4 py-3 mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Card -->
        <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-violet-200">
            @if($students->count())
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-violet-50 text-violet-700 uppercase text-xs tracking-wide">
                            <tr>
                                <th class="px-4 py-3">Photo</th>
                                <th class="px-4 py-3">Student ID</th>
                                <th class="px-4 py-3">Full Name</th>
                                <th class="px-4 py-3">Email</th>
                                <th class="px-4 py-3">Program</th>
                                <th class="px-4 py-3">Year Level</th>
                                <th class="px-4 py-3 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($students as $student)
                                <tr class="hover:bg-violet-50/50 transition">
                                    <td class="px-4 py-3">
                                        @if($student->profile_picture)
                                            <img src="{{ asset('storage/' . $student->profile_picture) }}"
                                                 class="w-9 h-9 rounded-full object-cover border-2 border-violet-200">
                                        @else
                                            <div class="w-9 h-9 rounded-full bg-violet-50 border-2 border-dashed border-violet-300 flex items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-violet-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                                </svg>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 font-medium text-slate-800">{{ $student->student_id }}</td>
                                    <td class="px-4 py-3 text-slate-700">{{ $student->first_name }} {{ $student->last_name }}</td>
                                    <td class="px-4 py-3 text-slate-700">{{ $student->email }}</td>
                                    <td class="px-4 py-3 text-slate-700">{{ $student->program }}</td>
                                    <td class="px-4 py-3 text-slate-700">{{ $student->year_level }}</td>
                                    <td class="px-4 py-3 text-center">
                                        <a href="{{ route('students.show', $student->id) }}"
                                           class="inline-block bg-violet-100 hover:bg-violet-200 text-violet-700 text-xs font-semibold px-3 py-1.5 rounded-lg transition">
                                            View
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-12">
                    <p class="text-slate-400 text-sm">No students registered yet.</p>
                </div>
            @endif
        </div>

        <p class="text-center text-violet-400 text-xs mt-4">Total students: {{ $students->count() }}</p>
    </div>
</body>
</html>