/*======== 16. ANALYTICS - ACTIVITY CHART ========*/
var activity = document.getElementById("activity");
if (activity !== null) {
    var activityData = [
        {
            first: [0, 105, 92, 155, 138, 205, 120, 92, 155, 138, 205, 320],
        },
        // {
        //     first: [0, 65, 77, 33, 49, 100, 100],
        //     second: [20, 85, 97, 53, 69, 120, 120],
        // },
        // {
        //     first: [0, 40, 77, 55, 33, 116, 50],
        //     second: [30, 70, 107, 85, 73, 146, 80],
        // },
        // {
        //     first: [0, 44, 22, 77, 33, 151, 99],
        //     second: [60, 32, 120, 55, 19, 134, 88],
        // },
    ];

    activity.height = 100;

    var config = {
        type: "line",
        data: {
            labels: [
                "4 Jan",
                "5 Jan",
                "6 Jan",
                "7 Jan",
                "8 Jan",
                "9 Jan",
                "10 Jan",
                "11 Jan",
                "12 Jan",
                "13 Jan",
                "14 Jan",
                "15 Jan",
            ],
            datasets: [
                {
                    label: `$`,
                    backgroundColor: "rgba(111, 78, 242, 0.10)",
                    borderColor: "rgba(111, 78, 242, 1)",
                    data: activityData[0].first,
                    lineTension: 0,
                    pointRadius: 4,
                    borderWidth: 4,
                }
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                display: false,
            },
            scales: {
                xAxes: [
                    {
                        stacked: true,
                        barPercentage: 0.45,
                        gridLines: {
                            display: false,
                            drawBorder: false,
                        },
                        ticks: {
                            display: false,
                            // fontColor: "#8a909d",
                        },
                    },
                ],
                yAxes: [
                    {
                        stacked: true,
                        gridLines: {
                            display: false,
                            color: "#eee",
                        },
                        ticks: {
                            // display: false,
                            stepSize: 50,
                            fontColor: "#6f4ef2",
                            fontFamily: "Poppins",
                        },
                    },
                ],
            },
            tooltips: {
                mode: "index",
                intersect: false,
                titleFontColor: "#888",
                bodyFontColor: "#555",
                titleFontSize: 12,
                bodyFontSize: 15,
                backgroundColor: "rgba(256,256,256,0.95)",
                displayColors: true,
                xPadding: 10,
                yPadding: 7,
                borderColor: "rgba(220, 220, 220, 0.9)",
                borderWidth: 2,
                caretSize: 6,
                caretPadding: 5,
            },
        },
    };

    var ctx = document.getElementById("activity").getContext("2d");
    var myLine = new Chart(ctx, config);

    var items = document.querySelectorAll("#user-activity .btn");
    items.forEach(function (item, index) {
        item.addEventListener("click", function () {
            config.data.datasets[0].data = activityData[index].first;
            config.data.datasets[1].data = activityData[index].second;
            myLine.update();
        });
    });
}