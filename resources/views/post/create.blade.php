<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Post Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .hidden {
            display: none;
        }
    </style>
</head>
<body style="background-color: gray;">
    <div class="container">
        <div class="row">
            <form id="postForm" action="{{ route('post.store') }}" class="mt-2">
                @csrf
                <div class="mb-3">
                    <label for="lastName" class="form-label">title</label>
                    <input type="text" class="form-control" name="title" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="lastName" class="form-label">demo</label>
                    <textarea type="text" class="form-control" name="demo"></textarea>
                </div>
                <div class="mb-3">
                    <label for="lastName" class="form-label">status</label>
                    <br /><label for="active">active</label> <input type="radio" id="firstCheckbox" value="active" name="status" checked
                        id="active" />
                    <br /><label for="unactive">un active</label> <input type="radio" value="un_active" name="status"
                        id="unactive" />
                </div>
                <button id="send" class="btn btn-primary" type="submit">Send</button>
                <button class="btn btn-primary hidden" id="loading" type="button" disabled>
                    <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                    <span role="status">Saving ...</span>
                </button><span id="showMessage" class="text-white rounded p-2 hidden"></span>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/post.js') }}" charset="utf-8"></script>
</body>
</html>
