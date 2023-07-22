@extends('layouts.master')
@section('content')
<div class="container">
<h3>Upload Your Files And Share:</h3>
 <form class="row g-3 pt-2" action="{{route('uploadFile')}}" enctype='multipart/form-data' id="uploadForm" method='post'>
        @csrf

        <div class="form-check">
        <input class="form-check-input" type="radio" name="shareType" id="email" value="1" checked>
        <label class="form-check-label" for="email">
            Send uploaded files via email
        </label>
        </div>
        <div class="form-check">
        <input class="form-check-input" type="radio" name="shareType" id="link" value="2" >
        <label class="form-check-label" for="link">
        Share unique link to uploaded files
        </label>
        </div>
        <div class="col-12" id="senderEmailDiv">
            <label for="senderEmail" class="form-label">Sender's Email:</label>
            <input type="text" class="form-control" id="senderEmail" name="senderEmail">
        </div>
        <div class="col-12" id="receiverEmailDiv">
            <label for="receiverEmail" class="form-label">Reciver's Email:</label>
            <input type="text" class="form-control" id="receiverEmail" name="receiverEmail">
        </div>

        <div class="col-md-6">
        <label for="files" class="form-label">File:</label>
        <input type="file" class="form-control" id="files" name="files[]" multiple>
        </div>
        <div class="col-12">
                <button type="submit" class="btn btn-primary" onclick="copyDownloadUrl()">Submit</button>
        </div>
  </form>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const emailRadio = document.getElementById('email');
        const linkRadio = document.getElementById('link');
        const senderEmailInput = document.getElementById('senderEmailDiv');
        const receiverEmailInput = document.getElementById('receiverEmailDiv');

        emailRadio.addEventListener('change', function () {
            if (emailRadio.checked) {
                senderEmailInput.removeAttribute('hidden');
                receiverEmailInput.removeAttribute('hidden');
            }
        });

        linkRadio.addEventListener('change', function () {
            if (linkRadio.checked) {
                senderEmailInput.setAttribute('hidden', 'true');
                receiverEmailInput.setAttribute('hidden', 'true');
            }
        });
    });

    
</script>

@endpush