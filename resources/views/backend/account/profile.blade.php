<x-backend.layouts.full>
    @php
        $name = old('name') ?? $record['name'];
        $email = old('email') ?? $record['email'];
        $mobile = old('mobile') ?? $record['mobile'];
        $dob = old('dob') ? dateFormat(3, old('dob')) : dateFormat(3, $record['dob']);
        $gender = old('gender') ?? $record['gender'];
        $image = $record['image'];
    @endphp

    <x-backend::ui.breadcrumb 
        title="Profile"
        :crumbs="[
            ['title' => 'Profile']
        ]"
    />
    <x-backend::ui.alerts />
    <div class="card">
        <div class="card-body">
            {{ html()->form('put', baseURL('profile'))->id('uploadForm')->acceptsFiles()->open() }}
                <div class="row g-3">
                    <div class="col-md-12">
                        <label for="name" class="form-label">Name</label>
                        <x-backend::form.input name="name" placeholder="Enter Name" value="{{ $name }}"/>
                        <x-backend::form.error name="name" :errors="$errors"/>
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <x-backend::form.input name="email" placeholder="Enter Email" value="{{ $email }}"/>
                        <x-backend::form.error name="email" :errors="$errors"/>
                    </div>
                    <div class="col-md-6">
                        <label for="password" class="form-label">Password</label>
                        <x-backend::form.input type="password" name="password" placeholder="Enter Password"/>
                        <x-backend::form.error name="password" :errors="$errors"/>
                    </div>
                    <div class="col-md-6">
                        <label for="mobile" class="form-label">Mobile Number</label>
                        <x-backend::form.input name="mobile" placeholder="Enter Mobile Number" value="{{ $mobile }}"/>
                        <x-backend::form.error name="mobile" :errors="$errors"/>
                    </div>
                    <div class="col-md-6">
                        <label for="dob" class="form-label">Date of Birth</label>
                        <x-backend::form.datepicker name="dob" placeholder="Enter Date of Birth" value="{{ $dob }}"/>
                    </div>
                    <div class="col-md-6">
                        <label for="gender" class="form-label">Gender</label>
                        <x-backend::form.select 
                            name="gender" 
                            value="{{ $gender }}"
                            :options="lists('gender')"
                        />
                        <x-backend::form.error name="gender" :errors="$errors"/>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Image</label>
                        <x-backend::form.file name="image" class="image" file="{{ $image }}" path="{{ url('storage/profile') }}"/>
                        <p class="tagline">(Image Size - 490 x 490)</p>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            {{ html()->form()->close() }}
        </div>
    </div>
</x-backend.layouts.full>