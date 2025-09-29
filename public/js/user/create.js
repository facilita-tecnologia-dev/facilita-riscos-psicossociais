document.addEventListener("DOMContentLoaded", function () {
    const checkCPFButton = document.querySelector("#check-cpf");
    const cpfInput = document.querySelector("#cpf");
    const messageDiv = document.querySelector("#cpf-message");

    if (checkCPFButton && cpfInput) {
        checkCPFButton.addEventListener("click", async function () {
            const cpf = cpfInput.value.trim();
            const url = checkCPFButton.dataset.ajaxUrl;

            messageDiv.textContent = "";

            if (!cpf) {
                messageDiv.textContent = "Digite um CPF para pesquisar";
                return;
            }

            try {
                const response = await fetch(url, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    body: JSON.stringify({ cpf }),
                });

                const data = await response.json();

                if (data.user) {
                    messageDiv.textContent = "CPF já está cadastrado.";
                    messageDiv.classList.add("text-danger");
                    messageDiv.classList.remove("text-success");

                    if (data.user.name) {
                        document.querySelector('input[name="name"]').value =
                            data.user.name;
                    }

                    if (data.user.email) {
                        document.querySelector('input[name="email"]').value =
                            data.user.email;
                    }

                    if (data.user.birth_date) {
                        document.querySelector(
                            'input[name="birth_date"]'
                        ).value = data.user.birth_date;
                    }

                    if (data.user.gender) {
                        document.querySelector('input[name="gender"]').value =
                            data.user.gender;
                    }

                    if (data.user.marital_status) {
                        document.querySelector(
                            'input[name="marital_status"]'
                        ).value = data.user.marital_status;
                    }

                    if (data.user.education_level) {
                        document.querySelector(
                            'input[name="education_level"]'
                        ).value = data.user.education_level;
                    }

                    if (data.user.department) {
                        document.querySelector(
                            'input[name="department"]'
                        ).value = data.user.department;
                    }

                    if (data.user.occupation) {
                        document.querySelector(
                            'input[name="occupation"]'
                        ).value = data.user.occupation;
                    }

                    if (data.user.work_shift) {
                        document.querySelector(
                            'input[name="work_shift"]'
                        ).value = data.user.work_shift;
                    }

                    if (data.user.admission) {
                        document.querySelector(
                            'input[name="admission"]'
                        ).value = data.user.admission;
                    }
                } else {
                    messageDiv.textContent = "CPF disponível.";
                    messageDiv.classList.add("text-success");
                    messageDiv.classList.remove("text-danger");
                }
            } catch (error) {
                messageDiv.textContent = "Erro ao verificar CPF.";
            }
        });
    }
});
