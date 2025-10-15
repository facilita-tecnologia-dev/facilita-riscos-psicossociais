document.addEventListener("DOMContentLoaded", function () {
    renderMetrics();
    renderDemographics();
});

function renderMetrics() {
    let data = [];
    let labels = [];

    Object.values(proartIndicators).forEach((department) => {
        data.push(department);
    });

    Object.keys(proartIndicators).forEach((department) => {
        labels.push(department);
    });

    const chartId = "company_indicators_chart";

    const wrapper = document.getElementById("company-indicators");
    const colors = [chartDefaultColors.PRIMARY];
    if (data.length > 0) {
        createBarChart(
            wrapper,
            chartId,
            labels,
            data,
            null,
            colors,
            "vertical",
            true
        );
    }
}

function renderDemographics() {
    const keys = Object.keys(demographics);

    Object.values(demographics).forEach((demographic, index) => {
        const data = Object.values(demographic).map(
            ($item) => $item["percentage"]
        );
        const tooltips = Object.values(demographic).map(
            ($item) => $item["count"]
        );

        const chartId = `demographic_chart_${index}`;
        const wrapper = document.getElementById(keys[index]);
        const labels = Object.keys(demographic);
        const colors = generateHSLAColors(data.length);

        createBarChart(wrapper, chartId, labels, data, tooltips, colors);
    });
}

function generateHSLAColors(
    count,
    saturation = 60,
    lightness = 85,
    alpha = 0.8
) {
    return Array.from({ length: count }, (_, i) => {
        const hue = Math.round((360 * i) / count);
        return `hsla(${hue},${saturation}%,${lightness}%,${alpha})`;
    });
}
