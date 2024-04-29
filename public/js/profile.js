const form = document.getElementById("profileForm");
const send = document.getElementById('send');
const loading = document.getElementById('loading');
const progress = document.querySelector('.progress-bar');

form.addEventListener("submit", function (e) {
    e.preventDefault();

    let formData = new FormData(form);

    const xhr = new XMLHttpRequest();

    xhr.open("POST", form.action);

    xhr.addEventListener('loadstart', function() {
        send.classList.add('hidden');
        loading.classList.remove('hidden');

    })

    xhr.addEventListener('loadend', function() {
        send.classList.remove('hidden');
        loading.classList.add('hidden');

        progress.parentNode.style.display="none"
    })

    xhr.upload.addEventListener('progress', function(e) {
        if (e.lengthComputable) {
            let percent = (e.loaded / e.total * 100).toFixed(1);
            progress.style.width = percent + '%';
        }
    });

    xhr.addEventListener("load", function () {
        if ((xhr.status >= 200 && xhr.status < 300) || xhr.status === 304) {
            console.log(xhr.responseText);
        } else {
            console.log(xhr.status);
        }
    });

    xhr.send(formData);
});
