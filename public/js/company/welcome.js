const checklistElement = document.getElementById("next-steps-checklist");
const windowWidth = window.innerWidth;
const offset = 20;

document.addEventListener("DOMContentLoaded", function () {
    const checklistTrigger = document.querySelector(
        '[data-role="next-steps-checklist-trigger"]'
    );

    if (checklistTrigger) {
        checklistTrigger.addEventListener("click", function (e) {
            e.stopPropagation();
            showChecklistElement(checklistElement);
        });
    }

    document.querySelector("body").addEventListener("click", function (event) {
        if (checklistElement && !checklistElement.contains(event.target)) {
            hideChecklistElement(checklistElement);
        }
    });
});

document.addEventListener("mousemove", function (event) {
    const isOnRightLimit = event.clientX >= windowWidth - offset;

    if (isOnRightLimit && checklistElement) {
        showChecklistElement(checklistElement);
    }
});

function showChecklistElement(checklistElement) {
    checklistElement.classList.replace("-right-full", "right-0");
}

function hideChecklistElement(checklistElement) {
    checklistElement.classList.replace("right-0", "-right-full");
}
