const addQuestionModal = document.querySelector(
    '[data-role="add-question-modal"]'
);

document.addEventListener("DOMContentLoaded", function () {
    if (addQuestionModal) {
        document
            .querySelector("body")
            .addEventListener("click", function (event) {
                if (event.target === addQuestionModal) {
                    hideAddQuestionModal(addQuestionModal);
                }
            });
    }
});

function showAddQuestionModal() {
    addQuestionModal.classList.replace("hidden", "flex");
}

function hideAddQuestionModal() {
    addQuestionModal.classList.replace("flex", "hidden");
}
