@props([
    'name' => '',
    'class' => '',
    'file' => '',
    'path' => ''
])

<div>
    <div class="fileUpload">
        <div class="preview-box preview-box-{{ $class }}">
            <i class="ti ti-photo"></i>
            <p>Upload a file</p>
        </div>

        <div class="upload-box upload-box-{{ $class }}" style="display: none;">
            <img style="width: 120px;height: 120px;">
            <div class="upload-actions">
                <i class="ti ti-pencil edit-{{$class}}"></i>
                <i class="ti ti-trash delete-{{$class}}"></i>
            </div>
        </div>

        <input type="file" name="{{ $name }}" class="file-{{ $class }}" style="display: none;">
        <input type="hidden" name="{{ $name }}_hidden" class="hidden-{{ $class }}" value="{{ $file }}">
    </div>
</div>

@push('scripts')
    @once
        <script>
            var selector = '{{ $class }}';
            var file = '{{ $file != '' && fileExists($path."/".$file) ? $path."/".$file : '' }}';

            $(function() {
                if (file != '') {
                    boxEvent1(1, file)
                }
            })

            $(`.preview-box-${selector}, .edit-${selector}`).click(function() {
                $(`.file-${selector}`).click();
            })

            $(`.file-${selector}`).change(function() {
                previewFile()
            })

            $(`.delete-${selector}`).click(function() {
                boxEvent1(2)
            })

            function previewFile() {
                var fileInput = $(`.file-${selector}`).get(0);
    
                if (fileInput.files && fileInput.files[0]) {
                    var selectedFile = fileInput.files[0];
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        var result = e.target.result;

                        boxEvent1(1, result)    
                    }

                    reader.readAsDataURL(selectedFile);
                }
            }

            function boxEvent1(type, result = '') {
                var previewBox = $(`.preview-box-${selector}`);
                var uploadBox = $(`.upload-box-${selector}`);

                if (type == '1') {
                    previewBox.hide();

                    uploadBox.find("img").attr("src", result);
                    uploadBox.show();
                } else if (type == '2') {
                    previewBox.show();

                    uploadBox.find("img").attr("src", result);
                    uploadBox.hide();

                    $(`.file-${selector}, .hidden-${selector}`).val('')
                }
            }
        </script>
    @endonce
@endpush

@push('styles')
    @once
        <style>
            .fileUpload {
                width: 120px;
                height: 120px;
                cursor: pointer;
            }

            .preview-box {
                width: 100%;
                height: 100%;
                display: flex;
                align-items: center;
                justify-content: center;
                flex-direction: column;
                border: 1px dashed lightgray;
            }

            .preview-box i {
                font-size: 40px;
            }

            .preview-box p {
                margin: 5px 0 0;
                font-size: 13px;
            }

            .upload-box {
                margin: 5px 0 0;
                font-size: 13px;
                position: relative;
            }

            .upload-box:hover .upload-actions{
                display: flex;
            }

            .upload-actions{
                display: none;
                position: absolute;
                right: 5px;
                top: 5px;
                flex-direction: column;
            }

            .upload-actions i{
                padding: 8px;
                border-radius: 5px;
                margin-bottom: 5px;
                box-shadow: 0 0 2px lightgrey;
                background: white;
            }
        </style>
    @endonce
@endpush