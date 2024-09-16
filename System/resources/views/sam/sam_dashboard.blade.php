@extends('layouts.app')

@section('title', 'Dashboard - Student Assistant Manager')

@section('content')
    <!-- Your content here -->
    @include('include.nav_bar')

    <div>
        <div class="d-flex d-lg-flex justify-content-center justify-content-lg-center align-items-lg-center" style="padding: 3em;">
            <div class="row">
                <div class="col text-center" style="margin: auto;border-bottom-style: none;padding: 1em;"><button class="btn btn-primary" type="button" style="width: 20em;background: #f6a903;color: rgb(0,0,0);font-weight: bold;height: 3em;font-size: 1em;border-style: none;border-top-style: none;border-right-style: none;border-bottom-style: none;border-left-style: none;">On-Going</button></div>
                <div class="col text-center" style="margin: auto;padding: 1em;"><button class="btn btn-primary" type="button" style="width: 20em;background: #f6a903;color: rgb(0,0,0);font-weight: bold;margin: auto;height: 3em;font-size: 1em;border-style: none;border-top-style: none;border-right-style: none;border-bottom-style: none;border-left-style: none;">Done</button></div>
            </div>
        </div>
        <div style="padding: 3em;border-top-style: groove;">
            <section>
                <h1>Assigned Tasks</h1>
                <div class="table-responsive" style="padding: 1em;">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col" style="background: #FFBD59;">TASK NO.</th>
                                <th scope="col" style="background: #FFBD59;">dATE &amp; tIME</th>
                                <th scope="col" style="background: #FFBD59;">pROGRAM</th>
                                <th style="background: #FFBD59;">Task</th>
                                <th style="background: #FFBD59;">Office</th>
                                <th style="background: #FFBD59;">Note</th>
                                <th style="background: #FFBD59;">Hours</th>
                                <th style="background: #FFBD59;">SA</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td data-label="Attributes" scope="row" style="background: #faf3d8;">Attribute 1</td>
                                <td data-label="Base Class" style="background: #faf3d8;">Cell 2</td>
                                <td data-label="Simulated Case" style="background: #faf3d8;">Cell 3</td>
                                <td style="background: #faf3d8;">Cell 4</td>
                                <td style="background: #faf3d8;">Cell 5</td>
                                <td style="background: #faf3d8;">Cell 6</td>
                                <td style="background: #faf3d8;">Cell 7</td>
                                <td style="background: #faf3d8;"><button class="btn btn-primary" type="button" style="background: #FFBD59;color: rgb(0,0,0);font-weight: bold;font-size: .7em;border-style: none;" data-bs-toggle="modal" data-bs-target="#task-1">View # SA</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>

    @include('include.offcanvas_menu')
@endsection