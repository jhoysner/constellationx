@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>Graphics</h1>

        <canvas id="mostSoldProductsChart" class="mt-4"></canvas>
        <canvas id="dailyIncomeChart" class="mt-4"></canvas>
        <canvas id="weeklyIncomeChart" class="mt-4"></canvas>
        <canvas id="monthlyIncomeChart" class="mt-4"></canvas>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // Productos más vendidos
            var mostSoldProductsCtx = document.getElementById('mostSoldProductsChart').getContext('2d');
            var mostSoldProductsChart = new Chart(mostSoldProductsCtx, {
                type: 'bar',
                data: {
                    labels: @json($mostSoldProducts->pluck('name')),
                    datasets: [{
                        label: 'Least Sold Products',
                        data: @json($mostSoldProducts->pluck('total')),
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Ingresos por día
            var dailyIncomeCtx = document.getElementById('dailyIncomeChart').getContext('2d');
            var dailyIncomeChart = new Chart(dailyIncomeCtx, {
                type: 'line',
                data: {
                    labels: @json($dailyIncome->pluck('date')),
                    datasets: [{
                        label: 'Daily Income',
                        data: @json($dailyIncome->pluck('total')),
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1,
                        fill: false,
                        tension: 0.1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        },
                        x: {
                            type: 'time',
                            time: {
                                unit: 'day',
                                tooltipFormat: 'll'
                            },
                            title: {
                                display: true,
                                text: 'Date'
                            }
                        }
                    }
                }
            });

            // Ingresos por semana
            var weeklyIncomeCtx = document.getElementById('weeklyIncomeChart').getContext('2d');
            var weeklyIncomeChart = new Chart(weeklyIncomeCtx, {
                type: 'line',
                data: {
                    labels: @json($weeklyIncome->pluck('week')),
                    datasets: [{
                        label: 'Weekly Income',
                        data: @json($weeklyIncome->pluck('total')),
                        backgroundColor: 'rgba(255, 206, 86, 0.2)',
                        borderColor: 'rgba(255, 206, 86, 1)',
                        borderWidth: 1,
                        fill: false,
                        tension: 0.1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Ingresos por mes
            var monthlyIncomeCtx = document.getElementById('monthlyIncomeChart').getContext('2d');
            var monthlyIncomeChart = new Chart(monthlyIncomeCtx, {
                type: 'line',
                data: {
                    labels: @json($monthlyIncome->pluck('month')),
                    datasets: [{
                        label: 'Monthly Income',
                        data: @json($monthlyIncome->pluck('total')),
                        backgroundColor: 'rgba(153, 102, 255, 0.2)',
                        borderColor: 'rgba(153, 102, 255, 1)',
                        borderWidth: 1,
                        fill: false,
                        tension: 0.1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
@endsection
