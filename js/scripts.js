/*!
* Start Bootstrap - Shop Homepage v5.0.6 (https://startbootstrap.com/template/shop-homepage)
* Copyright 2013-2023 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-shop-homepage/blob/master/LICENSE)
*/
// This file is intentionally blank
// Use this file to add JavaScript to your project

document.addEventListener("DOMContentLoaded", function () {
    updateNavLinks();
    loadPageFromHash();

    // Listen for hash changes (back/forward navigation)
    window.addEventListener("hashchange", loadPageFromHash);
});

function navigateTo(page) {
    const app = document.getElementById("app");
    fetch(`frontend/pages/${page}.html`)
        .then(response => {
            if (!response.ok) throw new Error("Page not found");
            return response.text();
        })
        .then(html => {
            app.innerHTML = html;
            window.location.hash = page;
        })
        .catch(error => {
            app.innerHTML = "<h2>Page Not Found</h2>";
        });
}

function loadPageFromHash() {
    let page = window.location.hash.substring(1) || "home";
    navigateTo(page);
}

function updateNavLinks() {
    let adminNav = document.getElementById("adminNav");
    let isAdmin = localStorage.getItem("role") === "admin";

    if (isAdmin) {
        adminNav.innerHTML = `
            <li class="nav-item">
                <a class="nav-link text-warning" href="#admin" onclick="navigateTo('admin'); return false;">Admin Dashboard</a>
            </li>
        `;
    } else {
        adminNav.innerHTML = ""; // Remove admin link if not an admin
    }
}
