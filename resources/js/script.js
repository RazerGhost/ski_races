document.getElementById("toggleFilters").addEventListener("click", function() {
    var filterContainer = document.getElementById("filterContainer");
    if (filterContainer.classList.contains("hidden")) {
        filterContainer.classList.remove("hidden");
    } else {
        filterContainer.classList.add("hidden");
    }
});

document.getElementById("alert").addEventListener("click", function() {
    var alert = document.getElementById("alert");
    alert.classList.add("hidden");
});