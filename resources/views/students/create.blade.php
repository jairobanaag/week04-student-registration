<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen py-6 px-4 bg-violet-100">
    <div class="max-w-3xl mx-auto">

      <!-- Header -->
      <div class="text-center mb-4">
        <h1 class="text-2xl font-bold text-violet-900 tracking-tight">Student Registration</h1>
        <p class="text-violet-500 mt-1 text-sm">Fill out the form below to register a new student</p>
      </div>

        <!-- Card -->
        <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-violet-200">

            <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data" class="p-5 sm:p-6 space-y-5">
                @csrf

                <!-- Section: Personal Information -->
                <div>
                    <div class="flex items-center gap-2 mb-3">
                        <span class="flex items-center justify-center w-6 h-6 rounded-full bg-violet-500 text-white text-xs font-bold">1</span>
                        <h2 class="text-sm font-semibold text-violet-800 uppercase tracking-wide">Personal Information</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3.5">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Student ID</label>
                            <input type="text" name="student_id" value="{{ old('student_id') }}" placeholder="Enter Student ID"
                                class="w-full border rounded-lg px-3 py-2 text-slate-800 focus:outline-none focus:ring-2 transition
                                @error('student_id') border-red-400 bg-red-50 focus:ring-red-400 focus:border-red-400 @else border-slate-300 focus:ring-violet-500 focus:border-violet-500 @enderror">
                            @error('student_id')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Email Address</label>
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="Enter Email Address"
                                class="w-full border rounded-lg px-3 py-2 text-slate-800 focus:outline-none focus:ring-2 transition
                                @error('email') border-red-400 bg-red-50 focus:ring-red-400 focus:border-red-400 @else border-slate-300 focus:ring-violet-500 focus:border-violet-500 @enderror">
                            @error('email')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">First Name</label>
                            <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="Enter First Name"
                                class="w-full border rounded-lg px-3 py-2 text-slate-800 focus:outline-none focus:ring-2 transition
                                @error('first_name') border-red-400 bg-red-50 focus:ring-red-400 focus:border-red-400 @else border-slate-300 focus:ring-violet-500 focus:border-violet-500 @enderror">
                            @error('first_name')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Middle Name</label>
                            <input type="text" name="middle_name" value="{{ old('middle_name') }}" placeholder="Enter Middle Name"
                                class="w-full border border-slate-300 rounded-lg px-3 py-2 text-slate-800 focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-violet-500 transition">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Last Name</label>
                            <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="Enter Last Name"
                                class="w-full border rounded-lg px-3 py-2 text-slate-800 focus:outline-none focus:ring-2 transition
                                @error('last_name') border-red-400 bg-red-50 focus:ring-red-400 focus:border-red-400 @else border-slate-300 focus:ring-violet-500 focus:border-violet-500 @enderror">
                            @error('last_name')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block tegit add .xt-sm font-medium text-slate-700 mb-1">Mobile Number</label>
                            <input type="text" name="mobile_number" value="{{ old('mobile_number') }}" placeholder="Enter Mobile Number"
                                class="w-full border rounded-lg px-3 py-2 text-slate-800 focus:outline-none focus:ring-2 transition
                                @error('mobile_number') border-red-400 bg-red-50 focus:ring-red-400 focus:border-red-400 @else border-slate-300 focus:ring-violet-500 focus:border-violet-500 @enderror">
                            @error('mobile_number')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Date of Birth</label>
                            <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}"
                                class="w-full border rounded-lg px-3 py-2 text-slate-800 focus:outline-none focus:ring-2 transition
                                @error('date_of_birth') border-red-400 bg-red-50 focus:ring-red-400 focus:border-red-400 @else border-slate-300 focus:ring-violet-500 focus:border-violet-500 @enderror">
                            @error('date_of_birth')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Gender</label>
                            <select name="gender"
                                class="w-full border rounded-lg px-3 py-2 text-slate-800 focus:outline-none focus:ring-2 transition bg-white
                                @error('gender') border-red-400 bg-red-50 focus:ring-red-400 focus:border-red-400 @else border-slate-300 focus:ring-violet-500 focus:border-violet-500 @enderror">
                                <option value="">-- Select --</option>
                                <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                            </select>
                            @error('gender')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
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
                            <label class="block text-sm font-medium text-slate-700 mb-1">Program</label>
                            <input type="text" name="program" value="{{ old('program') }}" placeholder="Enter Program"
                                class="w-full border rounded-lg px-3 py-2 text-slate-800 focus:outline-none focus:ring-2 transition
                                @error('program') border-red-400 bg-red-50 focus:ring-red-400 focus:border-red-400 @else border-slate-300 focus:ring-violet-500 focus:border-violet-500 @enderror">
                            @error('program')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Year Level</label>
                            <input type="text" name="year_level" value="{{ old('year_level') }}" placeholder="Enter Year Level"
                                class="w-full border rounded-lg px-3 py-2 text-slate-800 focus:outline-none focus:ring-2 transition
                                @error('year_level') border-red-400 bg-red-50 focus:ring-red-400 focus:border-red-400 @else border-slate-300 focus:ring-violet-500 focus:border-violet-500 @enderror">
                            @error('year_level')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Section: Address & Photo -->
                <div>
                    <div class="flex items-center gap-2 mb-3">
                        <span class="flex items-center justify-center w-6 h-6 rounded-full bg-violet-500 text-white text-xs font-bold">3</span>
                        <h2 class="text-sm font-semibold text-violet-800 uppercase tracking-wide">Address & Photo</h2>
                    </div>

                    <div class="mb-3.5">
                        <label class="block text-sm font-medium text-slate-700 mb-1">Address</label>
                        <textarea name="address" rows="2" placeholder="Enter Address"
                            class="w-full border rounded-lg px-3 py-2 text-slate-800 focus:outline-none focus:ring-2 transition
                            @error('address') border-red-400 bg-red-50 focus:ring-red-400 focus:border-red-400 @else border-slate-300 focus:ring-violet-500 focus:border-violet-500 @enderror">{{ old('address') }}</textarea>
                        @error('address')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Profile Picture</label>
                        <div class="flex items-center gap-3">
                            <div id="preview-wrap" class="w-14 h-14 rounded-full bg-violet-50 border-2 border-dashed border-violet-300 flex items-center justify-center overflow-hidden flex-shrink-0">
                                <svg id="preview-icon" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-violet-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                </svg>
                                <img id="preview-img" src="" class="hidden w-full h-full object-cover" />
                            </div>
                            <label class="flex-1 cursor-pointer">
                                <div class="border-2 border-dashed rounded-lg px-3 py-2 text-center transition
                                    @error('profile_picture') border-red-400 bg-red-50 @else border-violet-300 hover:border-violet-500 hover:bg-violet-50 @enderror">
                                    <span class="text-sm @error('profile_picture') text-red-500 @else text-violet-600 @enderror">Click to upload (JPG, PNG · max 2MB)</span>
                                </div>
                                <input type="file" name="profile_picture" accept="image/*" class="hidden" onchange="previewImage(event)">
                            </label>
                        </div>
                        @error('profile_picture')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Submit -->
                <div class="pt-3 border-t border-slate-100">
                    <button type="submit"
                        class="w-full bg-violet-500 hover:bg-violet-600 text-white font-semibold px-6 py-2.5 rounded-lg shadow-lg shadow-violet-400/30 transition transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                        Register Student
                    </button>
                </div>
            </form>
        </div>

        <p class="text-center text-violet-400 text-xs mt-4">All fields marked required must be filled out before submitting.</p>
    </div>

    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('preview-icon').classList.add('hidden');
                const img = document.getElementById('preview-img');
                img.src = e.target.result;
                img.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    </script>
</body>
</html>