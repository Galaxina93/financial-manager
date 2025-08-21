<div x-show="$wire.showChart" x-collapse>
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700"
         wire:ignore
         x-data="{
            chart: null,
            initChart() {
                // KORREKTUR: Sichere Methode zur Übergabe von PHP-Daten an JS
                let chartData = {{ Illuminate\Support\Js::from($this->chartData) }};

                let canvas = this.$refs.canvas;
                if (this.chart) {
                    this.chart.destroy();
                }
                this.chart = new Chart(canvas, {
                    type: 'line',
                    data: chartData,
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: { y: { beginAtZero: true } }
                    }
                });

                // KORREKTUR: Korrekter Zugriff auf Event-Daten in Livewire 3
                $wire.on('update-chart', ({data}) => {
                    if(this.chart) {
                        this.chart.data = data;
                        this.chart.update();
                    }
                });
            }
        }"
         x-init="initChart()">
        <h3 class="text-xl font-bold text-gray-800 dark:text-gray-100 mb-4">Finanzübersicht {{ $this->currentYear }}</h3>
        <div class="h-96">
            <canvas x-ref="canvas"></canvas>
        </div>
    </div>
</div>
