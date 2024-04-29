<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile Form</title>
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
            <form id="profileForm" action="{{ route('profile.store') }}" class="mt-2">
                @csrf
                <div class="mb-3">
                    <label for="lastName" class="form-label">last name</label>
                    <input type="text" class="form-control" name="last_name" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Image</label>
                    <input class="form-control" name="image" type="file" id="formFile">
                </div>
                <div class="mb-3">
                    <label for="age" class="form-label">age</label>
                    <input type="text" class="form-control" name="age" aria-describedby="emailHelp">
                </div>
                <button id="send" class="btn btn-primary" type="submit">Send</button>
                <button class="btn btn-primary hidden" id="loading" type="button" disabled>
                    <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                    <span role="status">Saving ...</span>
                </button>
            </form>
            <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="0" aria-valuemin="0"
                aria-valuemax="100">
                <div class="progress-bar" style="width: 0%"></div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/profile.js') }}" charset="utf-8"></script>
</body>
</html>
