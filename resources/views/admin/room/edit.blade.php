<x-app-layout>
    @section('content')
        <div class="card card-primary m-3">
            <div class="card-header">
                <h3 class="card-title">Add room</h3>
            </div>


            <form method="post">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="RoomNO">Room No.</label>
                                <input type="text" class="form-control" id="roomNo" placeholder="Room No."
                                    value="{{ $room->number }}" name="room_no">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Room type</label>
                                <select class="custom-select">
                                    <option>Select Room type</option>
                                    @foreach ($types as $key => $type)
                                        <option value="{{ $key }}" {{ $room->type == $key ? 'selected' : '' }}>
                                            {{ $type }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="short_description">Short description</label>
                        <textarea class="form-control" rows="3" name=short_description id=short_description placeholder="Enter ...">{{ $room->short_description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="description">description</label>
                        <textarea class="form-control" rows="3" name=description id=description placeholder="Enter ...">{{ $room->description }}</textarea>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="beds">No.of Beds</label>
                                <input type="number" class="form-control" id="beds" name="beds"
                                    value="{{ $room->beds }}">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="occupancy">Max occupancy</label>
                                <input type="number" class="form-control" id="occupancy" name="occupancy"
                                    value="{{ $room->occupancy }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" class="form-control" id="price" name="price"
                                    value="{{ $room->pricer_per_hour }}">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="status"> Status</label>
                                <select name="status" id="status" class="custom-select">
                                    <option>Select Room type</option>
                                    @foreach ($statuses as $key => $status)
                                        <option value="{{ $key }}" {{ $room->status == $key ? 'selected' : '' }}>
                                            {{ $status }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Images</label>
                                <div id="roomImageDrop" class="dropzone {{ $room->image ? 'd-none' : '' }} "></div>
                                <x-drop-img-preview class="{{ $room->image ? 'd-block' : 'd-none' }} w-50"
                                    src="{{ asset('storage/' . $room->image) }}" id="roomImage">
                                </x-drop-img-preview>
                                <input type="hidden" name="image" id="image" value="{{ $room->image }}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    @endsection
    @push('css')
        <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tinymce@6.4.2/skins/ui/oxide/content.min.css">
    @endpush
    @push('scripts')
        <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/tinymce@6.4.2/tinymce.min.js"></script>
        <script>
            Dropzone.autoDiscover = false;

            let myDropzone = new Dropzone("#roomImageDrop", {
                url: '{{ route('room.image.upload') }}',
                maxFilesize: 3,
                acceptedFiles: 'image/*',
                paramName: 'image',
                init: function() {
                    this.on('sending', function(file, xhr, formData) {
                        formData.append('_token', '{{ csrf_token() }}');
                    });
                    this.on('success', function(file, response) {
                        console.log(response);
                        if (response.status) {
                            $('#image').val(response.image);
                            notyf.success('Image uploaded successfully')
                        } else {
                            notyf.error('Image upload failed')
                        }

                    });
                }
            });

            $('#roomImage .remove-btn').on('click', function() {
                $('#image').val('');
                $('#roomImage').addClass('d-none').removeClass('d-block');
                $('#roomImageDrop').removeClass('d-none');
            });
            
            
            tinymce.init({
                selector: '#description'
            });
        </script>
    @endpush
</x-app-layout>
