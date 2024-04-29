const tbody = document.querySelector("tbody");
const next = document.getElementById("next");
const previous = document.getElementById("previous");

const search = document.getElementById("search");

let url = location.href;

if (location.search) {
    search.value = (location.search).replace('?', '');
}
 
search.addEventListener("input", function () {
    if (search.value) {
        history.pushState({}, "", url + `?${search.value}`);
    } else {
        history.pushState({}, "", (location.href).replace(location.search, '')); 
    }
});

let nextPageUrl, previousPageUrl;

getPage("http://localhost:8000/post/list");

next.addEventListener("click", function () {
    getPage(nextPageUrl);
});

previous.addEventListener("click", function () {
    getPage(previousPageUrl);
});

function getPage(url) {
    let xhr = new XMLHttpRequest();

    xhr.open("GET", url);

    xhr.addEventListener("load", function () {
        if ((xhr.status >= 200 && xhr.status < 300) || xhr.status == 304) {
            let res = JSON.parse(xhr.responseText);

            buttoPrevOrNext(res.next_page_url, res.prev_page_url);

            tbody.innerHTML = "";

            res.data.forEach((row) => {
                tbody.innerHTML += `
                <tr>
                    <td>${row.user.email}</td>
                    <td>${row.title}</td>
                </tr>
            `;
            });
        } else {
            console.log(xhr.status);
        }
    });

    xhr.send();
}

function buttoPrevOrNext(nextUrl, prevUrl) {
    if (!nextUrl) {
        next.style.display = "none";
    } else {
        next.style.display = "inline-block";

        nextPageUrl = nextUrl;
    }

    if (!prevUrl) {
        previous.style.display = "none";
    } else {
        previous.style.display = "inline-block";

        previousPageUrl = prevUrl;
    }
}
