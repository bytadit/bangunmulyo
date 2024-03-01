function barChart(csrf, data, ctx) {
    $.ajax(`analytics/${data.type}`, {
        type: "POST",
        headers: {
            "X-CSRF-TOKEN": csrf,
        },
        data: {
            start: data.start,
            end: data.end,
        },
        success: function (res) {
            $(".loading-state").addClass("d-none");

            new Chart(ctx, {
                type: "bar",
                data: {
                    labels: res?.data?.label,
                    datasets: res?.data?.data?.map((item) => {
                        return {
                            label: item.name,
                            data: item.data,
                            borderWidth: 1,
                        };
                    }),
                },
                options: {
                    plugins: {
                        title: {
                            display: true,
                            text: `Category Analytics ${data.type} from ${data.start} to ${data.end}`,
                            font: {
                                size: 20,
                                weight: "bold",
                            },
                            padding: {
                                top: 10,
                                bottom: 30,
                            },
                        },
                    },
                    scales: {
                        x: {
                            ticks: {
                                maxRotation: 90,
                                minRotation: 90,
                            },
                            stacked: true,
                        },
                        y: {
                            beginAtZero: true,
                            stacked: true,
                        },
                    },
                },
            });
        },
    });
}
