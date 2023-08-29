<div>

    {{-- <div class="col">
ssssssssssssssssssssssssss
        <input wire:model="name" type="text"
            class="form-control form-control-lg   {{ $errors->first('name') ? ' form-error' : '' }} "
            placeholder="Telphone Number"
            onkeypress="return isNumber(event)" aria-label="name"
            maxlength="10" id="validationCustom01">
        @error('name')
            <span class="text-danger float-start">{{ $message }}</span>
        @enderror
    </div> --}}

    {{-- The Master doesn't talk, he acts. --}}
    <style>
        .form-error {
            border-color: #FF0000;
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(255, 0, 0, 0.6);
        }

        .form-control:focus {
            box-shadow: none;
            border: 1px solid #ced4da;
            ;
        }
    </style>

    <div class="container py-4">
        <div class="d-flex justify-content-between">

            <button wire:click='showForm' class="btn btn-success">Create New</button>

            <a href="/image" class="btn btn-success">Back</a>
        </div>


        @if ($showData == true) <br>
            <div class="table-responsive">
                @if (session()->has('success'))
                    <div class="alert alert-success">
                        <strong>{{ session('success') }}</strong>
                    </div>
                @endif
                @if (session()->has('error'))
                    <div class="alert alert-danger">
                        <strong>{{ session('error') }}</strong>
                    </div>
                @endif
                {{ $images->count() }}
                @if (count($images) > 0)
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Title</th>
                                <th>Image</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($images as $image)
                                <tr>
                                    <td>{{ $image->id }}</td>
                                    <td>{{ $image->name }}</td>
                                    <td><img src="{{ asset('storage') }}/{{ $image->image }}"
                                            style="width: 70px;height:70px;" alt="">
                                    </td>
                                    <td><button wire:click='edit({{ $image->id }})'
                                            class="btn btn-success">Edit</button>
                                    </td>
                                    <td><button wire:click='delete({{ $image->id }})'
                                            class="btn btn-danger">Delete</button></td>
                                </tr>
                            @empty
                                {{-- <h3>Record Not Found</h3> --}}
                            @endforelse

                        </tbody>
                    </table>
                @else
                    <h3>Record Not Found</h3>
                @endif

            </div>
        @endif





        @if ($createData == true)
            <div class="row mt-3">

                @if (session()->has('success'))
                    <div class="alert alert-success">
                        <strong>{{ session('success') }}</strong>
                    </div>
                @endif
                @if (session()->has('error'))
                    <div class="alert alert-danger">
                        <strong>{{ session('error') }}</strong>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header ">
                        <h1 class="text-center">Upload Image</h1>
                    </div>
                    <form action="" wire:submit.prevent='create'>
                        <div class="card-body">
                            <div class="from-group">
                                <label for="">Enter name</label>
                                <input type="text" wire:model='name' name="title" id="title"
                                    class="form-contro-lg form-control {{ $errors->first('name') ? ' form-error' : '' }}  ">
                                @error('name')
                                    <span class="text-danger float-start">{{ $message }}</span>
                                @enderror
                            </div><br>
                            <div class="from-group">
                                <label for="">Enter email</label>
                                <input type="text" wire:model='email' name="email" id="title"
                                    class="form-contro-lg form-control {{ $errors->first('email') ? ' form-error' : '' }} ">
                                @error('email')
                                    <span class="text-danger float-start">{{ $message }}</span>
                                @enderror
                            </div><br>
                            <div class="from-group">
                                <label for="">Enter message</label>
                                <input type="text" wire:model='message' name="message" id="title"
                                    class="form-contro-lg form-control {{ $errors->first('message') ? ' form-error' : '' }} ">
                                @error('message')
                                    <span class="text-danger float-start">{{ $message }}</span>
                                @enderror
                            </div><br>
                            <div class="custom-file mt-3">
                                <input type="file" wire:model='image'
                                    class="custom-file-input {{ $errors->first('image') ? ' form-error' : '' }} "
                                    id="customFile">
                                <label class="custom-file-label" for="customFile">Choose file</label>

                            </div><br>
                            @if ($image)
                                <img src="{{ $image->temporaryUrl() }}" style="width: 200px;height:200px;"
                                    alt="">
                            @endif
                        </div>
                        <div class="card ">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                        <br>
                    </form>
                </div>

            </div>
        @endif





        @if ($updateData == true)
            <div class="row mt-3">

                @if (session()->has('success'))
                    <div class="alert alert-success">
                        <strong>{{ session('success') }}</strong>
                    </div>
                @endif
                @if (session()->has('error'))
                    <div class="alert alert-danger">
                        <strong>{{ session('error') }}</strong>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h1>Update Image</h1>
                    </div>
                    <form action="" wire:submit.prevent='update({{ $edit_id }})'>
                        <div class="card-body">
                            <div class="from-group">
                                <label for="">Enter name</label>
                                <input type="text" wire:model='edit_name' name="name" id="title"
                                    class="form-contro-lg form-control">
                            </div>
                            <div class="from-group">
                                <label for="">Enter email</label>
                                <input type="text" wire:model='edit_email' name="email" id="title"
                                    class="form-contro-lg form-control">
                            </div>
                            <div class="from-group">
                                <label for="">Enter message</label>
                                <input type="text" wire:model='edit_message' name="message" id="title"
                                    class="form-contro-lg form-control">
                            </div>
                            <div class="custom-file mt-3">
                                <input type="file" wire:model='new_image' class="custom-file-input" id="customFile">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                            @if ($new_image)
                                <img src="{{ $new_image->temporaryUrl() }}" style="width: 200px;height:200px;"
                                    alt="">
                            @else
                                <img src="{{ asset('storage') }}/{{ $old_image }}"
                                    style="width: 200px;height:200px;" alt="">
                            @endif
                            <input type="hidden" wire:model='old_image' name="" id="">
                        </div>
                        <div class="card ">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                        <br>
                    </form>
                </div>

            </div>
        @endif
    </div>
</div>
{{-- <script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script> --}}
