console.log("oidpasid");

const passwordWarningModal = document.querySelector(
    '[data-role="password-warning-modal"]'
);

document.addEventListener("DOMContentLoaded", function () {
    if (passwordWarningModal) {
        document
            .querySelector("body")
            .addEventListener("click", function (event) {
                if (event.target === passwordWarningModal) {
                    hidePasswordWarningModal();
                }
            });
    }
});

function hidePasswordWarningModal() {
    passwordWarningModal.classList.replace("!flex", "hidden");
}
