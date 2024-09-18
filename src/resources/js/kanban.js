const draggable = document.querySelectorAll(".task");
const droppable = document.querySelectorAll(".cartao");

let changed = false;

draggable.forEach((task) => {
    task.addEventListener("dragstart", () => {
        task.classList.add("dragging-gray");
        task.classList.add("is-dragging");
        changed = true;
    });

    task.addEventListener("dragend", () => {
        task.classList.remove("dragging-gray");
        task.classList.remove("is-dragging");
        itera_filhos();
    });
});

droppable.forEach((zone) => {
    zone.addEventListener("dragover", (e) => {
        e.preventDefault();

        const bottomTask = insertAboveTask(zone, e.clientY);
        const curTask = document.querySelector(".is-dragging");

        if (!bottomTask) {
            zone.appendChild(curTask);
        } else {
            zone.insertBefore(curTask, bottomTask);
        }
    });
});

const insertAboveTask = (zone, mouseY) => {
    const els = zone.querySelectorAll(".task:not(.is-dragging)");

    let closestTask = null;
    let closestOffset = Number.NEGATIVE_INFINITY;

    els.forEach((task) => {
        const { top } = task.getBoundingClientRect();

        const offset = mouseY - top;

        if (offset < 0 && offset > closestOffset) {
            closestOffset = offset;
            closestTask = task;
        }
    });

    return closestTask;
};

const itera_filhos = () => {
    const todo = document.getElementById("to-do").querySelectorAll(".task");
    const doing = document.getElementById("doing").querySelectorAll(".task");
    const finished = document
        .getElementById("finished")
        .querySelectorAll(".task");

    altera_campo("tarefas_a_fazer", todo);
    altera_campo("tarefas_fazendo", doing);
    altera_campo("tarefas_concluida", finished);
    salva_tarefas();
};

const altera_campo = (campo_id, painel) => {
    const campo = document.getElementById(campo_id);
    let ids = [];

    painel.forEach((task) => {
        ids.push(task.getAttribute("value"));
    });

    campo.setAttribute("value", ids);
};

const salva_tarefas = () => {
    if (changed) {
        $("#ajax-form").submit(function (e) {
            e.preventDefault();

            var url = $(this).attr("action");

            let formData = new FormData(this);

            $.ajax({
                type: "POST",
                url: url,
                data: formData,
                contentType: false,
                processData: false,
                success: (response) => {
                    console.log(response);
                },
                error: function (response) {
                    $("#ajax-form")
                        .find(".print-error-msg")
                        .find("ul")
                        .html("");
                    $("#ajax-form")
                        .find(".print-error-msg")
                        .css("display", "block");
                    $.each(response.responseJSON.errors, function (key, value) {
                        $("#ajax-form")
                            .find(".print-error-msg")
                            .find("ul")
                            .append("<li>" + value + "</li>");
                    });
                },
            });
        });
        $("#ajax-form").submit();
    }
};

$(document).ready(function () {
    $("#funcionarios-form").on("show.bs.modal", function (event) {
        var button = $(event.relatedTarget); // Botão que acionou o modal
        var url = button.data("url");
        var tarefa = button.data("tarefa");
        $("#tarefa_id").prop("value", tarefa);

        $.ajax({
            url: url,
            type: "GET",
            success: function (data) {
                const func = Array.from(data["funcionarios_tarefa"]);
                data["funcionarios_id"].forEach((id) => {
                    if (func.includes(id)) {
                        $("#" + id).prop("checked", true);
                    } else {
                        $("#" + id).prop("checked", false);
                    }
                });
            },
            error: function () {
                console.log("erro");
            },
        });
    });
});

$(document).ready(function () {
    $("#funcionarios-form").on("hide.bs.modal", function (event) {
        let opcoes = document.querySelectorAll(".opcao");

        opcoes.forEach((element) => {
            element.checked = false;
        });
    });
});

itera_filhos();
