<?php
include(APP_ROOT . "/resources/views/layouts/header.php");
?>
    <section class="w-full px-6 pb-12 antialiased bg-white">
        <div class="px-10 py-24 mx-auto max-w-7xl">
            <h1 class="text-2xl font-semibold text-gray-700 mb-8">Orders chart</h1>

            <canvas id="chart"></canvas>

            <div id="dom-labels" style="display: none;"><?php echo implode('|', $labels); ?></div>
            <div id="dom-data" style="display: none;"><?php echo implode('|', $data); ?></div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="text/javascript">
        var div1 = document.getElementById("dom-labels");
        var labels = div1.textContent;
        var div2 = document.getElementById("dom-data");
        var datas = div2.textContent;

        const randomNum = () => Math.floor(Math.random() * (235 - 52 + 1) + 52);
        const randomRGB = () => `rgb(${randomNum()}, ${randomNum()}, ${randomNum()})`;

        const config = {
            type: 'bar',
            data: {
                labels: labels.split('|'),
                datasets: [{
                    axis: 'y',
                    label: 'Orders',
                    data: datas.split('|'),
                    fill: false,
                    borderWidth: 1,
                    backgroundColor: datas.split('|').map(() => randomRGB())
                }]
            },
            options: {
                indexAxis: 'y',
            }
        };

        const myChart = new Chart(document.getElementById('chart'), config);

    </script>
<?php
include(APP_ROOT . "/resources/views/layouts/footer.php");
?>