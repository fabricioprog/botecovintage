<link rel="stylesheet" href="<?=base_url('assets/css/Chart.min.css')?>">
<script src="<?=base_url('assets/js/moment-with-locales.min.js')?>"></script>
<script src="<?=base_url('assets/js/Chart.min.js')?>"></script>

<?php alert(); ?>

<div class='row'>
    <div class='col-6'>
        <canvas id="rendimentos" width="200" height="100"></canvas>
    </div>
    <div class='col-6'>
        <canvas id="consumo_medio" width="200" height="100"></canvas>
    </div>
    <div class='col-6'>
        <canvas id="mesas_encerradas" width="200" height="100"></canvas>
    </div>
    <div class='col-6'>
        <canvas id="permanencia_media" width="200" height="100"></canvas>
    </div>

</div>




<script>
$(document).ready(function() {
    var ctx_rendimentos = $('#rendimentos');
    var ctx_mesas_encerradas = $('#mesas_encerradas');
    var ctx_permanencia_media = $('#permanencia_media');
    var ctx_consumo_medio = $('#consumo_medio');
    var consolidado = <?= $consolidado ?>;
    var semanas = [];
    var rendimentos = [];
    var mesas_encerradas = [];
    var permanencia_media = [];
    var consumo_medio = [];

    consolidado.forEach(function(i) {
        semanas.push(i.semana + 'ª');
        rendimentos.push(i.rendimento);
        mesas_encerradas.push(i.mesas_encerradas);
        permanencia_media.push(moment('2019-01-01 ' + i.permanencia_media));
        consumo_medio.push(i.consumo_medio);

    });

    console.log(permanencia_media);

    var options_geral = {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    };

    var rendimentos = new Chart(ctx_rendimentos, {
        type: 'line',
        data: {
            labels: semanas,
            datasets: [{
                label: 'Faturamento Semanal',
                data: rendimentos,
                backgroundColor: [
                    'rgba(100, 255, 0, 0.1)',
                ],
                borderColor: [
                    'rgba(100, 255, 0, 1)',

                ],
                borderWidth: 1
            }]
        },
        options_geral
    });

    var consumo_medio = new Chart(ctx_consumo_medio, {
        type: 'line',
        data: {
            labels: semanas,
            datasets: [{
                label: 'Consumo Médio',
                data: consumo_medio,
                backgroundColor: [
                    'rgba(0, 0, 255, 0.1)',
                ],
                borderColor: [
                    'rgba(0, 0, 255, 1)',

                ],
                borderWidth: 1
            }]
        },
        options_geral
    });


    var mesas_encerradas = new Chart(ctx_mesas_encerradas, {
        type: 'line',
        data: {
            labels: semanas,
            datasets: [{
                label: 'Mesas Encerradas',
                data: mesas_encerradas,
                backgroundColor: [
                    'rgba(255, 0, 0, 0.1)',
                ],
                borderColor: [
                    'rgba(255, 0, 0, 1)',

                ],
                borderWidth: 1
            }]
        },
        options_geral
    });

    var permanencia_media = new Chart(ctx_permanencia_media, {
        type: 'line',
        data: {
            labels: semanas,
            datasets: [{
                label: 'Tempo Permanencia',
                data: permanencia_media,
                backgroundColor: [
                    'rgba(255,255,0, 0.1)',
                ],
                borderColor: [
                    'rgba(255,255,0, 1)',

                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    type: 'linear',
                    position: 'left',
                    ticks: {
                        stepSize: 3.6e+6,
                        beginAtZero: false,
                        callback: value => {
                            let date = moment(value);
                            if (date.diff(moment('2019-01-01 23:59:59'), 'minutes') === 0) {
                                return null;
                            }

                            return date.format('H');
                        }
                    }
                }]
            },
        }
    });

});
</script>