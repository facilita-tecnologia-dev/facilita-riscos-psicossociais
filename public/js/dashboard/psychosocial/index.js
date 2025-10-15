document.addEventListener("DOMContentLoaded", function () {
    renderPsychosocialTestsParticipation();
    renderPsychosocialRiskBars();
});

function renderPsychosocialRiskBars() {
    const riskBars = document.querySelectorAll('[data-role="risk-bar"]');

    riskBars.forEach((risk) => {
        const value = risk.dataset.value;
        const bar = risk.querySelector("#bar");
        const division = usesHSE ? 5 : 4;
        const barWidth = (value / division) * 100;

        bar.style.backgroundColor = bar.dataset.color;
        bar.style.width = barWidth.toFixed() + "%";
    });
}

function renderPsychosocialTestsParticipation() {
    let data = [];
    let tooltips = [];
    let labels = [];

    Object.values(participation).forEach((department) => {
        data.push(department["percentage"]);
    });

    Object.values(participation).forEach((department) => {
        tooltips.push(department["count"]);
    });

    Object.keys(participation).forEach((department) => {
        labels.push(department);
    });

    const chartId = "psychosocial_participation_chart";

    const wrapper = document.getElementById("psychosocial-participation");
    const colors = [chartDefaultColors.PRIMARY];

    createBarChart(wrapper, chartId, labels, data, tooltips, colors);
}