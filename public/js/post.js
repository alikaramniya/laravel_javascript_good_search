"use strict";

let tbody = document.querySelector("tbody");
let search = document.getElementById("search");
let loading = document.getElementById("loading");

let [oldSearch, searchTimer] = ["", null];

let token = search.dataset.token;

searchData();

document.addEventListener('keydown', function(e) {
    if (e.ctrlKey && e.code === 'KeyK') {
        e.preventDefault();

        search.focus();
    }
})

search.addEventListener("input", function () {
    if (searchTimer) clearTimeout(searchTimer);

    searchTimer = setTimeout(() => {
        searchData(search.value);
    }, 500);
});

function searchData(searchValue = "") {
    searchValue = searchValue.trim();

    if (oldSearch.trim() != "" && oldSearch.trim() === searchValue.trim()) {
        return;
    }

    // If searchValue and oldSearch is empty and tbody have child conditions is true and gvie me return
    if (!searchValue.trim() && !oldSearch.trim() && tbody.children.length) {
        return;
    }

    const xhr = new XMLHttpRequest();

    let formData = new FormData();

    searchValue = encodeURIComponent(searchValue);

    xhr.open("POST", "http://localhost:8000/post/search");

    xhr.setRequestHeader("X-CSRF-TOKEN", token);

    formData.append("field", searchValue);

    xhr.addEventListener("loadstart", function () {
        loading.innerHTML = `
            <button class="btn btn-primary" type="button" disabled>
              <span class="spinner-grow spinner-grow-sm" aria-hidden="true"></span>
              <span role="status">Loading...</span>
            </button>
        `;
    });

    xhr.addEventListener("load", function () {
        if ((xhr.status >= 200 && xhr.status < 300) || xhr.status === 304) {
            console.log(JSON.parse(xhr.responseText))
            showInList(JSON.parse(xhr.responseText));
        } else {
            console.log(xhr.status);
        }
    });

    xhr.send(formData);

    oldSearch = searchValue;
}

function showInList(posts) {
    tbody.innerHTML = "";

    posts.forEach((post) => {
        tbody.innerHTML += `
            <tr>
                <td>${post.name}</td>
                <td>${post.title}</td>
            </tr>
        `;
    });

    loading.innerHTML = ""; // Hide loading alert
}
