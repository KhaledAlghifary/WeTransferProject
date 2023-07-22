@extends('layouts.master')
@section('content')
<div class="container h-100">
    <div class="row h-100 justify-content-center align-items-center">

        <div class="col-6">
            <p style="color:red;">You can either download the files as folder in .zip, or Preview and specify the files.</p>
            <div class="d-flex flex-row">
             <div class="form-check ">
            <input class="form-check-input" type="radio" name="downloadType" id="preview" value="1" checked>
            <label class="form-check-label" for="preview">
                Preview Files
            </label>
            </div>
            <div class="form-check">
            <input class="form-check-input" type="radio" name="downloadType" id="download" value="2" >
            <label class="form-check-label" for="download">
             Download as A zip folder
            </label>
            </div>
            </div>

             <form id="previewForm" action="{{route('preview')}}">
                <div class="mb-3">
                    <label for="link" class="form-label">Your Link:</label>
                    <input type="text" class="form-control" id="link" name="link">
                </div>
                <button type="submit" class="btn btn-primary">Preview</button>
            </form>

            <form id="downloadForm" action="{{route('download')}}" hidden>
                <div class="mb-3">
                    <label for="link" class="form-label">Your Link:</label>
                    <input type="text" class="form-control" id="link" name="link">
                </div>
                <button type="submit" class="btn btn-primary">Download</button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const previewRadio = document.getElementById('preview');
        const downloadRadio = document.getElementById('download');
        const previewForm = document.getElementById('previewForm');
        const downloadForm = document.getElementById('downloadForm');

        previewRadio.addEventListener('change', function () {
            if (previewRadio.checked) {
                downloadForm.setAttribute('hidden', 'true');
                previewForm.removeAttribute('hidden');
            }
        });

        downloadRadio.addEventListener('change', function () {
            if (downloadRadio.checked) {
                previewForm.setAttribute('hidden', 'true');
                downloadForm.removeAttribute('hidden');
            }
        });
    });

    
</script>

@endpush