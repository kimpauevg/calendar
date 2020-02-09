@extends('layouts.app')
@section('content')
    <style>
        .hmm{
            height: 50px;
            position: relative;

        }
        div.hmm:after{
            width: 100%;
            border-bottom: black 1px solid;
            content: '';
            display: block;
            z-index: 3;
        }
        .time{
            height: 50px;

            display: table-row; flex:1 1 auto;
        }
        .times{
            position: relative;
            margin-left: auto;
        }
        .routines{
            display: inline-flex;
            position: relative;
            width: 100%;
        }
        .times-and-routines{
            display: flex;
            flex: 1 1 auto;
            align-items: stretch;
        }
        .times-container{
            flex: none;
            display: flex;
            align-items: flex-start;
        }
        .routines-zone{

        }
        .routine{
            position: absolute;
            z-index: 1;
            background-color: red;
            width: 100%;
        }
    </style>

    <div class="container" style="display: flex; position: relative">
        <div class="times-and-routines">
            <div class="times-container">
                <div class="times" >
                    <?php for($i = 0;$i<=23;$i++ ):?>
                    <div id="{{$i}}-clock" class="time">
                        <div style="display: table-cell; border-right: black 1px solid">
                        <span>
                            {{ $i }} часов
                        </span>

                        </div>
                        <div style="display:table-cell; "></div>

                    </div>
                    <?php endfor;?>
                </div>

            </div>
            <div class="routines">
                <div class="lines" style="min-width: 100%">
                    <div class="routines-zone">

                        <?php for ($i = 0; $i<= 23; $i++):?>
                        <div class="hmm">
                        </div>

                        <?php endfor;?>
                    </div>

                </div>
                <div class="routine" style="top: 50px; left: 0px;"> GG guys</div>
            </div>

        </div>
        <div>
            <button onclick="$('#routine').show()" >Создать новую запись</button>
        </div>



        <!-- Модалка создания -->
        <div id="routine" class="modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Название</h3>
                        <a href="#close" title="Close" class="close" onclick="$('#routine').hide()">×</a>
                    </div>
                    <form id="routine-data">
                        @csrf
                        <div class="modal-body">
                            {{--                        <form id="routine"  style="display: none;" >--}}
                            {{--                            <input name="time-start" type="time">--}}
                            {{--                            ---}}
                            {{--                            <input name="time-stop" type="time">--}}

                            {{--                        </form>--}}
                            <div class="form-row">
                                <span>Название</span>
                                <input type="text" name="name">
                            </div>
                            <div class="form-row">
                                <span>Время начала</span>
                                <input type="time" name="time_start">
                            </div>
                            <div class="form-row">
                                <span>Время окончания</span>
                                <input type="time" name="time_stop">
                            </div>
                            <div class="form-row">
                                <span>Дата</span>
                                <input type="date" name="date">
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button id="routine-submit" type="button">SUBMIT</button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>

        $('#routine-submit').click(function () {
            var data = $('#routine-data').serialize();
            console.log(data);
            $.post(
                '/calendar',
                data,
                function () {

                });

        })
        var date = new Date();
        date =date.toISOString().substr(0,10);
        $.get(
            '/calendar/'+date,
            function (data) {
                console.log(data)
                data.forEach(date_tasks => {
                    console.log(date_tasks);
                    date_tasks.forEach(task=> {
                        var div = document.createElement('div');
                        div.classList.add('routine');
                        var from = task.time_start;
                        var to = task.time_stop;
                        var name = task.name;
                        var result = time_to_coordinates(task.time_start,task.time_stop);
                        // div.style.top =result.start;
                        // div.style.height=(result.stop - result.start).toFixed(0);
                        div = $(div);
                        div.css(
                          'top',result.start+'px'
                        );
                        console.log((result.end - result.start));
                        var length = (result.end - result.start);
                        div.css('height', length + 'px');
                        console.log(div);
                        div.text(name);
                        $('.routines').append(div);

                    })

                })
            }
        )
       // console.log(<?=\Illuminate\Support\Facades\Auth::user()->getAuthIdentifier()?>)
        function time_to_coordinates(time_start, time_stop) {
            var height = $('.routines').height();
            console.log(height);
            var start = time_start.split(':').reduce((hrs,min)=> (60*60*hrs) + +(min*60));
            var end = time_stop.split(':').reduce((hrs,min)=> (60*60*hrs) + +(min*60));
            start = (height /(24*60*60) * start).toFixed(0);
            end = (height /(24*60*60) * end).toFixed(0);
            return {'start':start,'end':end};

        }
    </script>
@endsection
