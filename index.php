<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retrieve Data from Database</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <!-- <link rel="stylesheet" href="./style.css"> -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 1rem;
            text-align: center;
        }

        header h1 {
            margin: 0;
        }

        header nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        header nav ul li {
            display: inline-block;
            margin: 0 1rem;
        }

        header nav ul li a {
            color: #fff;
            text-decoration: none;
        }

        section {
            padding: 1rem;
        }

        footer {
            background-color: #333;
            color: #fff;
            padding: 1rem;
            text-align: center;
        }

        footer p {
            margin: 0;
        }
    </style>

</head>

<body>
    <header>
        <h1>weather Data</h1>
        <nav>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#weatherChart2">Chart2</a></li>
                <li><a href="#weatherChart3">Chart3</a></li>
                <li><a href="#weatherChart4">Chart4</a></li>
            </ul>
        </nav>
    </header>

    <section>
        <?php
        //include database configuration file
        include 'db.php';
        ?>
        <div>
            <h2 style="padding-left: 8%">Humidity and Temperature line graph with looping animation and fill</h2>
            <canvas id="weatherChart" width="800" height="600"></canvas>
            <h2 style="padding-left: 8%">Humidity and Temperature bar graph</h2>
            <canvas id="weatherChart2" width="800" height="600"></canvas>
            <h2 style="padding-left: 8%">Humidity and Temperature radar graph</h2>
            <canvas id="weatherChart3" width="800" height="600"></canvas>
            <h2 style="padding-left: 8%">Humidity and Temperature polar area graph</h2>
            <canvas id="weatherChart4" width="800" height="600"></canvas>
        </div>
        <script>
            const ctx = document.getElementById('weatherChart').getContext('2d');
            const ctx2 = document.getElementById('weatherChart2').getContext('2d');
            const ctx3 = document.getElementById('weatherChart3').getContext('2d');
            const ctx4 = document.getElementById('weatherChart4').getContext('2d');

            const weatherChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: <?php echo json_encode(array_reverse($labels)); ?>,
                    datasets: [{
                            label: 'Temperature (°C)',
                            data: <?php echo json_encode(array_reverse($temperatureData)); ?>,
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 2,
                            fill: {
                                target: 'origin',
                                above: 'rgba(255, 99, 132, 0.5)', // Area will be red above the origin
                                below: 'rgb(255, 99, 132)' // And blue below the origin
                            }
                        },
                        {
                            label: 'Humidity (%)',
                            data: <?php echo json_encode(array_reverse($humidityData)); ?>,
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 2,
                            tension: 0.1,
                            fill: {
                                target: 'end',
                                above: 'rgba(255, 99, 132, 0.5)', // Area will be red above the origin
                                below: 'rgb(54, 162, 235)' // And blue below the origin
                            }
                        }
                    ]
                },
                options: {
                    animations: {
                        tension: {
                            duration: 1000,
                            easing: 'linear',
                            from: 1,
                            to: 0,
                            loop: true
                        }
                    },
                    plugins: {
                        legend: {
                            labels: {
                                font: {
                                    size: 20
                                }
                            }
                        }
                    }
                }
            });

            const weatherChart2 = new Chart(ctx2, {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode(array_reverse($labels)); ?>,
                    datasets: [{
                            label: 'Temperature (°C)',
                            data: <?php echo json_encode(array_reverse($temperatureData)); ?>,
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 2,
                            borderRadius: Number.MAX_VALUE,
                            fill: false
                        },
                        {
                            label: 'Humidity (%)',
                            data: <?php echo json_encode(array_reverse($humidityData)); ?>,
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 2,
                            borderRadius: Number.MAX_VALUE,
                            fill: false
                        }
                    ]
                },
                options: {
                    plugins: {
                        legend: {
                            labels: {
                                font: {
                                    size: 20
                                }
                            }
                        }
                    },
                    // scales: {
                    //     x: {
                    //         stacked: true,
                    //     },
                    //     y: {
                    //         stacked: true
                    //     }
                    // },
                    // responsive: true,
                    // maintainAspectRatio: false
                }
            });

            const weatherChart3 = new Chart(ctx3, {
                type: 'radar',
                data: {
                    labels: <?php echo json_encode(array_reverse($labels2)); ?>,
                    datasets: [{
                            label: 'Temperature (°C)',
                            data: <?php echo json_encode(array_reverse($temperatureData2)); ?>,
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 2,
                            backgroundColor: 'rgba(255, 99, 132, 0.5)',
                            fill: false,
                            circular: true
                        },
                        {
                            label: 'Humidity (%)',
                            data: <?php echo json_encode(array_reverse($humidityData3)); ?>,
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 2,
                            backgroundColor: 'rgba(54, 162, 235, 0.5)',
                            fill: false,
                            circular: true
                        }
                    ]
                },
                options: {
                    scales: {
                        r: {
                            angleLines: {
                                color: "red"
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            labels: {
                                font: {
                                    size: 20
                                }
                            }
                        }
                    },
                    // scales: {
                    //     x: {
                    //         stacked: true,
                    //     },
                    //     y: {
                    //         stacked: true
                    //     }
                    // },
                    // responsive: true,
                    // maintainAspectRatio: false
                }
            });


            const weatherChart4 = new Chart(ctx4, {
                type: 'polarArea',
                data: {
                    labels: <?php echo json_encode(array_reverse($labels2)); ?>,
                    datasets: [{
                            label: 'Temperature (°C)',
                            data: <?php echo json_encode(array_reverse($temperatureData2)); ?>,
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 2,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.5)',
                                'rgba(54, 162, 235, 0.5)',
                                'rgba(255, 206, 86, 0.5)',
                                'rgba(75, 192, 192, 0.5)',
                                'rgba(153, 102, 255, 0.5)',
                                'rgba(255, 159, 64, 0.5)',
                                'rgba(255, 99, 132, 0.5)',
                                'rgba(54, 162, 235, 0.5)',
                                'rgba(255, 206, 86, 0.5)',
                                'rgba(75, 192, 192, 0.5)',
                                'rgba(153, 102, 255, 0.5)',
                                'rgba(255, 159, 64, 0.5)'


                            ],
                            fill: false,
                            circular: true
                        },
                        {
                            label: 'Humidity (%)',
                            data: <?php echo json_encode(array_reverse($humidityData3)); ?>,
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 2,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.5)',
                                'rgba(54, 162, 235, 0.5)',
                                'rgba(255, 206, 86, 0.5)',
                                'rgba(75, 192, 192, 0.5)',
                                'rgba(153, 102, 255, 0.5)',
                                'rgba(255, 159, 64, 0.5)',
                                'rgba(255, 99, 132, 0.5)',
                                'rgba(54, 162, 235, 0.5)',
                                'rgba(255, 206, 86, 0.5)',
                                'rgba(75, 192, 192, 0.5)',
                                'rgba(153, 102, 255, 0.5)',
                                'rgba(255, 159, 64, 0.5)'

                            ],
                        }
                    ]
                },
                options: {
                    scales: {
                        r: {
                            angleLines: {
                                color: {
                                    color: 'red',
                                    borderDash: [2, 2],
                                    borderDashOffset: 2
                                }
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            labels: {
                                font: {
                                    size: 20
                                }
                            }
                        }
                    },
                    // scales: {
                    //     x: {
                    //         stacked: true,
                    //     },
                    //     y: {
                    //         stacked: true
                    //     }
                    // },
                    // responsive: true,
                    // maintainAspectRatio: false
                }
            });
        </script>
    </section>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Retrieve Data from Database</p>
    </footer>

</body>

</html>