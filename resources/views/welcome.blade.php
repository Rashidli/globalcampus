@extends('layouts.master')

@section('title', 'Statistika')

@section('content')


            <div class="statistics-boxes">
                <div class="statistics-box">
                    <div class="icon">
                        <img src="{{asset('/')}}assets/icons/statistic1.svg" alt="">
                    </div>
                    <div class="box-body">
                        <h2>Ödənilmiş məbləğ:</h2>
                        <p><span>20.000</span> AZN</p>
                    </div>
                </div>
                <div class="statistics-box">
                    <div class="icon">
                        <img src="{{asset('/')}}assets/icons/statistic2.svg" alt="">
                    </div>
                    <div class="box-body">
                        <h2>Qalan ödəniş:</h2>
                        <p><span>4068</span> AZN</p>
                    </div>
                </div>
                <div class="statistics-box">
                    <div class="icon">
                        <img src="{{asset('/')}}assets/icons/statistic3.svg" alt="">
                    </div>
                    <div class="box-body">
                        <h2>Tələbə sayı:</h2>
                        <p><span>{{$userCount}}</span></p>
                    </div>
                </div>
                <div class="statistics-box">
                    <div class="icon">
                        <img src="{{asset('/')}}assets/icons/statistic4.svg" alt="">
                    </div>
                    <div class="box-body">
                        <h2>Agent sayı:</h2>
                        <p><span>{{$agentCount}}</span></p>
                    </div>
                </div>
            </div>
            <div class="statistics-chart-area">
                <div class="chart-box">
                    <img src="{{asset('/')}}assets/images/chart.png" alt="">
                </div>
                <div class="statistics-profit-box">
                    <div class="icon">
                        <img src="{{asset('/')}}assets/icons/statistic-profit-box.gif" alt="">
                    </div>
                    <div class="profit-box-items">
                        <div class="profit-box-item">
                            <h2>İllik gəlir:</h2>
                            <p><span>30.000</span>AZN</p>
                        </div>
                        <div class="profit-box-item">
                            <h2>İllik xərc:</h2>
                            <p><span>10.000</span>AZN</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="statistics-student-processes">
                <div class="student-processes-left">
                    <div class="student-processes-head">
                        <h2>Tələbə prosesləri</h2>
                        <div class="student-processes-time">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M5.83334 1.45837C6.17852 1.45837 6.45834 1.7382 6.45834 2.08337V2.71897C7.01003 2.70836 7.61784 2.70837 8.28632 2.70837H11.7137C12.3822 2.70837 12.99 2.70836 13.5417 2.71897V2.08337C13.5417 1.7382 13.8215 1.45837 14.1667 1.45837C14.5118 1.45837 14.7917 1.7382 14.7917 2.08337V2.77261C15.0083 2.78913 15.2134 2.80989 15.4075 2.83599C16.3845 2.96734 17.1753 3.24411 17.799 3.86774C18.4226 4.49138 18.6994 5.28217 18.8307 6.25919C18.8727 6.57143 18.9009 6.9122 18.9198 7.28343C18.9447 7.35092 18.9583 7.42389 18.9583 7.50004C18.9583 7.55781 18.9505 7.61374 18.9358 7.66684C18.9584 8.33516 18.9583 9.094 18.9583 9.95303V11.7137C18.9584 13.2452 18.9584 14.4582 18.8307 15.4076C18.6994 16.3846 18.4226 17.1754 17.799 17.799C17.1753 18.4226 16.3845 18.6994 15.4075 18.8308C14.4582 18.9584 13.2452 18.9584 11.7137 18.9584H8.28633C6.75486 18.9584 5.54183 18.9584 4.59249 18.8308C3.61547 18.6994 2.82468 18.4226 2.20104 17.799C1.57741 17.1754 1.30064 16.3846 1.16928 15.4076C1.04165 14.4582 1.04166 13.2452 1.04167 11.7137V9.95303C1.04166 9.094 1.04166 8.33516 1.06418 7.66685C1.04951 7.61375 1.04167 7.55781 1.04167 7.50004C1.04167 7.42389 1.05529 7.35091 1.08023 7.28343C1.09913 6.91219 1.1273 6.57143 1.16928 6.25919C1.30064 5.28217 1.57741 4.49138 2.20104 3.86774C2.82468 3.24411 3.61547 2.96734 4.59249 2.83599C4.78659 2.80989 4.99172 2.78913 5.20834 2.77261V2.08337C5.20834 1.7382 5.48816 1.45837 5.83334 1.45837ZM2.30258 8.12504C2.29194 8.66898 2.29167 9.28836 2.29167 10V11.6667C2.29167 13.2557 2.293 14.3846 2.40814 15.241C2.52086 16.0794 2.73225 16.5624 3.08492 16.9151C3.4376 17.2678 3.92064 17.4792 4.75905 17.5919C5.61543 17.707 6.74432 17.7084 8.33334 17.7084H11.6667C13.2557 17.7084 14.3846 17.707 15.241 17.5919C16.0794 17.4792 16.5624 17.2678 16.9151 16.9151C17.2678 16.5624 17.4792 16.0794 17.5919 15.241C17.707 14.3846 17.7083 13.2557 17.7083 11.6667V10C17.7083 9.28836 17.7081 8.66898 17.6974 8.12504H2.30258ZM17.6403 6.87504H2.35974C2.37309 6.71722 2.38905 6.56774 2.40814 6.42575C2.52086 5.58734 2.73225 5.1043 3.08492 4.75163C3.4376 4.39895 3.92064 4.18756 4.75905 4.07484C5.61543 3.9597 6.74432 3.95837 8.33334 3.95837H11.6667C13.2557 3.95837 14.3846 3.9597 15.241 4.07484C16.0794 4.18756 16.5624 4.39895 16.9151 4.75163C17.2678 5.1043 17.4792 5.58734 17.5919 6.42575C17.611 6.56774 17.6269 6.71722 17.6403 6.87504Z" fill="#1C274C"/>
                            </svg>
                            <select name="" id="">
                                <option value="">Tarix</option>
                                <option value="">Yesterday</option>
                                <option value="">Monthly</option>
                                <option value="">Yearly</option>
                                <option value="">5 illik</option>
                            </select>
                        </div>
                    </div>
                    <div class="student-processes-results">
                        <div class="result-item">
                            <p>Aktiv: </p>
                            <span>32%</span>
                        </div>
                        <div class="result-item">
                            <p>Deaktiv:</p>
                            <span>32%</span>
                        </div>
                        <div class="result-item">
                            <p>Proses bitib:</p>
                            <span>32%</span>
                        </div>
                        <div class="result-item">
                            <p>Qəbul olunub:</p>
                            <span>32%</span>
                        </div>
                        <div class="result-item">
                            <p>Viza imtina:</p>
                            <span>32%</span>
                        </div>
                    </div>
                    <div class="student-processes-targets">
                        <div class="process-target-item">
                            <span style="background: #FFE4B1;"></span>
                            <p>Aktiv</p>
                        </div>
                        <div class="process-target-item">
                            <span style="background: #CACACA;"></span>
                            <p>Deaktiv</p>
                        </div>
                        <div class="process-target-item">
                            <span style="background: #C0CEFF;"></span>
                            <p>Proses bitib</p>
                        </div>
                        <div class="process-target-item">
                            <span style="background: #B1FFBD;"></span>
                            <p>Qəbul olunub</p>
                        </div>
                        <div class="process-target-item">
                            <span style="background: #FFCCCD;"></span>
                            <p>Viza imtina</p>
                        </div>
                    </div>
                </div>
                <div class="pie-charts">
                    <img src="{{asset('/')}}assets/images/pie-chart.svg" alt="">
                </div>
            </div>


@endsection

