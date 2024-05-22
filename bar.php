<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Test</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-circle-progress/1.2.0/circle-progress.min.js"></script>
    <style>
        /* Styles here */
        /* These are just test styles - you don't need them in your project */
        a {
            color: orange;
        }

        .page-title {
            font: 400 40px/1.5 Open Sans, sans-serif;
            text-align: center;
        }

        .circle {
            position: relative;
            margin: 50px auto;
            text-align: center;
            width: 300px; /* Set the width and height to match the circle size */
            height: 300px;
        }

        .circle canvas {
            margin: 0 auto;
        }

        .circle strong {
            font-size: 36px;
            color: #333;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .circle span {
            font-size: 24px;
            color: #aaa;
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
        }
    </style>
</head>
<body>
    <!-- Circle -->
    <div class="circle" id="progressCircle">
        <strong></strong>
    </div>

    <script>
        // Initialize and set initial value for the circle
        $(document).ready(function() {
            const circleValue = 0.6; // Change the value as needed

            $('#progressCircle').circleProgress({
                startAngle: -Math.PI / 2,
                thickness: 20,
                value: circleValue,
                size: 300,
                fill: {
                    gradient: ["#00ff00", "#00cc00"] // Green gradient
                }
            }).on('circle-animation-progress', function(event, progress) {
                $(this).find('strong').html(parseInt(300 * progress)); // Update only the progress value
            });
        });
    </script>
</body>
</html>
