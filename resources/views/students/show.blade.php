<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen py-6 px-4 bg-violet-100">
    <div class="max-w-3xl mx-auto">

        <!-- Header -->
        <div class="text-center mb-4">
            <h1 class="text-2xl font-bold text-violet-900 tracking-tight">Student Profile</h1>
            <p class="text-violet-500 mt-1 text-sm">Registration details of the student</p>
        </div>

        <!-- Card -->
        <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-violet-200">
            <div class="p-5 sm:p-6 space-y-5">

                @if(session('success'))
                    <div class="bg-green-50 border border-green-200 text-green-700 text-sm rounded-lg px-4 py-3">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Profile Picture -->
                <div class="flex justify-center">
                    @if($student->profile_picture)
                        <img src="{{ asset('storage/' . $student->profile_picture) }}"
                             alt="Profile Picture"
                             class="w-24 h-24 rounded-full object-cover border-4 border-violet-300 shadow">
                    @else
                        <div class="w-24 h-24 rounded-full bg-violet-50 border-2 border-dashed border-violet-300 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-9 h-9 text-violet-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                            </svg>
                        </div>
                    @endif
                </div>

                <!-- Section: Personal Information -->
                <div>
                    <div class="flex items-center gap-2 mb-3">
                        <span class="flex items-center justify-center w-6 h-6 rounded-full bg-violet-500 text-white text-xs font-bold">1</span>
                        <h2 class="text-sm font-semibold text-violet-800 uppercase tracking-wide">Personal Information</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3.5">
                        <div>
                            <p class="text-sm font-medium text-slate-700 mb-1">Student ID</p>
                            <p class="w-full border border-slate-200 bg-slate-50 rounded-lg px-3 py-2 text-slate-800">{{ $student->student_id }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-slate-700 mb-1">Email Address</p>
                            <p class="w-full border border-slate-200 bg-slate-50 rounded-lg px-3 py-2 text-slate-800">{{ $student->email }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-slate-700 mb-1">Full Name</p>
                            <p class="w-full border border-slate-200 bg-slate-50 rounded-lg px-3 py-2 text-slate-800">
                                {{ $student->first_name }}
                                {{ $student->middle_name ? substr($student->middle_name, 0, 1).'.' : '' }}
                                {{ $student->last_name }}
                            </p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-slate-700 mb-1">Mobile Number</p>
                            <p class="w-full border border-slate-200 bg-slate-50 rounded-lg px-3 py-2 text-slate-800">{{ $student->mobile_number }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-slate-700 mb-1">Date of Birth</p>
                            <p class="w-full border border-slate-200 bg-slate-50 rounded-lg px-3 py-2 text-slate-800">
                                {{ \Carbon\Carbon::parse($student->date_of_birth)->format('Y-m-d') }}
                            </p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-slate-700 mb-1">Gender</p>
                            <p class="w-full border border-slate-200 bg-slate-50 rounded-lg px-3 py-2 text-slate-800">{{ $student->gender }}</p>
                        </div>
                    </div>
                </div>

                <!-- Section: Academic Information -->
                <div>
                    <div class="flex items-center gap-2 mb-3">
                        <span class="flex items-center justify-center w-6 h-6 rounded-full bg-violet-500 text-white text-xs font-bold">2</span>
                        <h2 class="text-sm font-semibold text-violet-800 uppercase tracking-wide">Academic Information</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3.5">
                        <div>
                            <p class="text-sm font-medium text-slate-700 mb-1">Program</p>
                            <p class="w-full border border-slate-200 bg-slate-50 rounded-lg px-3 py-2 text-slate-800">{{ $student->program }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-slate-700 mb-1">Year Level</p>
                            <p class="w-full border border-slate-200 bg-slate-50 rounded-lg px-3 py-2 text-slate-800">{{ $student->year_level }}</p>
                        </div>
                    </div>
                </div>

                <!-- Section: Address -->
                <div>
                    <div class="flex items-center gap-2 mb-3">
                        <span class="flex items-center justify-center w-6 h-6 rounded-full bg-violet-500 text-white text-xs font-bold">3</span>
                        <h2 class="text-sm font-semibold text-violet-800 uppercase tracking-wide">Address</h2>
                    </div>
                    <p class="w-full border border-slate-200 bg-slate-50 rounded-lg px-3 py-2 text-slate-800">{{ $student->address }}</p>
                </div>

                <!-- Actions -->
                <div class="pt-3 border-t border-slate-100 flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('students.create') }}"
                       class="flex-1 bg-violet-500 hover:bg-violet-600 text-white font-semibold px-6 py-2.5 rounded-lg shadow-lg shadow-violet-400/30 transition transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>
                        Register Another Student
                    </a>
                    <a href="{{ route('students.index') }}"
                       class="flex-1 bg-white border border-violet-300 hover:bg-violet-50 text-violet-700 font-semibold px-6 py-2.5 rounded-lg transition flex items-center justify-center gap-2">
                        View All Students
                    </a>
                </div>

            </div>
        </div>

        <p class="text-center text-violet-400 text-xs mt-4">Student information as registered in the system.</p>
    </div>
</body>
</html>